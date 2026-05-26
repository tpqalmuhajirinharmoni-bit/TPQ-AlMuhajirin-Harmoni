<?php
header('Content-Type: text/plain');
$loaded = extension_loaded('openssl') ? 'yes' : 'no';
$ini = php_ini_loaded_file();
$phpBinary = PHP_BINARY;
$version = PHP_VERSION;
$cliArgs = php_sapi_name();
echo "PHP binary: $phpBinary\n";
echo "PHP version: $version\n";
echo "SAPI: $cliArgs\n";
echo "php.ini: $ini\n";
echo "openssl loaded: $loaded\n";
if ($loaded) {
    echo "openssl version: " . OPENSSL_VERSION_TEXT . "\n";
} else {
    echo "openssl error: extension not loaded\n";
}
