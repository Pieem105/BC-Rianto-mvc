<?php
/**
 * Bestand	: UitlogScherm.class.php
 * Schrijver: Peter Meint Heida
 * Datum	: 19-01-2015
 */

/**
 * UitlogScherm
 */
class UitlogScherm extends Scherm {
	
	public function __construct() {
		parent::__construct('Uitloggen', array());
	}
	
	/**
	 * handlePagina	controleer of er inloggegevens zijn gepost, zo ja, log in en redirect naar homepage
	 * @throws WebsiteException
	 */
	public function handlePagina() {
		// standaard wordt dit scherm getoond 
		$oResult = $this;
		if (Registry::exists('Bezoeker')) {
			$oGebruiker = Registry::get('Bezoeker');
		} else {
			// gebruiker moet al bestaan, dus fout
			throw new WebsiteException('Gebruiker object bestaat niet');
		}	
		if ($oGebruiker->isIngelogd()) {
			// Gebruiker wordt uitgelogd
			$oGebruiker->logout();
			$oResult = SchermGenerator::genereerSchermObject(SchermGenerator::WELKOM);
		} else {
			// gebruiker was al eerder uitgelogd / niet ingelogd, ga naar homepage
			$oResult = SchermGenerator::genereerSchermObject(SchermGenerator::WELKOM);
		}		
		return $oResult;
	}

	/**
	* bouwScherm bouwt het zoekresultaatscherm op
	* @param array $p_aGegevens geassocieerde array met artikelgegevens
	* @return boolean False als er iets mis is gegaan, anders true
	*/
	public function bouwScherm() {
		$this->m_sTemplate = 'loguit.tpl';
		$this->m_aData['postlink'] = SchermGenerator::genereerLink(SchermGenerator::UITLOGGEN);
		return true;
	}	
}
?>