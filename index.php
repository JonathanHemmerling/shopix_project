<?php
// alle Fehler anzeigen
error_reporting(E_ALL);
// Fehler in der Webseite anzeigen (nicht in Produktion verwenden)
ini_set('display_errors', 'On');
// Fehler in Log-Datei schreiben (absolut oder relativ)
// ini_set('error_log', '/var/www/virtual/meine-domain.de/logs/php-errors.log');
ini_set('log_errors', 'On');
ini_set('error_log', 'php-errors.log'); ?>

<?php

require __DIR__ . '/vendor/autoload.php';

include 'src/header.php';
include 'src/menu.php';
include 'src/content.php';
include 'src/footer.php';
?>


