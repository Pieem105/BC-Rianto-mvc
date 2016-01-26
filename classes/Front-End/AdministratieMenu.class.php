<?php
/**
 * Bestand	: AdministratieMenu.class.php
 * Schrijver: Peter Meint Heida
 * Datum	: 23-12-2015
 * 
 * Revisie 1.1 	Menu wordt nu samengesteld op basis van de rechten die als parameter worden meegegeven 
 *				aan de functie genereerMenu 
 */

/**
 * AdministratieMenu 
 * @access public
 */
class AdministratieMenu extends Menu {
	
	/**
	 * constructor
	 */
	public function __construct($p_aRechten) {
		parent::__construct('Administratie',$p_aRechten);
	}
	
	/**
	 * genereerMenu
	 * @todo verwijderen van leden
	 * @todo toevoegen van leden
	 * @todo verwijderen van nieuws
	 * @todo toevoegen van nieuws
	 */
	public function genereerMenu($p_aRechten) {

		$this->addHoofdMenupunt('nieuwsbekijken', 'Nieuws bekijken', SchermGenerator::genereerLink(SchermGenerator::NIEUWS_BEKIJKEN));
		if(!(array_search(1,$p_aRechten)=== false) || !(array_search(7,$p_aRechten)=== false)) {
			$this->addHoofdMenupunt('nieuwsaanpassen', 'Nieuws aanpassen', SchermGenerator::genereerLink(SchermGenerator::NIEUWS_AANPASSEN));
		} 
		if(!(array_search(2,$p_aRechten)=== false) || !(array_search(7,$p_aRechten)=== false)) {
			$this->addHoofdMenupunt('ledenbekijken', 'Ledenlijst bekijken', SchermGenerator::genereerLink(SchermGenerator::LEDEN_BEKIJKEN));
		} 
		if(!(array_search(4,$p_aRechten)=== false) || !(array_search(7,$p_aRechten)=== false)) {	
			$this->addHoofdMenupunt('ledenaanpassen', 'Leden aanpassen', SchermGenerator::genereerLink(SchermGenerator::LEDEN_AANPASSEN));
		}
		
		$this->addHoofdMenupunt('uitloggen', 'Uitloggen', SchermGenerator::genereerLink(SchermGenerator::UITLOGGEN));
	}
}
?>