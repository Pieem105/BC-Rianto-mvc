<?php
/**
 * $RCSfile: ErrorScherm.class.php,v $
 * Author: $Author: wouter $
 * Date: $Date: 2008/03/17 16:38:11 $
 * @package complete-php-boek
 * History: 
 * $Log: ErrorScherm.class.php,v $
 * Revision 1.1  2008/03/17 16:38:11  wouter
 * added importXML
 * and rights parameter to Scherm constructor
 *
 */

/**
 * ErrorScherm Toont een opgetreden fout
 */
class ErrorScherm extends Scherm {
	
	public function __construct() {
		parent::__construct('Webshop error', array());
	} 

	/**
	* bouwScherm bouwt het zoekresultaatscherm op
	* @param array $p_aGegevens geassocieerde array met artikelgegevens
	* @return boolean False als er iets mis is gegaan, anders true
	*/
	public function bouwScherm() {
		if (Registry::exists('Exception')) {
			$oException = Registry::get('Exception');
			$this->m_sTemplate = 'error.tpl';
			$this->m_aData['exception'] = array('message' =>$oException->getMessage(), 'trace' => $oException->getTraceAsString()); 
		} else {
			$this->m_sTemplate = 'error.tpl';
			$this->m_aData['exception'] = array('message' => 'Onbekende fout!', 'trace' => ''); 
		}
		return true;
	}	
}
?>