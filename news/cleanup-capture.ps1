$ErrorActionPreference = 'Stop'
. "$PSScriptRoot\capture-page.ps1" -ConnectOnly
try { Send-Cdp 'Browser.close' | Out-Null } finally { $script:socket.Dispose() }
Start-Sleep -Seconds 2
$workspacePath = [IO.Path]::GetFullPath('C:\code\AImedia')
$profilePath = [IO.Path]::GetFullPath((Join-Path $PSScriptRoot '.capture-profile'))
if (-not $profilePath.StartsWith($workspacePath + '\',[StringComparison]::OrdinalIgnoreCase) -or [IO.Path]::GetFileName($profilePath) -ne '.capture-profile') {throw 'Unexpected temporary profile path'}
if (Test-Path -LiteralPath $profilePath) {Remove-Item -LiteralPath $profilePath -Recurse -Force}
Write-Output 'Temporary capture browser closed and its profile removed.'
