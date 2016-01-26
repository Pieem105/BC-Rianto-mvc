<?php
/**
 * Bestand	: LidVerwijderenScherm.class.php
 * Schrijver: Peter Meint Heida
 * Datum	: 08-01-2016
 */

/**
 * LidVerwijderenScherm
 */
class LidVerwijderenScherm extends Scherm {
	
	public function __construct() {
		parent::__construct('Lid verwijderen'/*, array()*/);
	} 

	/**
	* bouwScherm bouwt het scherm op
	* @return boolean False als er iets mis is gegaan, anders true
	*/
	public function bouwScherm() {
		$this->m_aData['categories'] = '';
		$this->m_aData['postlink'] = SchermGenerator::genereerLink(SchermGenerator::LID_VERWIJDEREN); 
		$this->m_sTemplate = 'lidverwijderenpagina.tpl';	
		$this->m_sHTMLpagina = 'html/'.get_class($this).'.html';
		return true;
	}	
}
?>