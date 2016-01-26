<?php
/**
 * Bestand	: Menu.class.php
 * Schrijver: Peter Meint Heida
 * Datum	: 05-01-2015
 */

/**
 * Menu basisklasse voor menutypen
 * @abstract
 */
abstract class Menu {
	protected $m_sNaam;
	protected $m_aHoofdMenu;
	protected $m_aSubMenu;
	
	public function __construct($p_sNaam, $p_aRechten) {
		$this->m_sNaam = $p_sNaam;
		$this->m_aHoofdMenu = array();
		$this->m_aSubMenu = array();
		$this->genereerMenu($p_aRechten);
	}
	
	/**
	 * addHoofdMenupunt Voegt een menupunt toe aan het hoofdmenu
	 * 
	 * @access public
	 * @param string $p_sNaam De naam van het menupunt zoals getoond aan de gebruiker
	 * @param string $p_sLink De link als op het menupunt wordt geklikt
	 * @return boolean True als menupunt is toegevoegd, false bij fout of al bestaand menupunt 
	 */
	public function addHoofdMenupunt($p_sHoofdMenuId, $p_sNaam, $p_sLink) {
		$bResult = false;
		if (is_string($p_sNaam) && (!isset($this->m_aHoofdMenu[$p_sNaam]))) {
			$this->m_aHoofdMenu[$p_sHoofdMenuId] = array('titel' => $p_sNaam, 'link' => $p_sLink);
		}
		return $bResult;
	}

	/**
	 * addSubMenupunt Voegt een submenupunt toe aan het menu
	 * 
	 * @access public
	 * @param string $p_sNaam De naam van het menupunt zoals getoond aan de gebruiker
	 * @param string $p_sLink De link als op het menupunt wordt geklikt
	 * @return boolean True als menupunt is toegevoegd, false bij fout of al bestaand menupunt 
	 */
	public function addSubMenupunt($p_sHoofdMenuId, $p_sSubMenuId, $p_sNaam, $p_sLink) {
		$bResult = false;
		
		if (is_string($p_sNaam)) {
			$this->m_aSubMenu[$p_sHoofdMenuId][$p_sSubMenuId] = array('titel' => $p_sNaam, 'link' => $p_sLink);
		}
		return $bResult;
	}
	
	/**
	 * getData Geeft de data van het menu terug (voor gebruik in Smarty)
	 * 
	 * menu data wordt teruggegeven in een geassocieerde array met 'hoofdmenu' en 'submenu'  
	 * @return array
	 */
	public function getData() {
		$aResult = array('hoofdmenu' => $this->m_aHoofdMenu, 'submenu' => $this->m_aSubMenu);;
		return $aResult;
	}
	
	abstract public function genereerMenu($p_aRechten);
}
?>