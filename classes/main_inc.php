<?php
/**
 * Sourcefile: main_inc.php
 * Schrijver : Peter Meint Heida
 * Datum     : 02-01-2016
 *
 * Wijzigingen :
 */

// set errors aan
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting (E_ALL | E_STRICT);

/**
 * bepaal het operating systeem
 */
if (!defined('SERVER_OS')) {
	// detect OS
	$os = getenv("SERVER_SOFTWARE");
	if(strstr($os, "Win32")) {
		DEFINE('PATH_DELIM', ';');
		DEFINE('SERVER_OS', 'WINDOWS');
	}
	else 
	{
		DEFINE('PATH_DELIM', ':');
		DEFINE('SERVER_OS', 'OTHER');
	}
}
/**
 * bepaal het root path
 */
$sRoot = dirname(__FILE__);
$nPos = strpos($sRoot, 'bcrianto-mvc');
$sRoot = substr($sRoot, 0, $nPos).'bcrianto-mvc/';
DEFINE('ROOT', $sRoot);
/**
 * stel include path in
 */
$sPath = ini_get('include_path');
$sPath .= PATH_DELIM . $sRoot . 'classes';
$sPath .= PATH_DELIM . $sRoot . 'classes/frontend';
$sPath .= PATH_DELIM . $sRoot . 'classes/backend';
$sPath .= PATH_DELIM . $sRoot . 'classes/util';
$sPath .= PATH_DELIM . $sRoot . 'smarty';
ini_set('include_path', $sPath);

/**
 * start de sessie
 */
// Hieronder de instellingen voor de sessie, standaard leef

$_SESSION['gebruiker']	= '';
$_SESSION['wachtwoord']	= '';
$_SESSION['naam'] 		= '';

// Hieronder de instelling voor de verbinding met de database

if ($_SERVER['SERVER_ADDR'] == '127.0.0.1' || $_SERVER['SERVER_ADDR'] == '::1') {
    // Lokale MySQL-databaseserver
    define('MYSQL_SERVER',         'localhost');
    define('MYSQL_GEBRUIKERSNAAM', 'admin_bcrianto');
    define('MYSQL_WACHTWOORD',     'bcrianto');
    define('MYSQL_DATABASENAAM',   'bcrianto');

    // Lokaal alle foutmeldingen weergeven
    error_reporting(E_ALL | E_STRICT);
} else {
    // Externe MySQL-databaseserver
    define('MYSQL_SERVER',         'INVULLEN');
    define('MYSQL_GEBRUIKERSNAAM', 'INVULLEN');
    define('MYSQL_WACHTWOORD',     'INVULLEN');
    define('MYSQL_DATABASENAAM',   'INVULLEN');
    // Alle foutmeldingen op de live server uitschakelen
    error_reporting(0);
}

/**
 * Configuratie voor mysql_connect() zonder argumenten
 * @link http://www.php.net/manual/en/mysql.configuration.php
 */ 
@ini_set('mysql.default_host',     MYSQL_SERVER);
@ini_set('mysql.default_user',     MYSQL_GEBRUIKERSNAAM);
@ini_set('mysql.default_password', MYSQL_WACHTWOORD);

/**
 * Configuratie voor mysqli_connect() zonder argumenten
 * @link http://www.php.net/manual/en/mysqli.configuration.php
 */ 
if (extension_loaded('mysqli')) {
    @ini_set('mysqli.default_host', MYSQL_SERVER);
    @ini_set('mysqli.default_user', MYSQL_GEBRUIKERSNAAM);
    @ini_set('mysqli.default_pw',   MYSQL_WACHTWOORD);
}

ini_set('session.save_path', $sRoot.'sessions');
ini_set('session.name', 'SID');
session_start();

/**
 * zet de error handler
 */
set_error_handler('handleError');
function handleError($p_nNr, $p_sMelding, $p_sFile, $p_nLine, $p_aContext) {
	echo('FOUT ['.$p_nNr.'] : '.$p_sMelding. ' in '. $p_sFile . ' - regel '.$p_nLine.'<br />');
}
/**
 * Stel de standaard exceptionafhandeling in 
 */
set_exception_handler("handleException");
function handleException($p_oException) {
	if ($p_oException instanceof WebsiteException) {
		// eigen Exceptions hebben een log-methode
		$p_oException->log();
	} else {
		$sStackTrace = str_replace("\n", '<br/>',$p_oException->getTraceAsString());
		echo ('FATAL EXCEPTION: '.get_class($p_oException).' - '.$p_oException->getMessage().'<br/>'.$sStackTrace);
	}
}

/**
 * Deze klassen worden altijd gebruikt en hoeven niet lazy geladen te worden
 */
require_once('smarty-3.1.29/libs/Smarty.class.php');
require_once('Exceptions.class.php');

/**
 * __autoload
 * magische functie autoload wordt gebruikt om dynamisch klassen te includen  
 * @author Peter Meint Heida <pieem105@gmail.com>
 * @param  string $p_sClass
 * @param  string $p_sDir
 * @return bool
 */
spl_autoload_register('bcriantoAutoload');
function bcriantoAutoload($p_sClass, $p_sDir = null ) {
	/* zet deze code aan, om alle geladen klassen te bekijken */
	if ($fp = @fopen('log/autoload.log', 'a+')) {
		fwrite($fp, 'bcriantoAutoload: including class - '.$p_sClass.'\n');
		fclose($fp);
	}

    if ( is_null( $p_sDir ) )
      $p_sDir = ROOT;
 
    foreach ( scandir( $p_sDir ) as $file ) {
 
      // directory?
      if ( is_dir( $p_sDir.$file ) && substr( $file, 0, 1 ) !== '.' )
        bcriantoAutoload( $p_sClass, $p_sDir.$file.'/' );
 
      // php file?
      if ( substr( $file, 0, 2 ) !== '._' && preg_match( "/.php$/i" , $file ) ) {
 
        // filename matches class?
        if ( str_replace( '.php', '', $file ) == $p_sClass || str_replace( '.class.php', '', $file ) == $p_sClass ) {
            require_once($p_sDir . $file);
        }
      }
    }
/*
		  
	switch($p_sClass) {
		case 'SMTP' :
			require_once(ROOT . 'classes/phpmailer/class.smtp.php');
		break;
		case 'PHPMailer' :
			require_once(ROOT . 'classes/phpmailer/class.phpmailer.php');
		break;
		default :	require_once($p_sClass.'.class.php');
	}
*/
}
// zet het standaard debug log pad
$oDebug = Debug::instantiate();
$oDebug->setOutput(Debug::OUTPUT_FILE);
$oDebug->setLogfile('log/debug.log');


/**
 * Algemene configuratie
 */ 

// Hieronder de Nederlands namen van de maand 
 
$GLOBALS['aMaanden']=array(
	1 => 'januari',
	'februari',
	'maart',
	'april',
	'mei',
	'juni',
	'juli',
	'augustus',
	'september',
	'oktober',
	'november',
	'december'
);

/**
 * Locale
 * 
 * De locale instellen op Nederlands en Nederland
 * en de datum- en tijdzone instellen op Amsterdam.
 * 
 * @link http://www.php.net/manual/en/function.setlocale.php
 * @link http://www.php.net/manual/en/timezones.php
 */
setlocale(LC_ALL, 'nl_NL', 'nld_nld', 'Dutch_Netherlands');
date_default_timezone_set('Europe/Amsterdam');
@ini_set('date.timezone', 'Europe/Amsterdam');
?>