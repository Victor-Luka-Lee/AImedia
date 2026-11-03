param([string]$Url = 'https://www.joongang.co.kr/article/25469354', [string]$Output = 'C:\code\AImedia\news\joongang-25469354', [switch]$ConnectOnly)
$ErrorActionPreference = 'Stop'
New-Item -ItemType Directory -Path $Output -Force | Out-Null
$utf8 = New-Object System.Text.UTF8Encoding($false)
$script:socket = New-Object System.Net.WebSockets.ClientWebSocket
$script:sequence = 0
$script:responses = @{}
$script:finished = @{}
$script:failures = @()
$script:events = 0
$targets = Invoke-RestMethod 'http://127.0.0.1:9224/json/list'
$target = $targets | Where-Object type -eq 'page' | Select-Object -First 1
$script:socket.ConnectAsync([Uri]$target.webSocketDebuggerUrl, [Threading.CancellationToken]::None).GetAwaiter().GetResult()
function Send-Cdp([string]$Method, $Parameters = @{}) {
    $script:sequence++
    $id = $script:sequence
    $packet = @{id=$id; method=$Method; params=$Parameters} | ConvertTo-Json -Compress -Depth 30
    $bytes = [Text.Encoding]::UTF8.GetBytes($packet)
    $script:socket.SendAsync([ArraySegment[byte]]::new($bytes), [Net.WebSockets.WebSocketMessageType]::Text, $true, [Threading.CancellationToken]::None).GetAwaiter().GetResult()
    do {
        $stream = New-Object IO.MemoryStream
        do {
            $buffer = New-Object byte[] 65536
            $cts = New-Object Threading.CancellationTokenSource
            $cts.CancelAfter(60000)
            $received = $script:socket.ReceiveAsync([ArraySegment[byte]]::new($buffer), $cts.Token).GetAwaiter().GetResult()
            $stream.Write($buffer, 0, $received.Count)
            $cts.Dispose()
        } while (-not $received.EndOfMessage)
        $message = [Text.Encoding]::UTF8.GetString($stream.ToArray()) | ConvertFrom-Json
        $stream.Dispose()
        if ($message.method -eq 'Network.responseReceived') { $script:responses[$message.params.requestId] = $message.params }
        if ($message.method -eq 'Network.loadingFinished') { $script:finished[$message.params.requestId] = $true }
        if ($message.method -eq 'Network.loadingFailed') { $script:failures += $message.params }
    } while ($message.id -ne $id)
    if ($message.error) { throw "$Method : $($message.error.message)" }
    return $message.result
}
function Evaluate-Cdp([string]$Expression) {
    $r = Send-Cdp 'Runtime.evaluate' @{expression=$Expression; returnByValue=$true; awaitPromise=$true}
    if ($r.exceptionDetails) { throw ($r.exceptionDetails | ConvertTo-Json -Depth 10 -Compress) }
    return $r.result.value
}
if ($ConnectOnly) { return }
try {
    Send-Cdp 'Page.enable' | Out-Null
    Send-Cdp 'Network.enable' @{maxTotalBufferSize=150000000;maxResourceBufferSize=15000000} | Out-Null
    Send-Cdp 'Emulation.setDeviceMetricsOverride' @{width=1440;height=1000;deviceScaleFactor=1;mobile=$false} | Out-Null
    Send-Cdp 'Page.navigate' @{url=$Url} | Out-Null
    Start-Sleep -Seconds 10
    $loaded = Evaluate-Cdp '({title:document.title, ready:document.readyState, height:document.documentElement.scrollHeight, text:document.body.innerText.slice(0,180)})'
    Write-Output ($loaded | ConvertTo-Json -Compress)
    # Traverse the page so lazy images, sidebars and fonts have a chance to load.
    Evaluate-Cdp '(async()=>{for(let y=0;y<document.documentElement.scrollHeight;y+=800){window.scrollTo(0,y);await new Promise(r=>setTimeout(r,180));}window.scrollTo(0,0);await document.fonts.ready;return true;})()' | Out-Null
    Start-Sleep -Seconds 4
    $snapshot = Send-Cdp 'Page.captureSnapshot' @{format='mhtml'}
    [IO.File]::WriteAllText((Join-Path $Output 'original-page.mhtml'), $snapshot.data, $utf8)
    $shot = Send-Cdp 'Page.captureScreenshot' @{format='png';captureBeyondViewport=$false}
    [IO.File]::WriteAllBytes((Join-Path $Output 'original-desktop.png'), [Convert]::FromBase64String($shot.data))
    $dom = Evaluate-Cdp '"<!doctype html>\n"+document.documentElement.outerHTML'
    [IO.File]::WriteAllText((Join-Path $Output 'rendered-original.html'), $dom, $utf8)
    $info = Evaluate-Cdp @'
JSON.stringify({
 title:document.title,url:location.href,
 assets:[...document.querySelectorAll('link[href],script[src],img[src],source[src],source[srcset],video[src],video[poster],audio[src],iframe[src],embed[src],object[data]')].map(e=>({tag:e.tagName,rel:e.rel||'',src:e.src||e.href||e.data||'',srcset:e.srcset||'',poster:e.poster||''})),
 styles:[...document.querySelectorAll('[style]')].map(e=>e.getAttribute('style')),
 images:[...document.images].map(e=>({src:e.currentSrc||e.src,width:e.naturalWidth,height:e.naturalHeight})),
 metrics:{height:document.documentElement.scrollHeight,article:document.querySelector('#article_body')?.getBoundingClientRect().toJSON(),headline:document.querySelector('h1')?.getBoundingClientRect().toJSON()}
})
'@
    [IO.File]::WriteAllText((Join-Path $Output 'page-info.json'), $info, $utf8)
    $assetDir = Join-Path $Output 'assets'
    New-Item -ItemType Directory -Path $assetDir -Force | Out-Null
    $records = @()
    foreach ($requestId in @($script:responses.Keys)) {
        $entry = $script:responses[$requestId]
        $r = $entry.response
        if ($r.url -notmatch '^https?://' -or $r.status -ge 400 -or -not $script:finished.ContainsKey($requestId)) { continue }
        if ($entry.type -eq 'Document' -and $r.url -eq $Url) { continue }
        try {
            $body = Send-Cdp 'Network.getResponseBody' @{requestId=$requestId}
            $hash = [BitConverter]::ToString([Security.Cryptography.SHA256]::Create().ComputeHash([Text.Encoding]::UTF8.GetBytes($r.url))).Replace('-','').ToLower().Substring(0,16)
            $extension = [IO.Path]::GetExtension(([Uri]$r.url).AbsolutePath)
            if ($extension -notmatch '^\.[a-zA-Z0-9]{1,7}$') {
                $extension = switch -Regex ($r.mimeType) {'javascript' {'.js';break};'css' {'.css';break};'json' {'.json';break};'html' {'.html';break};'woff2' {'.woff2';break};'svg' {'.svg';break};'png' {'.png';break};'jpeg' {'.jpg';break};default {'.bin'}}
            }
            $name = "$hash$extension"
            if ($body.base64Encoded) { $bytes = [Convert]::FromBase64String($body.body) }
            else { $bytes = [Text.Encoding]::UTF8.GetBytes($body.body) }
            [IO.File]::WriteAllBytes((Join-Path $assetDir $name), $bytes)
            $records += @{url=$r.url;file="assets/$name";mime=$r.mimeType;type=$entry.type;bytes=$bytes.Length;status=$r.status}
        } catch { Write-Output "Resource body unavailable: $($r.url)" }
    }
    [IO.File]::WriteAllText((Join-Path $Output 'captured-resources.json'), (ConvertTo-Json -InputObject @($records) -Depth 8), $utf8)
    [IO.File]::WriteAllText((Join-Path $Output 'network-failures.json'), (ConvertTo-Json -InputObject @($script:failures) -Depth 10), $utf8)
    Write-Output "Captured $($records.Count) resources; failed requests: $($script:failures.Count)"
} finally { $script:socket.Dispose() }
