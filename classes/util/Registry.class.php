<?php
/**
 */

/**
 * Registry Deze klasse implementeert het Registry design pattern
 * 
 * @abstract
 */
abstract class Registry {
	/**
	 * @var array $m_aObjects bevat de lijst met objecten
	 */
	private static $m_aObjects = array();
	
	/**
	 * add Voeg objecten toe aan de registry
	 * 
	 * Als geen naam wordt opgegeven, wordt de naam van de klasse gebruikt
	 * @static
	 * @access public
	 * @param Object $p_oItem Het toe te voegen object
	 * @param string $p_sName Optionele naam in de lijst
	 * @return boolean True als het object is toegevoegd, false bij fout
	 * @throws WebshopException
	 */
	public static function add($p_oItem, $p_sName = '') {
		$bResult = false;
		if (is_object($p_oItem)) {
			$sName = $p_sName;
			if ($sName == '') {
				$sName = get_class($p_oItem);
			}
			self::$m_aObjects[$sName] = $p_oItem;
			$bResult = true;
		} else {
			throw new WebshopException('Alleen objecten worden in de registry opgeslagen');
		}
		return $bResult;
	} 
	
	/**
	 * get Vraag een object op
	 * 
	 * Deze method levert een referentie naar het opgevraagde object terug
	 * @access public
	 * @static
	 * @param string $p_sName De naam van het object in de lijst
	 * @return Object Het object als deze bestaat, WebshopException als het object niet bestaat
	 * @throws WebshopException
	 */
	public static function get($p_sName) {
		$oResult = null;
		if (isset(self::$m_aObjects[$p_sName])) {
			$oResult = self::$m_aObjects[$p_sName];
		} else {
			throw new WebshopException('Gevraagde object niet in de Registry aanwezig');
		}
		return $oResult;
	}
	
	/**
	 * exists Controleer of een object met de gegeven naam bestaat in de lijst
	 * 
	 * @access public
	 * @static
	 * @param string $p_sName De naam van het object in de lijst
	 * @return boolean True als het object bestaat, false als het niet bestaat
	 */
	public static function exists($p_sName) {
		$bResult = false;
		if (isset(self::$m_aObjects[$p_sName])) {
			$bResult = true;
		}
		return $bResult;
	}
}
?>