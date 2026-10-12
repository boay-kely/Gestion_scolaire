<#
PowerShell helper to set up a VirtualHost for the IGFIA Laravel project on XAMPP.

USAGE (run as Administrator):
1. Open PowerShell as Administrator.
2. cd C:\xampp\htdocs\IGFIA\scripts
3. .\setup-xampp-vhost.ps1 -SiteName igfia.local -ProjectPath 'C:\xampp\htdocs\IGFIA' -Port 80

What this script does:
- Creates a backup of the Apache vhosts file (httpd-vhosts.conf)
- Appends a VirtualHost block for the provided site name
- Adds an entry to C:\Windows\System32\drivers\etc\hosts for the site name
- Attempts to restart Apache (if XAMPP's httpd.exe is accessible)

IMPORTANT: You must run PowerShell as Administrator for the script to modify system files.
Remove the debug/backup changes manually if needed.
#>
param(
    [string]$SiteName = 'igfia.local',
    [string]$ProjectPath = 'C:\xampp\htdocs\IGFIA',
    [int]$Port = 80
)

function Test-IsAdmin {
    $current = [Security.Principal.WindowsIdentity]::GetCurrent()
    $principal = New-Object Security.Principal.WindowsPrincipal($current)
    return $principal.IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)
}

if (-not (Test-IsAdmin)) {
    Write-Error "This script must be run as Administrator. Right-click PowerShell -> Run as Administrator."
    exit 1
}

$apacheExtra = "C:\xampp\apache\conf\extra\httpd-vhosts.conf"
$hostsFile = "C:\Windows\System32\drivers\etc\hosts"

if (-not (Test-Path $apacheExtra)) {
    Write-Error "Cannot find Apache vhosts file at $apacheExtra. Is XAMPP installed in C:\xampp?"
    exit 1
}

# Backup
$timestamp = (Get-Date).ToString('yyyyMMddHHmmss')
$backupPath = "${apacheExtra}.backup.$timestamp"
Copy-Item $apacheExtra $backupPath -Force
Write-Output "Backed up $apacheExtra to $backupPath"

$vhostBlock = @"
# IGFIA vhost added by setup-xampp-vhost.ps1
<VirtualHost *:$Port>
    ServerName $SiteName
    DocumentRoot "$ProjectPath\public"
    <Directory "$ProjectPath\public">
        Require all granted
        AllowOverride All
        Options Indexes FollowSymLinks
    </Directory>
    ErrorLog "logs/$SiteName-error.log"
    CustomLog "logs/$SiteName-access.log" common
</VirtualHost>

"@

# Append vhost if not already present
$fileContent = Get-Content $apacheExtra -Raw
if ($fileContent -match [regex]::Escape("ServerName $SiteName")) {
    Write-Output "A VirtualHost for $SiteName already appears to exist in $apacheExtra. Skipping append."
} else {
    Add-Content -Path $apacheExtra -Value $vhostBlock
    Write-Output "Appended VirtualHost block to $apacheExtra"
}

# Add hosts entry
$hostsContent = Get-Content $hostsFile -Raw
$entry = "127.0.0.1`t$SiteName"
if ($hostsContent -match "^\s*127\.0\.0\.1\s+$SiteName" -or ($hostsContent -match [regex]::Escape($entry))) {
    Write-Output "Hosts entry for $SiteName already exists."
} else {
    Add-Content -Path $hostsFile -Value "`n# IGFIA local site`n$entry"
    Write-Output "Added hosts entry: $entry"
}

# Attempt to restart Apache (httpd.exe) if available
$httpd = 'C:\xampp\apache\bin\httpd.exe'
if (Test-Path $httpd) {
    Write-Output "Restarting Apache using httpd.exe -k restart"
    & $httpd -k restart
    if ($LASTEXITCODE -eq 0) { Write-Output "Apache restart command executed." } else { Write-Warning "Apache restart command returned exit code $LASTEXITCODE. You may need to restart Apache via XAMPP Control Panel." }
} else {
    Write-Warning "Could not find httpd.exe at $httpd. Restart Apache via XAMPP Control Panel manually."
}

Write-Output "Done. Open http://$SiteName in your browser."