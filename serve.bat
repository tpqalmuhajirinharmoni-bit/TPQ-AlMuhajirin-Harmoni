@echo off
set "PHP=C:\laragon\bin\php\php-8.4.21-Win32-vs17-x64\php.exe"
set "PHP_INI=C:\laragon\bin\php\php-8.4.21-Win32-vs17-x64\php.ini"
set "PHP_DIR=C:\laragon\bin\php\php-8.4.21-Win32-vs17-x64"
set "EXT_DIR=%PHP_DIR%\ext"
set "PHPRC=%PHP_DIR%"
set "PHP_INI_SCAN_DIR="
if not exist "%PHP%" (
    for %%I in (php.exe) do if exist "%%~$PATH:I" set "PHP=%%~$PATH:I"
)
if not exist "%PHP%" (
  echo PHP executable not found.
  echo Please install PHP or update this file with the correct path.
  pause
  exit /b 1
)
if not exist "%PHP_INI%" (
  echo PHP configuration file not found at %PHP_INI%.
  echo Please ensure php.ini exists in the Laragon PHP folder.
  pause
  exit /b 1
)
echo Starting PHP development server...
echo Using PHP: %PHP%
echo Using php.ini: %PHP_INI%
pushd "%~dp0public"
"%PHP%" -c "%PHP_INI%" -S 127.0.0.1:8000
popd
