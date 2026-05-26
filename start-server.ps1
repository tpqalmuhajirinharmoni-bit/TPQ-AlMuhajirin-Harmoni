$php = "C:\laragon\bin\php\php-8.4.21-Win32-vs17-x64\php.exe"
$phpIni = "C:\laragon\bin\php\php-8.4.21-Win32-vs17-x64\php.ini"
$phpDir = "C:\laragon\bin\php\php-8.4.21-Win32-vs17-x64"
$extDir = "$phpDir\ext"
if (-Not (Test-Path $php)) {
    $php = Get-Command php -ErrorAction SilentlyContinue | Select-Object -ExpandProperty Source -ErrorAction SilentlyContinue
}
if (-Not $php) {
    Write-Error "PHP executable not found. Please install PHP or update this file with the correct path."
    exit 1
}
if (-Not (Test-Path $phpIni)) {
    Write-Error "PHP configuration file not found at $phpIni. Please ensure php.ini exists in the Laragon PHP folder."
    exit 1
}
$env:PHPRC = $phpDir
$env:PHP_INI_SCAN_DIR = ""
Write-Host "Starting PHP development server..."
Write-Host "Using PHP: $php"
Write-Host "Using php.ini: $phpIni"
Push-Location "$PSScriptRoot\public"
& $php -c $phpIni -S 127.0.0.1:8000
Pop-Location
