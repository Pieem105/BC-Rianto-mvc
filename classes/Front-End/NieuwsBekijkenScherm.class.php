<?php
/**
 * Bestand	: NieuwsBekijkenScherm.class.php
 * Schrijver: Peter Meint Heida
 * Datum	: 08-01-2016
 *
 *
 * Revisie 1.1 26-01-2016 Peter Meint Heida
 * Gewijzigd : Rechten bij aanroep parent in constructor gewijzigd.
 *
 */

/**
 * NieuwsBekijkenScherm
 */
class NieuwsBekijkenScherm extends Scherm {
	
	public function __construct() {
		parent::__construct('Nieuws bekijken',array(	Gebruiker::ADMIN,
														Gebruiker::NIEUWS_BEKIJKEN,
														Gebruiker::NIEUWS_AANPASSEN));
	} 

	/**
	* bouwScherm bouwt het scherm op
	* @return boolean False als er iets mis is gegaan, anders true
	*/
	public function bouwScherm() {
		$this->m_aData['categories'] = '';
		$this->m_aData['postlink'] = SchermGenerator::genereerLink(SchermGenerator::NIEUWS_TOEVOEGEN); 
		$this->m_sTemplate = 'nieuwstoevoegenpagina.tpl';	
		$this->m_sHTMLpagina = 'html/'.get_class($this).'.html';
		return true;
	}	
}
?>