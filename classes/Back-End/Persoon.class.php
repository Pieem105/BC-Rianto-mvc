<?php
/**
 * Bestand	: Persoon.class.php
 * Schrijver: Peter Meint Heida
 * Datum	: 13-01-2016
 */

/**
 * Persoon
 */
class Persoon  implements iXMLExporter, iBewaarbaar {
	protected $m_nId;
	protected $m_sVoornaam;
	protected $m_sTussenvoegsel;
	protected $m_sAchternaam;
	protected $m_sGeslacht;
	protected $m_sEmail;
	protected $m_aTelefoonnrs;
	protected $m_aAdressen;
	

	public function __construct() {
		$this->m_nId = -1;
		$this->m_sVoornaam = '';
		$this->m_sTussenvoegsel = '';
		$this->m_sAchternaam = '';
		$this->m_sGeslacht = 'b';
		$this->m_sEmail = '';
		$this->m_aTelefoonnrs['vast'] = '';
		$this->m_aTelefoonnrs['mobiel'] = '';
		$this->m_aAdressen['huis'] = '';
		$this->m_aAdressen['vast'] = '';
	}

	/**
	 * setter
	 * @throws IllegalValueException, InvalidPropertyException
	 */
	public function __set($p_sProperty, $p_vValue) {
		switch ($p_sProperty) {
			case "Id" :
				if (is_numeric($p_vValue)) {
					// zorg dat het type klopt (integer)
					$nId = intVal($p_vValue);
					if ($nId >= -1) { 
						$this->m_nId = $p_vValue;
					} else {
						throw new IllegalValueException('Id ongeldig: '.$nId);
					}
				} else {
					throw new IllegalValueException('Id ongeldig: '.$p_vValue);
				}
			break;
			case "Voornaam" :
					if (CheckLib::checkAlphaText($p_vValue)) { 
						$this->m_sVoornaam = $p_vValue;
					} else {
						// geef foutmelding
						throw new IllegalValueException('Ongeldige Voornaam: '.$p_vValue);
					}
			break;
			case "Tussenvoegsel" : 
					if (CheckLib::checkAlphaText($p_vValue)) { 
						$this->m_sTussenvoegsel = $p_vValue;
					} else {
						// geef foutmelding
						throw new IllegalValueException('Ongeldige tussenvoegsel: '.$p_vValue);
					}
			break;
			case "Achternaam" : 
					if (CheckLib::checkAlphaText($p_vValue)) { 
						$this->m_sAchternaam = $p_vValue;
					} else {
						// geef foutmelding
						throw new IllegalValueException('Ongeldige Achternaam: '.$p_vValue);
					}
			break;
			case "Geslacht" :	
				if (is_string($p_vValue)) {
					$sGeslacht = strtolower($p_vValue);
					// geslacht kan man, vrouw of bedrijf zijn
					if (($sGeslacht == "m") || ($sGeslacht == "v") || ($sGeslacht == "b")) {
						$this->m_sGeslacht = $sGeslacht;
					} else {
						throw new IllegalValueException('Ongeldig geslacht: '.$sGeslacht);
					}
				} else {
						throw new IllegalValueException('Ongeldig geslacht: '.$p_vValue);
				} 
			break;
			case "Email" :
				// we staan lege email adressen toe
				if (strlen($p_vValue) > 0) {
					if (CheckLib::checkEmail($p_vValue)) { 
						$this->m_sEmail = $p_vValue;
					} else {
						// geef foutmelding
						throw new IllegalValueException('Ongeldig emailadres: '.$p_vValue);
					}
				} else {
					$this->m_sEmail = '';
				}
			break;
			case "Telefoonnrs" :
				// we staan lege Telefoonnummers toe
				if (strlen($p_vValue['vast']) > 0) {
					if (CheckLib::checkPhoneNumber($p_vValue)) { 
						$this->m_sTelefoonnrs['vast'] = $p_vValue;
					} else {
						// geef foutmelding
						throw new IllegalValueException('Ongeldig telefoonnummer: '.$p_vValue);
					}
				} else {
					$this->m_sTelefoonnrs = '';
				}
			break;
			default : throw new InvalidPropertyException($p_sProperty);
		}
	}
	/**
	 * getter
	 * @throws InvalidPropertyException
	 */
	public function __get($p_sProperty) {
		$vResult = null;
		switch ($p_sProperty) {
			case "Id" : $vResult = $this->m_nId;
			break;
			case "Voornaam" : $vResult = $this->m_sVoornaam;
			break;
			case "Tussenvoegsel" : $vResult = $this->m_sTussenvoegsel;
			break;
			case "Achternaam" : $vResult = $this->m_sAchternaam;
			break;
			case "Geslacht" : $vResult = $this->m_sGeslacht;
			break;
			case "Email" : $vResult = $this->m_sEmail;
			break;
			case "Naam" : // volledige naam (read only)
				$vResult = '';
				if (strlen($this->m_sVoornaam) > 0) {
					$vResult .= $this->m_sVoornaam;
				} 
				if (strlen($this->m_sTussenvoegsel) > 0) {
					$vResult .= ' '.$this->m_sTussenvoegsel;
				} 
				if (strlen($this->m_sAchternaam) > 0) {
					$vResult .= ' '.$this->m_sAchternaam;
				} 
			break;
			case "Telefoonnrs" : $vResult = $this->m_sTelefoonnrs;
			break;
			default : throw new InvalidPropertyException($p_sProperty);
		} 
		return $vResult;
	}
	
