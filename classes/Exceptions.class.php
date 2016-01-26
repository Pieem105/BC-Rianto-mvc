<?php
/**
 * Bestand	: Controller.class.php
 * Schrijver: Peter Meint Heida
 * Datum	: 23-12-2015
 */

/**
 * WebsiteException
 */
class WebsiteException extends Exception {
	public function log($p_sFile = '') {
		$sPath = dirname($_SERVER['SCRIPT_FILENAME']).'/log';
		$sFile = $sPath.'/exceptions.log';
		if (strlen($p_sFile) > 0) {
			$sFile = $p_sFile;
		}
		if (($fp = @fopen($sFile, 'a')) !== false) {
			$sTekst = strftime("%d-%m-%Y %H:%M:%S").' - ['.get_class($this).'] : '. $this->getMessage() 
			.' in '. $this->getFile() . ' ('.$this->getLine().")".PHP_EOL;
			@fwrite($fp, $sTekst);
			@fwrite($fp, '\t'.$this->getTraceAsString().PHP_EOL);
		}
	}
	
	public function convertException($p_Exception) {
		$this->message = $p_Exception->getMessage();
		$this->code = $p_Exception->getCode();
		$this->file = $p_Exception->getFile();
		$this->line = $p_Exception->getLine();
	}
}
/**
 * InvalidPropertyException
 */
class OngeldigeEigenschapException extends WebsiteException {}
class VerkeerdTypeException extends WebsiteException {}
class IllegaleWaardeException extends WebsiteException {}
class ValidatieException extends WebsiteException {}
class OnvoldoendeRechtenException extends WebsiteException {}

// IOException thrown by Debug
class IOException extends WebsiteException {}
?>