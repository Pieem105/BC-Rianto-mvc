<?php
/**
 * Bestand	: BeheerScherm.class.php
 * Schrijver: Peter Meint Heida
 * Datum	: 15-01-2016
 */

/**
 * BeheerScherm
 */
class BeheerScherm extends Scherm {
	
//	protected $p_nPagina;

	public function __construct() {
//		$this->m_nPagina = $p_nPaginaId;
		parent::__construct('Beheer', array(Gebruiker::ADMIN,
											Gebruiker::LEDEN_BEKIJKEN,
											Gebruiker::LEDEN_AANPASSEN,
											Gebruiker::NIEUWS_AANPASSEN));
	} 

	/**
	* bouwScherm bouwt het scherm op
	* @return boolean False als er iets mis is gegaan, anders true
	*/
	public function bouwScherm() {
		$this->m_aData['categories'] = '';
		$this->m_aData['postlink'] = SchermGenerator::genereerLink(SchermGenerator::BEHEER); 
		$this->addScript('');
		$this->m_sTemplate = 'beheerpagina.tpl';

		$this->m_sHTML = "<h3>Kies in het menu!</h3>";

		return true;
	}	
}
?>