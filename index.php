<?php
/**
 * Sourcefile: index.php
 * Schrijver : Peter Meint Heida
 * Datum     : 02-01-2016
 *
 * Wijzigingen :
 */

/**
 * index.php (controller) wordt gebruikt voor de afhandeling van alle schermen
 */
require_once('classes/main_inc.php');

$oController = new Controller();
$oController->handlePagina();
?>