	/**
	 * laadGegevens Leest de gegevens van een persoon uit de database 
	 * 
	 * @access public
	 * @param integer $p_nId Het database id van de te laden persoon
	 * @return boolean True als het laden is gelukt, false als het is mislukt
	 * @throws PDOException
	 */
	public function laadGegevens($p_vId) {
		$bResult = false;
		if (is_numeric($p_vId) && (intVal($p_vId) >= 0)) {
			try {
				$oDB = new DB();
				
				$sSql = "SELECT * FROM ledenlijst WHERE lid_nummer = '".$p_vId."';";
				$oResult = $oDB->query($sSql);
				$aData = $oResult->fetch(PDO::FETCH_ASSOC);
				if (count($aData) > 0) {
					$this->m_nId = intVal($aData['lid_nummer']);
					$this->m_sVoornaam = $aData['voornaam'];
					$this->m_sTussenvoegsel = $aData['tussenvoegsel'];
					$this->m_sAchternaam = $aData['achternaam'];
					$this->m_sGeslacht = $aData['geslacht'];
					$this->m_sEmail = $aData['email'];
					$this->m_aTelefoonnrs['vast'] = $aData['telefoon_vast'];
					$this->m_aTelefoonnrs['mobiel']= $aData['telefoon_mobiel'];
					
					$this->m_aAdressen['huis'] = array('straatnaam' => $aData['straatnaam'],
													'huisnr' => $aData['huisnr'],
													'toevoegsel'=> $aData['toevoegsel'],
													'postcode'=> $aData['postcode'],
													'woonplaats'=> $aData['woonplaats']);															;
					$this->m_aAdressen['post'] = array('post_straatnaam' => $aData['post_straatnaam'],
													'post_huisnr' => $aData['post_huisnr'],
													'post_toevoegsel'=> $aData['post_toevoegsel'],
													'post_postcode'=> $aData['post_postcode'],
													'post_woonplaats'=> $aData['post_woonplaats']);
					$bResult = true;
				}
			} catch (Exception $e) {
				//echo ('Persoon::load - '.$e->getMessage());
				$bResult = false;
			}	
		} else {
			throw new IllegalValueException('Id : '.$p_vId);
		}
		return $bResult;
	}
	/**
	 * slaOp Slaat de gegevens van de persoon op in de database. 
	 * Als het Id al een waarde heeft, worden de gegevens ge-update, anders
	 * is het een nieuwe persoon.
	 * @access public
	 * @return boolean True als het opslaan is gelukt, false als het is mislukt
	 * @throws PDOException
	 */
	public function slaOp() {
		$bResult = true;
		try {
			$oDB = new DB();
			$oDB->beginTransaction();
			if ($this->Id >= 0) {
				// Id bestaat al, update record
				$sSql = "UPDATE ledenlijst SET ".
						", Voornaam = '".$this->Voornaam."'".
						", Tussenvoegsel = '".$this->Tussenvoegsel."'".
						", Achternaam = '".$this->Achternaam."'".
						", Geslacht = '".$this->Geslacht."'".
						", Email = '".$this->Email."'".
						", Telefoon_vast = '".$this->Telefoon_vast."'".
						" WHERE lid_nummer = '".$this->Id."';";
			} else {
				// Id is nieuw, insert nieuw persoon
				$sSql = "INSERT INTO ledenlijst (Voorletters, Voornaam, Tussenvoegsel, Achternaam, Geslacht, Email, Telefoon_vast, Username, Password) " .
						"VALUES (" .
						"'".$this->Voorletters."'".
						", '".$this->Voornaam."'".
						", '".$this->Tussenvoegsel."'".
						", '".$this->Achternaam."'".
						", '".$this->Geslacht."'".
						", '".$this->Email."'".
						", '".$this->Telefoonnrs."'".
						", '".$this->Rekening."'".
						", ''".
						", ''".
						")";
			}
			$oResult = $oDB->query($sSql);
			if ($this->Id < 0) {
				$this->Id = $oDB->lastInsertId();
			}
			// maak resultaat geschikt voor hergebruik
			$oResult->closeCursor();
			// we verwijderen alle huidige adressen
			$oDB->commit();
		} catch (PDOException $e) {
			$oDB->rollBack();
			$oException = new WebshopException();
			$oException->convertException($e);
			$oException->log();
			$bResult = false;
		} catch (WebshopException $e) {
			$e->log();
		} catch (Exception $e) {
			$oException = new WebshopException();
			$oException->convertException($e);
			$oException->log();
			$bResult = false;
		}
		$oDB = null;
		return $bResult;
	}
	
