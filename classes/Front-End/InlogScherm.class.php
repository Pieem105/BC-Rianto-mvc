<?php
/**
 */

/**
 * InlogScherm
 */
class InlogScherm extends Scherm {
	
	public function __construct() {
		parent::__construct('Inloggen', array());
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
		if (!$oGebruiker->isIngelogd()) {
			// gebruiker was nog niet ingelogd
			$oValidator = InputValidator::instantiate();
			$oValidator->addValidation('gebruiker', InputValidator::SCOPE_POST, InputValidator::TYPE_STRING, true);
			$oValidator->addValidation('wachtwoord', InputValidator::SCOPE_POST, InputValidator::TYPE_STRING, true);
			if ($oValidator->validateAll() == InputValidator::RESULT_OK) {
				// inloggegevens gepost
				if ($oGebruiker->login($oValidator->getValue('gebruiker', InputValidator::SCOPE_POST), $oValidator->getValue('wachtwoord', InputValidator::SCOPE_POST))) {
					// login gelukt
					$oResult = SchermGenerator::genereerSchermObject(SchermGenerator::BEHEER);
				}
			}
		} else {
			// gebruiker was al eerder ingelogd, ga naar homepage
			$oResult = SchermGenerator::genereerSchermObject(SchermGenerator::BEHEER);
		}		
		return $oResult;
	}

	/**
	* bouwScherm bouwt het zoekresultaatscherm op
	* @param array $p_aGegevens geassocieerde array met artikelgegevens
	* @return boolean False als er iets mis is gegaan, anders true
	*/
	public function bouwScherm() {
		$this->m_sTemplate = 'login.tpl';
		$this->m_aData['postlink'] = SchermGenerator::genereerLink(SchermGenerator::INLOGGEN);
		return true;
	}	
}
?>