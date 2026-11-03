param([string]$Entry = '')
$ErrorActionPreference = 'Stop'
. "$PSScriptRoot\capture-page.ps1" -ConnectOnly
$offlineRoot = Join-Path $PSScriptRoot 'joongang-25469354'
$utf8 = New-Object Text.UTF8Encoding($false)
try {
    Send-Cdp 'Page.enable' | Out-Null
    Send-Cdp 'Network.enable' | Out-Null
    Send-Cdp 'Network.emulateNetworkConditions' @{offline=$true;latency=0;downloadThroughput=-1;uploadThroughput=-1} | Out-Null
    Send-Cdp 'Emulation.setDeviceMetricsOverride' @{width=1440;height=1000;deviceScaleFactor=1;mobile=$false} | Out-Null
    if (-not $Entry) { $Entry = Join-Path $offlineRoot 'index.html' }
    Send-Cdp 'Page.navigate' @{url=('file:///' + $Entry.Replace('\','/'))} | Out-Null
    Start-Sleep -Seconds 3
    Evaluate-Cdp 'document.fonts.ready.then(()=>true)' | Out-Null
    $report = Evaluate-Cdp @'
({title:document.title, url:location.href,
 headline:document.querySelector('h1').getBoundingClientRect().toJSON(),
 article:document.querySelector('#article_body').getBoundingClientRect().toJSON(),
 fonts:[...document.fonts].filter(f=>f.status==='loaded').map(f=>({family:f.family,weight:f.weight,status:f.status})),
 imageCount:document.images.length,
 brokenImages:[...document.images].filter(i=>!i.complete||!i.naturalWidth).map(i=>({src:i.src,alt:i.alt})),
 remoteRequests:performance.getEntriesByType('resource').filter(r=>/^https?:/.test(r.name)).map(r=>r.name),
 fontButtons:[...document.querySelectorAll('#layer_fontsize button')].map(e=>({html:e.outerHTML})),
 horizontalOverflow:document.documentElement.scrollWidth>innerWidth,
 height:document.documentElement.scrollHeight})
'@
    $shot = Send-Cdp 'Page.captureScreenshot' @{format='png';captureBeyondViewport=$false}
    [IO.File]::WriteAllBytes((Join-Path $offlineRoot 'offline-desktop.png'),[Convert]::FromBase64String($shot.data))
    $layout = Send-Cdp 'Page.getLayoutMetrics'
    $full = Send-Cdp 'Page.captureScreenshot' @{format='png';captureBeyondViewport=$true;clip=@{x=0;y=0;width=$layout.cssContentSize.width;height=$layout.cssContentSize.height;scale=1}}
    [IO.File]::WriteAllBytes((Join-Path $offlineRoot 'offline-fullpage.png'),[Convert]::FromBase64String($full.data))
    Send-Cdp 'Runtime.evaluate' @{expression="document.querySelector('.btn_fontsize').click()"} | Out-Null
    $report | Add-Member -NotePropertyName fontPanelOpens -NotePropertyValue (Evaluate-Cdp "!document.getElementById('layer_fontsize').classList.contains('hide')")
    $report | Add-Member -NotePropertyName fontSelectionWorks -NotePropertyValue (Evaluate-Cdp "document.querySelector('#layer_fontsize li:nth-child(5) a').click();document.querySelector('#article_body').classList.contains('fs5')")
    Evaluate-Cdp "document.querySelector('#layer_fontsize li:nth-child(3) a').click();document.dispatchEvent(new KeyboardEvent('keydown',{key:'Escape'}));true" | Out-Null
    Send-Cdp 'Emulation.setDeviceMetricsOverride' @{width=390;height=844;deviceScaleFactor=1;mobile=$true} | Out-Null
    Start-Sleep -Seconds 1
    $mobile = Evaluate-Cdp '({width:innerWidth,scrollWidth:document.documentElement.scrollWidth,article:document.querySelector("#article_body").getBoundingClientRect().toJSON(),brokenImages:[...document.images].filter(i=>!i.complete||!i.naturalWidth).length})'
    $shot = Send-Cdp 'Page.captureScreenshot' @{format='png';captureBeyondViewport=$false}
    [IO.File]::WriteAllBytes((Join-Path $offlineRoot 'offline-mobile.png'),[Convert]::FromBase64String($shot.data))
    $report | Add-Member -NotePropertyName mobile -NotePropertyValue $mobile
    [IO.File]::WriteAllText((Join-Path $offlineRoot 'verification.json'),($report | ConvertTo-Json -Depth 12),$utf8)
    Write-Output ($report | Select-Object title,imageCount,brokenImages,remoteRequests,horizontalOverflow,fontPanelOpens,fontSelectionWorks,fonts,mobile | ConvertTo-Json -Depth 8 -Compress)
} finally { $script:socket.Dispose() }