	/**
	 * addAdres voegt een nieuw adres toe aan de persoon
	 * 
	 * @access public
	 * @param int $p_nType Het type van het adres (ADRES_BEZOEK, ADRES_FACTUUR)
	 * @param string $p_sStraat De straat
	 * @param string $p_sHuisNr Het huisnummer
	 * @param string $p_sHuisNrExtra eventuele huisnummer toevoeging
	 * @param string $p_sPostcode de postcode van het adres
	 * @param string $p_sWoonplaats De woonplaats
	 * @return boolean True als het adres succesvol is toegevoegd, false bij een fout 
	 * @todo toevoegen controle voor unieke adrestypes
	 */
	public function addAdres($p_nType, $p_sStraat, $p_sHuisNr, $p_sHuisNrExtra, $p_sPostcode, $p_sWoonplaats) {
		$bResult = true;
		// maak een nieuw adres object aan
		$oAdres = new Adres();
		try {
			// vul het object
			$oAdres->Type = $p_nType;
			$oAdres->Straat = $p_sStraat;
			$oAdres->HuisNr = $p_sHuisNr;
			$oAdres->HuisNrExtra = $p_sHuisNrExtra;
			$oAdres->Postcode = $p_sPostcode;
			$oAdres->Woonplaats = $p_sWoonplaats;
			
			// voeg het adresobject toe aan de lijst van adressen
			$this->m_aAdressen[] = $oAdres;
		} catch (InvalidPropertyException $e) {
			$bResult = false;
		}
		
		return $bResult;
	}
	
	/**
	 * getAdres geeft het adres van een bepaald type terug
	 * @access public
	 * @param int $p_nType Het type adres dat wordt opgevraagd
	 * @return Adres Het Adres-object als dat aanwezig is, null als een niet bestaand 
	 * 			type wordt opgevraagd
	 */
	public function getAdres($p_nType) {
		$oResult = null;
		foreach($this->m_aAdressen as $oAdres) {
			if ($oAdres->Type == $p_nType) {
				$oResult = $oAdres;
				break;
			}
		}
		return $oResult;
	}
	
