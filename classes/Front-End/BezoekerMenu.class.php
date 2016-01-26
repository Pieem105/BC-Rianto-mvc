<?php
/**
 * Bestand	: BezoekerMenu.class.php
 * Schrijver: Peter Meint Heida
 * Datum	: 05-01-2015
 */
 
/**
 * BezoekerMenu 
 * @access public
 */
class BezoekerMenu extends Menu {
	
	/**
	 * constructor
	 */
	public function __construct($p_aRechten) {
		parent::__construct('Bezoeker', $p_aRechten);
	}
	
	public function genereerMenu($p_aRechten) {
		$this->addHoofdMenupunt('over ons', 'Over Ons', '#');
		$this->addHoofdMenupunt('competitie', 'Competitie', '#');
		$this->addHoofdMenupunt('recreanten', 'Recreanten', SchermGenerator::genereerLink(SchermGenerator::RECREANTEN));
		$this->addHoofdMenupunt('jeugd', 'Jeugd', SchermGenerator::genereerLink(SchermGenerator::JEUGD));
		$this->addHoofdMenupunt('informatie', 'Info', '#');
		$this->addHoofdMenupunt('agenda', 'Agenda', SchermGenerator::genereerLink(SchermGenerator::AGENDA));
		$this->addHoofdMenupunt('contact', 'Contact', SchermGenerator::genereerLink(SchermGenerator::CONTACT));
		$this->addHoofdMenupunt('inloggen', 'Inloggen', SchermGenerator::genereerLink(SchermGenerator::INLOGGEN));
		$this->addSubMenupunt('over ons', 'geschiedenis', 'Geschiedenis', SchermGenerator::genereerLink(SchermGenerator::GESCHIEDENIS));
		$this->addSubMenupunt('over ons', 'bestuur', 'Bestuur', SchermGenerator::genereerLink(SchermGenerator::BESTUUR));
		$this->addSubMenupunt('over ons', 'commissies', 'Commissies', SchermGenerator::genereerLink(SchermGenerator::COMMISSIES));
		$this->addSubMenupunt('competitie', 'training', 'Training', SchermGenerator::genereerLink(SchermGenerator::TRAINING));
		$this->addSubMenupunt('competitie', 'najaarscompetitie', 'Najaar', SchermGenerator::genereerLink(SchermGenerator::NAJAARSCOMPETITIE));
		$this->addSubMenupunt('competitie', 'voorjaarscompetitie', 'Voorjaar', SchermGenerator::genereerLink(SchermGenerator::VOORJAARSCOMPETITIE));
		$this->addSubMenupunt('competitie', 'teams', 'Teams', SchermGenerator::genereerLink(SchermGenerator::TEAMS));
		$this->addSubMenupunt('informatie', 'accomodaties', 'Accomodaties', SchermGenerator::genereerLink(SchermGenerator::ACCOMODATIES));
		$this->addSubMenupunt('informatie', 'nieuwsbrieven', 'Nieuwsbrieven', SchermGenerator::genereerLink(SchermGenerator::NIEUWSBRIEVEN));
		$this->addSubMenupunt('informatie', 'watbiedenwij', 'Wat bieden wij?', SchermGenerator::genereerLink(SchermGenerator::WATBIEDENWIJ));
	}
}
?>