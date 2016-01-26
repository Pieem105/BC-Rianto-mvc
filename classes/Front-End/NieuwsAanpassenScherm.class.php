<?php
/**
 * Bestand	: NieuwsAanpassenScherm.class.php
 * Schrijver: Peter Meint Heida
 * Datum	: 08-01-2016
 *
 * Revisie 1.1 26-01-2016 Peter Meint Heida
 * Gewijzigd : Rechten bij aanroep parent in constructor toegevoegd.
 *
 */

/**
 * NieuwsAanpassenScherm
 */
class NieuwsAanpassenScherm extends Scherm {
	
	public function __construct() {
		parent::__construct('Nieuws aanpassen',array(	Gebruiker::ADMIN,
														Gebruiker::NIEUWS_AANPASSEN));
	} 

	/**
	* bouwScherm bouwt het scherm op
	* @return boolean False als er iets mis is gegaan, anders true
	*/
	public function bouwScherm() {
		$this->m_aData['categories'] = '';
		$this->m_aData['postlink'] = SchermGenerator::genereerLink(SchermGenerator::NIEUWS_VERWIJDEREN); 
		$this->m_sTemplate = 'nieuwsverwijderenpagina.tpl';	
		$this->m_sHTMLpagina = 'html/'.get_class($this).'.html';
		return true;
	}	
}
?>