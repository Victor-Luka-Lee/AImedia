$ErrorActionPreference = 'Stop'
. "$PSScriptRoot\capture-page.ps1" -ConnectOnly
$offlineRoot = Join-Path $PSScriptRoot 'joongang-25469354'
try {
    $expression = [IO.File]::ReadAllText((Join-Path $offlineRoot 'build-expression.js'))
    $result = Evaluate-Cdp $expression
    $utf8 = New-Object Text.UTF8Encoding($false)
    [IO.File]::WriteAllText((Join-Path $offlineRoot 'index.html'), $result.html, $utf8)
    [IO.File]::WriteAllText((Join-Path $offlineRoot 'unresolved-dom-assets.json'), (ConvertTo-Json -InputObject @($result.missing) -Depth 5), $utf8)
    Write-Output "Created offline HTML. Unresolved DOM URLs: $($result.missing.Count)"
} finally { $script:socket.Dispose() }
