<?php
/**
 * Bestand	: MenuGenerator.class.php
 * Schrijver: Peter Meint Heida
 * Datum	: 19-01-2015
 *
 * Revisie 1.1  19-01-2016 Peter Meint Heida
 * Toegevoegd: $p_aRechten als parameter toegevoegd aan de functie genereerMenuObject
 *             t.b.v. aanmaken van menu op basis van rechten.
 *
 */
 

/**
 * MenuGenerator	MenuGenerator klasse dat menuobjecten genereert
 * @abstract
 */
abstract class MenuGenerator {
	const BEZOEKER = 1;
	const BEHEER   = 50;
	
	/**
	 * genereerMenuObject Generator methode: genereert een Menu object aan de hand van het opgegeven type
	 * 
	 * @static
	 * @param int $p_nType	Het te genereren type object
	 * @return Menu Object afgeleid van Menu
	 * @throws InvalidTypeException
	 */
	public static function genereerMenuObject($p_nType, $p_aRechten) {
		$oResult = null;
		switch ($p_nType) {
			case self::BEHEER : 
				$oResult = new AdministratieMenu($p_aRechten);
			break;
			case self::BEZOEKER : 
				$oResult = new BezoekerMenu(array());
			break;
			default :
				throw new OngeldigTypeException('Menu type onbekend');
		}
		return $oResult;
	} 
}
?>