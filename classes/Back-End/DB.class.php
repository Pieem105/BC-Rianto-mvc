<?php
/**
 * Bestand	: DB.class.php
 * Schrijver: Peter Meint Heida
 * Datum	: 26-01-2016
 *
 * Revisie 1.# ##-##-2016 Peter Meint Heida
 * toegevoegd: ---
 * Gewijzigd : ---
 * verwijderd: ---
 *
 */
 
/**
 * DB wrapper class for PDO
 */
class DB extends PDO {
	
	private $m_sHost;

	function __construct() {
		parent::__construct("mysql:host=".MYSQL_SERVER.";dbname=".MYSQL_DATABASENAAM, MYSQL_GEBRUIKERSNAAM, MYSQL_WACHTWOORD);
		$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
}
?>