	/**
	 * importCSV Importeert een lijst met personen naar de database
	 * 
	 * @access public
	 * @param string $p_sBestand Naam van het importbestand
	 * @return array aantal correct geimporteerde personen en aantal foute imports
	 * @throws IllegalValueException
	 */
	/*
	public function importCSV($p_sBestand) {
		$aResult = array('correct' => 0, 'fout' => 0, 'dubbel' => 0);
		$nKolommen = 6;	// aantal te importeren kolommen
		if (file_exists($p_sBestand)) {
			$aPersonen = @file($p_sBestand, FILE_IGNORE_NEW_LINES);
			if (is_array($aPersonen)) {
				try {
					$oDB = new DB();
					$sSql = 'SELECT email FROM ledenlijst;';
					$oResult = $oDB->query($sSql);
					// bewaar alle emailadressen van bestaande klanten 
					$aKlanten = $oResult->fetchAll(PDO::FETCH_COLUMN, 0);
				} catch (PDOException $e) {
					$aKlanten = array();
				}
				$nTimeStart = microtime(true);
				foreach($aPersonen as $sRegel) {
					try {
						// creeer de insert query met te vervangen velden
						$sSql = "INSERT INTO ledenlijst (Voornaam, Tussenvoegsel, Achternaam, Geslacht, Adres, Postcode, Plaats, Email) " .
								"VALUES (" .
								"'#veld0#'".
								", '#veld1#'".
								", '#veld2#'".
								", '#veld3#'".
								", '#veld4#'".
								", ''".
								", ''".
								", ''".
								", '#veld5#'".
								", ''".
								", ''".
								")";
						$aGegevens = split(',', $sRegel);
						if (count($aGegevens == $nKolommen)) {
							// strip de aamhalingstekens 
							for ($c=0; $c < $nKolommen; $c++) {
								$aGegevens[$c] = str_replace('"', '', $aGegevens[$c]);
								// verwijder whitespaces
								$aGegevens[$c] = trim($aGegevens[$c]);
							}
							// controleer de waarden op verkeerde data
							if (!CheckLib::checkPlainText($aGegevens[0])) { throw new InvalidTypeException('Incorrecte gegevens:'.$aGegevens[0]); }
							if (!CheckLib::checkPlainText($aGegevens[1])) { throw new InvalidTypeException('Incorrecte gegevens:'.$aGegevens[1]); }
							if (!CheckLib::checkPlainText($aGegevens[2])) { throw new InvalidTypeException('Incorrecte gegevens:'.$aGegevens[2]); }
							if (!CheckLib::checkPlainText($aGegevens[3])) { throw new InvalidTypeException('Incorrecte gegevens:'.$aGegevens[3]); }
							if (!CheckLib::checkUserDefinedText("/[mv]{1}/",$aGegevens[4])) { throw new IllegalTypeException('Incorrecte gegevens:'.$aGegevens[4]); }
							if (!CheckLib::checkEmail($aGegevens[5])) { throw new InvalidTypeException('Incorrecte gegevens:'.$aGegevens[5]); }
							// controleer of lid nog niet bestaat adv het emailadres
							if (!in_array($aGegevens[5], $aLeden)) {
								// vervang de velden met de huidige waarden
								$sSql = str_replace('#veld0#', $aGegevens[0], $sSql);
								$sSql = str_replace('#veld1#', $aGegevens[1], $sSql);
								$sSql = str_replace('#veld2#', $aGegevens[2], $sSql);
								$sSql = str_replace('#veld3#', $aGegevens[3], $sSql);
								$sSql = str_replace('#veld4#', $aGegevens[4], $sSql);
								$sSql = str_replace('#veld5#', $aGegevens[5], $sSql);
								//echo($sSql.'<br />');
								$oDB->query($sSql);
								$aResult['correct']++;
							} else {
								// lid bestaat al
								$aResult['dubbel']++;
							}
						}
					} catch (IllegalTypeException $e) {
						// hou een teller bij van foute invoer (voor later gebruik)
						// negeer deze importregel
						$aResult['fout']++;
					}
				}
				$nTimeEnd = microtime(true);
				$aResult['time'] = round($nTimeEnd - $nTimeStart, 6);
				$oDB = null;
			} else {
				throw new IllegalValueException('Importbestand niet correct gelezen');
			}
		} else {
			throw new IllegalValueException('Importbestand niet gevonden');
		}
		return $aResult;
	}
*/
	/**
	 * importCSV Importeert een lijst met personen naar de database
	 * 
	 * Deze methode maakt gebruik van PDO prepare om veelvuldig dezelfde query 
	 * uit te voeren.
	 * 
	 * @access public
	 * @param string $p_sBestand Naam van het importbestand
	 * @return array aantal correct geimporteerde personen en aantal foute imports
	 * @throws IllegalValueException
	 */
	public static function importCSV($p_sBestand) {
		$aResult = array('correct' => 0, 'fout' => 0, 'dubbel' => 0, 'melding' => '');
		$nKolommen = 6;	// aantal te importeren kolommen
		if (file_exists($p_sBestand)) {
			$aPersonen = @file($p_sBestand, FILE_IGNORE_NEW_LINES);
			if (is_array($aPersonen)) {
				try {
					$oDB = new DB();
					$sSql = 'SELECT Email FROM ledenlijst;';
					$oResult = $oDB->query($sSql);
					// bewaar alle emailadressen van bestaande leden 
					$aKlanten = $oResult->fetchAll(PDO::FETCH_COLUMN, 0);
				} catch (PDOException $e) {
					$aKlanten = array();
				}
				$nTimeStart = microtime(true);
				$sVoorletters = '';
				$sVoornaam = '';
				$sTussenvoegsel = '';
				$sAchternaam = '';
				$sGeslacht = '';
				$sEmail = '';
				// bereid de query voor
				$sSql = "INSERT INTO ledenlijst (Voorletters, Voornaam, Tussenvoegsel, Achternaam, Geslacht, Adres, Postcode, Plaats, Email_prive, Username, Password) " .
						"VALUES (" .
						":veld0".
						", :veld1".
						", :veld2".
						", :veld3".
						", :veld4".
						", ''".
						", ''".
						", ''".
						", :veld5".
						", ''".
						", ''".
						")";
				$oStatement = $oDB->prepare($sSql);
				// koppel de velden met PHP variabelen
				$oStatement->bindParam(':veld0', $sVoorletters);
				$oStatement->bindParam(':veld1', $sVoornaam);
				$oStatement->bindParam(':veld2', $sTussenvoegsel);
				$oStatement->bindParam(':veld3', $sAchternaam);
				$oStatement->bindParam(':veld4', $sGeslacht);
				$oStatement->bindParam(':veld5', $sEmail);
				foreach($aPersonen as $sRegel) {
					try {
						// creeer de insert query met te vervangen velden
						$aGegevens = split(',', $sRegel);
						if (count($aGegevens == $nKolommen)) {
							// strip de aamhalingstekens 
							for ($c=0; $c < $nKolommen; $c++) {
								$aGegevens[$c] = str_replace('"', '', $aGegevens[$c]);
								// verwijder whitespaces
								$aGegevens[$c] = trim($aGegevens[$c]);
							}
							// controleer de waarden op verkeerde data
							if (!CheckLib::checkPlainText($aGegevens[0])) { throw new InvalidTypeException('Incorrecte gegevens:'.$aGegevens[0]); }
							if (!CheckLib::checkPlainText($aGegevens[1])) { throw new InvalidTypeException('Incorrecte gegevens:'.$aGegevens[1]); }
							if (!CheckLib::checkPlainText($aGegevens[2])) { throw new InvalidTypeException('Incorrecte gegevens:'.$aGegevens[2]); }
							if (!CheckLib::checkPlainText($aGegevens[3])) { throw new InvalidTypeException('Incorrecte gegevens:'.$aGegevens[3]); }
							if (!CheckLib::checkUserDefinedText("/[mv]{1}/",$aGegevens[4])) { throw new IllegalTypeException('Incorrecte gegevens:'.$aGegevens[4]); }
							if (!CheckLib::checkEmail($aGegevens[5])) { throw new InvalidTypeException('Incorrecte gegevens:'.$aGegevens[5]); }
							// controleer of lid nog niet bestaat adv het emailadres
							if (!in_array($aGegevens[5], $aLeden)) {
								// plaats de waarden in de juiste variabelen
								$sVoorletters = $aGegevens[0];
								$sVoornaam = $aGegevens[1];
								$sTussenvoegsel = $aGegevens[2];
								$sAchternaam = $aGegevens[3];
								$sGeslacht = $aGegevens[4];
								$sEmail = $aGegevens[5];
								// voer de voorbereide query uit 
								$oStatement->execute();
								$aResult['correct']++;
							} else {
								// Lid bestaat al
								$aResult['dubbel']++;
							}
						}
					} catch (IllegalTypeException $e) {
						// hou een teller bij van foute invoer (voor later gebruik)
						// negeer deze importregel
						$aResult['fout']++;
					}
				}
				$nTimeEnd = microtime(true);
				$aResult['time'] = round($nTimeEnd - $nTimeStart, 6);
				$oDB = null;
			} else {
				$aResult['melding'] = 'Importbestand niet correct gelezen';
			}
		} else {
			$aResult['melding'] = 'Importbestand niet gevonden';
		}
		return $aResult;
	}
	
