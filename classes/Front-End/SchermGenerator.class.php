<?php
/**
 * Bestand	: SchermGenerator.class.php
 * Schrijver: Peter Meint Heida
 * Datum	: 23-12-2015
 *
 * Revisie 1.? ##-##-2016 Peter Meint Heida
 * Toegevoegd: ---
 * Gewijzigd : ---
 * Verwijderd: ---
 *
 */

/**
 * SchermFabriek Factory klasse dat scherm objecten genereert
 * @abstract
 */
abstract class SchermGenerator {
	const WELKOM = 1;

	const VERENIGING = 10;
	const GESCHIEDENIS = 11;
	const BESTUUR = 12;
	const COMPETITIE = 13;
	const RECREANTEN = 14;
	const JEUGD = 15;
	const NIEUWS = 16;
	const AGENDA = 17;
	const CONTACT = 18;
	const COMMISSIES = 19;
	const TRAINING = 20;
	const NAJAARSCOMPETITIE = 21;
	const VOORJAARSCOMPETITIE = 22;
	const TEAMS = 23;
	const ACCOMODATIES = 24;
	const NIEUWSBRIEVEN = 25;
	const WATBIEDENWIJ = 26;
	
	const BEHEER = 50;
	const INLOGGEN = 51;
	const UITLOGGEN = 52;

	const LEDEN_BEKIJKEN = 60;
	const LEDEN_AANPASSEN = 61;
	const NIEUWS_BEKIJKEN = 62;
	const NIEUWS_AANPASSEN = 63;
	
	const ERRORPAGE = 0;

	/**
	 * genereerSchermObject Factory methode die een scherm object van het gegeven type genereert
	 * 
	 * @static
	 * @param int $p_nPagina Het type van het scherm dat gegenereerd moet worden
	 * @return Scherm Object dat is afgeleid van de Scherm klasse
	 * @throws InvalidTypeException
	 */
	public static function genereerSchermObject($p_nPagina) {
		$oResult = null;
		try {
			switch ($p_nPagina) {
				case self::WELKOM :
					$oResult = new BezoekerScherm($p_nPagina, 'Welkom');
				break;
				case self::BEHEER :
					$oResult = new BeheerScherm();
				break;
				case self::INLOGGEN :
					$oResult = new InlogScherm();
				break;
				case self::UITLOGGEN :
					$oResult = new UitlogScherm();
				break;
				case self::VERENIGING :
					$oResult = new BezoekerScherm($p_nPagina, 'Vereniging');
				break;
				case self::GESCHIEDENIS :
					$oResult = new BezoekerScherm($p_nPagina, 'Geschiedenis');
				break;
				case self::BESTUUR :
					$oResult = new BezoekerScherm($p_nPagina, 'Bestuur');
				break;
				case self::COMPETITIE :
					$oResult = new BezoekerScherm($p_nPagina, 'Competitie');
				break;
				case self::RECREANTEN :
					$oResult = new BezoekerScherm($p_nPagina, 'Recreanten');
				break;
				case self::JEUGD :
					$oResult = new BezoekerScherm($p_nPagina, 'Jeugd');
				break;
				case self::NIEUWSBRIEVEN :
					$oResult = new BezoekerScherm($p_nPagina, 'Niewsbrieven');
				break;
				case self::NIEUWS :
					$oResult = new BezoekerScherm($p_nPagina, 'Nieuws');
				break;
				case self::AGENDA :
					$oResult = new BezoekerScherm($p_nPagina, 'Agenda');
				break;
				case self::CONTACT :
					$oResult = new BezoekerScherm($p_nPagina, 'Contact');
				break;
				case self::COMMISSIES :
					$oResult = new BezoekerScherm($p_nPagina, 'Commissies');
				break;
				case self::NAJAARSCOMPETITIE :
					$oResult = new BezoekerScherm($p_nPagina, 'Najaarscompetitie');
				break;
				case self::VOORJAARSCOMPETITIE :
					$oResult = new BezoekerScherm($p_nPagina, 'Voorjaarscompetitie');
				break;
				case self::ACCOMODATIES :
					$oResult = new BezoekerScherm($p_nPagina, 'Accomodaties');
				break;
				case self::WATBIEDENWIJ :
					$oResult = new BezoekerScherm($p_nPagina, 'Wat bieden wij');
				break;
				case self::LEDEN_BEKIJKEN :
					$oResult = new LedenBekijkenScherm();
				break;
				case self::LEDEN_BEKIJKEN :
					$oResult = new LedenAanpassenScherm();
				break;
				case self::NIEUWS_BEKIJKEN :
					$oResult = new NieuwsBekijkenScherm();
				break;
				case self::NIEUWS_AANPASSEN :
					$oResult = new NieuwsAanpassenScherm();
				break;
				case self::ERRORPAGE :
					$oResult = new ErrorScherm();
				break;
 				default :
					throw new InvalidTypeException('Ongeldige pagina '.$p_nPagina);
			}
		} catch (OnvoldoendeRechtenException $e) {
			// onvoldoende rechten om gevraagde scherm op te vragen.
			$oResult = new BezoekerScherm(self::ERRORPAGE, 'Onvoldoende rechten');
		} catch (Exception $e) {
			Registry::add($e, 'Exception');
			$oResult = new ErrorScherm();
		}
		return $oResult;
	} 
	/**
	 * genereerLink Genereert een HTTP link naar de opgegeven pagina
	 * 
	 * @static
	 * @param int $p_nPagina De pagina waarnaar een link moet worden gegenereerd
	 * @return string De Link
	 * @throws InvalidTypeException
	 */
	public static function genereerLink($p_nPagina) {
		$sLink = 'index.php';
		// voeg anticache toe
		$sLink .= '?t='.mt_rand(0,1000000);
		switch ($p_nPagina) {
			case self::WELKOM :
			case self::BEHEER :
			case self::ERRORPAGE :
			case self::INLOGGEN :
			case self::UITLOGGEN :
			case self::VERENIGING :
			case self::GESCHIEDENIS :
			case self::BESTUUR :
			case self::COMPETITIE :
			case self::RECREANTEN :
			case self::JEUGD :
			case self::NIEUWS :
			case self::AGENDA :
			case self::CONTACT :
			case self::COMMISSIES :
			case self::TRAINING :
			case self::NAJAARSCOMPETITIE :
			case self::VOORJAARSCOMPETITIE :
			case self::TEAMS :
			case self::ACCOMODATIES :
			case self::NIEUWSBRIEVEN :
			case self::WATBIEDENWIJ :
			case self::LEDEN_BEKIJKEN :
			case self::LEDEN_AANPASSEN :
			case self::NIEUWS_BEKIJKEN :
			case self::NIEUWS_AANPASSEN :
				$sLink .= '&page='.$p_nPagina;
			break;
			default :
				throw new InvalidTypeException('Ongeldige pagina');
		}
		return $sLink;
	}
}
?>