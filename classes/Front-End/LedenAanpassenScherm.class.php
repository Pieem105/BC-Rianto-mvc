<?php
/**
 * Bestand	: LedenAanpassenScherm.class.php
 * Schrijver: Peter Meint Heida
 * Datum	: 08-01-2016
 *
 * Revisie 1.1 26-01-2016 Peter Meint Heida
 * Gewijzigd : Rechten toegevoegd als parameter bij de aanroep van de parent-constructor.
 *
 */

/**
 * LedenAanpassenScherm
 */
class LedenAanpassenScherm extends Scherm {
	
	public function __construct() {
		parent::__construct('Leden aanpassen', array(	Gebruiker::ADMIN,
														Gebruiker::LEDEN_AANPASSEN);
	} 

	/**
	* bouwScherm bouwt het scherm op
	* @return boolean False als er iets mis is gegaan, anders true
	*/
	public function bouwScherm() {
		$this->m_aData['categories'] = '';
		$this->m_aData['postlink'] = SchermGenerator::genereerLink(SchermGenerator::LEDEN_AANPASSEN); 
		$this->m_sTemplate = 'ledenaanpassenpagina.tpl';	
		$this->m_sHTML = '<h2>Leden aanpassen</h2>';
		return true;
	}	
}
?>