	/**
	 * getGegevensAlsXML genereert een persoon als XML data
	 * 
	 * geerft van interface iXMLExporter
	 * @todo nog te implementeren
	 */
	public function getGegevensAlsXML($p_aFilter = array()) {
		$oXML = new DOMDocument();
		return $oXML;
	}
	 
	/**
	 * importXML Importeert een lijst met personen naar de database, de lijst is aangeleverd als XML-document
	 * 
	 * Deze methode maakt gebruik van PDO prepare om veelvuldig dezelfde query 
	 * uit te voeren.
	 * 
	 * @access public
	 * @static
	 * @param string $p_sBestand Naam van het importbestand
	 * @return array aantal correct geimporteerde personen en aantal foute imports
	 * @throws IllegalValueException
	 * @todo ophalen en opslaan XML-data
	 */
	public static function importXML($p_sBestand) {
		$aResult = array('correct' => 0, 'fout' => 0, 'dubbel' => 0, 'melding' => '');
		if (file_exists($p_sBestand)) {
		} else {
			$oXML = new DOMDocument();
			// negeer ongewilde tabs en spaties 
			$oXML->preserveWhiteSpace = false;
			if ($oXML->load($p_sBestand)) {
				// De xml is ingelezen en geparsed
				
			} else {
				$aResult['melding'] = 'Importbestand niet correct gelezen';
			}
			$aResult['melding'] = 'Importbestand niet gevonden';
		}
		return $aResult;
	}
	
	/**
	 * getGeslachtAlsOptieArray Levert een geassocieerde array terug met de mogelijke geslacht karakters
	 * voor gebruik in Smarty {html_options}
	 * @return array
	 * @staticvar
	 */
	public static function getGeslachtAlsOptieArray() {
		$aResult = array();
		$aResult['m'] = 'Man';
		$aResult['v'] = 'Vrouw';
		return $aResult;
	} 
	/**
	 * printData Toont de gegevens van de persoon op het scherm (alleen voor debugging)
	 * @access public
	 */
	public function printData() {
		echo ($this->Voorletters. " (".$this->Voornaam.") ".$this->Tussenvoegsel." ".$this->Achternaam."<br/>");
		switch ($this->Geslacht) {
			case "m" : echo("Man<br/>");
			break;
			case "v" : echo("Vrouw<br/>");
			break;
			default : echo("Onbekend<br/>");
		}
		echo ($this->Email."<br/>");
		foreach($this->m_aAdressen as $oAdres) {
			$oAdres->printData();
			echo('<br/>');
		}
	} 
}
?>