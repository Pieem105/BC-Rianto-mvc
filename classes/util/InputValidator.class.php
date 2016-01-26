<?php
/**
 * $RCSfile: InputValidator.class.php,v $
 * Author: $Author: wouter $
 * Date: $Date: 2008/04/06 02:12:49 $
 * @package webshop
 * History: 
 * $Log: InputValidator.class.php,v $
 * Revision 1.3  2008/04/06 02:12:49  wouter
 * added registreren
 *
 * Revision 1.2  2007/12/21 14:04:25  wouter
 * renamed class files
 * added Scherm classes
 * fixed bug in InputValidator
 *
 * Revision 1.1  2007/12/20 12:46:23  wouter
 * structuur changed (backend, frontend, util)
 * Menu class added
 * changed Scherm class
 *
 * Revision 1.1  2007/12/14 16:58:43  wouter
 * added singletons InputValidator and Debug
 *
 */
 
/**
 * InputValidator Deze klasse bevat functionaliteit om invoer van de client te controleren. 
 * 
 * Deze klasse heeft tot taak het afschermen van de $_GET, $_POST, $_SESSION en $_COOKIE arrays voor 
 * de andere klassen. De klasse is geimplementeerd als singleton.
 */
class InputValidator {
	// invoervariabelen typen
	const TYPE_STRING = 1;
	const TYPE_BOOLEAN = 2;
	const TYPE_INT = 3;
	const TYPE_FLOAT = 4;
	const TYPE_ARRAY = 5;
	const	TYPE_URL = 6;
	const TYPE_EMAIL = 7;
	const TYPE_ZIPCODE = 8;
	const TYPE_PLAINTEXT = 9;
	const TYPE_ALPHATEXT = 10;
	const TYPE_PHONE = 11;
	
	// scopes
	const SCOPE_GET = 1;
	const SCOPE_POST = 2;
	const SCOPE_SESSION = 4;
	const SCOPE_COOKIE = 8;
	const SCOPE_ANY = 15;
	
	// validatieresultaten
	const RESULT_NOT_VALIDATED = 0;
	const RESULT_OK = 1;
	const RESULT_CONVERTABLE = 2;
	const RESULT_EMPTY = 3;
	const RESULT_NON_EXISTENT = 4;
	const RESULT_INVALID = 5;
	
	/**
	 * @var InputValidator $s_oInstantie Statische variabelen die object instantie bevat
	 * @access private
	 * @static
	 */
	private static $s_oInstance = null;
	/**
	 * @var array $m_aValidationList Lijst met variabelen die gevalideerd moeten worden (zie validateAll)
	 * @access private
	 */
	private $m_aValidationList;
	/**
	 * @var array $p_aScopeOrder De volgorde waarin de scopes worden getest
	 * @access private
	 */
	private $m_aScopeOrder;
	
	/**
	 * instantiate Deze method wordt gebruikt om het InputValidator object te instantieren
	 * @return InputValidator Object
	 */
	public static function instantiate() {
		if (self::$s_oInstance == null) {
			// er is nog geen instantie, creeer er een
			self::$s_oInstance = new InputValidator();
		}
		return self::$s_oInstance;
	}
	
	/**
	 * constructor
	 */
	private function __construct() {
		$this->m_aValidationList = array();
		$this->m_aScopeOrder = array(self::SCOPE_COOKIE, self::SCOPE_SESSION, self::SCOPE_POST, self::SCOPE_GET);
	}
	
	/**
	 * validate Validateert een enkele variabele
	 * 
	 * @param string $p_sVar De naam van de variabele die gevalideerd wordt
	 * @param int	$p_nScope De scope waarin de variabele moet zitten
	 * @param int $p_nType Het type dat de variabele moet hebben
	 * @param boolean $p_bMandatory Moet de variabele verplicht aanwezig zijn of mag deze ook leeg zijn
	 * @return int Resultaat van validatie (RESULT_OK, RESULT_EMPTY, RESULT_INVALID)
	 * @throws ValidationException
	 */
	public function validate($p_sVar, $p_nScope, $p_nType, $p_bMandatory) {
		$nResult = self::RESULT_NOT_VALIDATED;
		if ($this->isValidScope($p_nScope) && $this->isValidType($p_nType)) {
			$vResult = $this->getValue($p_sVar, $p_nScope);
			if ($vResult !== null) {
				// waarde gevonden
				$nResult = $this->checkType($vResult, $p_nType);
			} else {
				// geen waarde gevonden
				$nResult = self::RESULT_NON_EXISTENT;
			}
		} else {
			throw new ValidationException("Scope (".$p_nScope.") or Type (".$p_nType.") invalid");
		}
		
		// controleer het resultaat
		switch ($nResult) {
			case self::RESULT_NOT_VALIDATED :
				$nResult = self::RESULT_INVALID;
			break;
			case self::RESULT_NON_EXISTENT :
				if ($p_bMandatory) {
					$nResult = self::RESULT_INVALID;
				} else {
					// hoeft niet aanwezig te zijn
					$nResult = self::RESULT_OK;
				}
			break;
			default :
				if ($p_bMandatory) {
					// als veld verplicht is mag deze niet leeg zijn 
					if (strlen(strVal($vResult)) == 0) {
						$nResult = self::RESULT_INVALID;
					} 
				} else {
					
					// als veld niet verplicht is mag deze ook leeg zijn 
					if (strlen(strVal($vResult)) == 0) {
						$nResult = self::RESULT_OK;
					} 
				}
		}

		return $nResult;
	}
	
	/**
	 * validateAll Valideert alle variabelen die zijn opgegeven met addValidation
	 * 
	 * @return int Resultaat van validatie RESULT_OK als alle variabelen correct zijn, RESULT_INVALID als 1
	 * of meer variabelen incorrect zijn 
	 */
	public function validateAll() {
		$nResult = self::RESULT_OK;
		foreach ($this->m_aValidationList as $sVarName => $aValidation) {
			
			$this->m_aValidationList[$sVarName]['result'] = $this->validate($sVarName, $aValidation['scope'], $aValidation['type'], $aValidation['mandatory']);
			if (($this->m_aValidationList[$sVarName]['result'] != self::RESULT_OK) && ($this->m_aValidationList[$sVarName]['result'] != self::RESULT_CONVERTABLE)){
				$nResult = self::RESULT_INVALID;
			}
		}
		return $nResult;
	}
	
	/**
	 * addValidation	Voegt een variabele toe aan de lijst met te valideren variabelen
	 * 
	 * Als een variabele al bestaat in de lijst en zijn scope is gelijk, dan wordt het te valideren type
	 * en scope overschreven.
	 * Variabelenamen zijn hoofdlettergevoelig
	 * 
	 * @access public
	 * @param string $p_sVar	De naam van de variabele 
	 * @param int	$p_nScope De scope waarin de variabele moet zitten
	 * @param int $p_nType Het type dat de variabele moet hebben
	 * @param boolean $p_bMandatory Is de variabele verplicht
	 * @return boolean true als de variabele correct is toegevoegd
	 * @throws ValidationException 
	 */
	public function addValidation($p_sVar, $p_nScope, $p_nType, $p_bMandatory) {
		$bResult = false;
		if ($this->isValidScope($p_nScope) && $this->isValidType($p_nType)) {
			$this->m_aValidationList[$p_sVar] = array('scope' => $p_nScope, 'type' => $p_nType, 'mandatory' => $p_bMandatory, 'result' => self::RESULT_NOT_VALIDATED);
			$bResult = true;
		} else {
			throw new ValidationException("Scope (".$p_nScope.") or Type (".$p_nType.") invalid");
		}
		return $bResult;
	}
	
	/**
	 * removeValidation verwijdert een variabele uit de lijst met te valideren variabelen
	 * 
	 * @access public
	 * @param string $p_sVar De naam van de te verwijderen variabele
	 * @return boolean true als variabele succesvol is verwijderd
	 */
	public function removeValidation($p_sVar) {
		$bResult = false;
		if (isset($this->m_aValidationList[$p_sVar])) {
			unset($this->m_aValidationList[$p_sVar]);
			$bResult = true;
		}
		return $bResult;
	}
	
	/**
	 * getResult Geeft alle validatieresulaten terug als array
	 * 
	 * Geeft lijst terug met gevalideerde variabelen
	 * formaat [variabele]['scope'],[variabele]['type'],[variabele]['mandatory'],[variabele]['result']   
	 * @access public
	 * @return array Lijst met validatieresulaten
	 */
	public function getResult() {
		return $this->m_aValidationList;
	}
	
	/**
	 * getValue Geeft de waarde van de gevraagde variabele terug
	 * 
	 * @access public
	 * @param string $p_sVar De naam van de variabele 
	 * @param int $p_nScope De scope waarin de variabele moet voorkomen
	 * @return variant De waarde van de variabele, null als de variabele niet bestaat
	 * @throws ValidationException
	 */
	public function getValue($p_sVar, $p_nScope) {
		$vResult = null;
		if ($this->isValidScope($p_nScope)) {
			foreach($this->m_aScopeOrder as $nCurrScope) {
				// zoek in de volgorde van de scopes
				//echo ('getValue: '.$p_sVar.' : scope '.$nCurrScope.'<br/>'); 
				
				if ($vResult === null) {
					// nog geen waarde gevonden
					if (($p_nScope & $nCurrScope) != 0) {
						switch ($nCurrScope) {
							case self::SCOPE_COOKIE :
								if (isset($_COOKIE)) {
									if (isset($_COOKIE[$p_sVar])) {
										$vResult = $_COOKIE[$p_sVar];
									}
								}
							break;
							case self::SCOPE_SESSION :
								if (isset($_SESSION)) {
									if (isset($_SESSION[$p_sVar])) {
										$vResult = $_SESSION[$p_sVar];
									}
								}
							break;
							case self::SCOPE_POST:
								if (isset($_POST)) {
									if (isset($_POST[$p_sVar])) {
										$vResult = $_POST[$p_sVar];
									}
								}
							break;
							case self::SCOPE_GET :
								if (isset($_GET)) {
									if (isset($_GET[$p_sVar])) {
										$vResult = $_GET[$p_sVar];
									}
								}
							break;
							default : 
								// foute scope, null
						}
					}
				} else {
					// waarde is al gevonden, stop met zoeken
					break; 
				}
			}
		} else {
			throw new ValidationException("Scope (".$p_nScope.") invalid");
		}
		//echo ('getValue: '.$p_sVar.' : '.$vResult.'<br/>'); 
		return $vResult;
	}
	
	/**
	 * clearValidation leegt de lijst met te valideren variabelen
	 * @access public
	 * @return void
	 */
	public function clearValidation() {
		$this->m_aValidationList = array();
	}
	
	/**
	 * setScopeOrder Zet de volgorde waarin de verschillende scopes worden getest
	 * 
	 * Deze methode zet de volgorde waarin de variabelen in hun scope worden getest. 
	 * Als een variabele in meerdere scopes bestaat, wordt alleen de eerste gevalideerd. Als niet alle
	 * scopes worden opgegeven wordt de standaard volgorde aangehouden van de niet opgegeven scopes
	 * @access public
	 * @param int $p_nScope1 De eerste scope  
	 * @param int $p_nScope2 De tweede scope  
	 * @param int $p_nScope3 De derde scope  
	 * @param int $p_nScope4 De vierde scope
	 * @return void  
	 */
	public function setScopeOrder($p_nScope1, $p_nScope2 = 0, $p_nScope3 = 0, $p_nScope4 = 0) {
		$nScopesLeft = self::SCOPE_ANY;
		$aNewOrder = array();
		$aScopes = array($p_nScope1, $p_nScope2, $p_nScope3, $p_nScope4);
		// behandel alle opgegeven scopes
		foreach($aScopes as $nScope) {
			if (($nScope == self::SCOPE_COOKIE) || ($nScope == self::SCOPE_SESSION) || ($nScope == self::SCOPE_POST) || ($nScope == self::SCOPE_GET)) { 
				// geldige scope opgegeven
				if ((($p_nScope1 & $nScopesLeft) != 0)) {
					// scope is nog niet gebruikt
					$aNewOrder[] = $nScope;
					// schakel gebruikte scope uit
					$nScopesLeft &= ~$nScope;
				}
			}
		}
		// voeg niet behandelde scopes toe achteraan de volgordelijst
		if ($nScopesLeft != 0) {
			if (($nScopesLeft & self::SCOPE_COOKIE) != 0) {
				$aNewOrder[] = self::SCOPE_COOKIE;
			}
			if (($nScopesLeft & self::SCOPE_SESSION) != 0) {
				$aNewOrder[] = self::SCOPE_SESSION;
			}
			if (($nScopesLeft & self::SCOPE_POST) != 0) {
				$aNewOrder[] = self::SCOPE_POST;
			}
			if (($nScopesLeft & self::SCOPE_GET) != 0) {
				$aNewOrder[] = self::SCOPE_GET;
			}
		}
		$this->m_aScopeOrder = $aNewOrder;
	}
	
	/**
	 * checkType controleert  de gegeven waarde tegen het gegeven type
	 * 
	 * @access private
	 * @param variant $p_vValue	de waarde
	 * @param int $p_nType Het te controleren type
	 * @return int het resultaat van de controle (RESULT_OK, RESULT_INVALID)
	 */
	private function checkType($p_vValue, $p_nType) {
		$nResult = self::RESULT_INVALID;
		try {
			switch ($p_nType) {
				case self::TYPE_STRING :
					if (is_string($p_vValue)) {
						$nResult = self::RESULT_OK;
					} else {
						if (is_numeric($p_vValue)) {
							$nResult = self::RESULT_CONVERTABLE;
						}
					}
				break; 
				case self::TYPE_BOOLEAN :
					if (is_bool($p_vValue)) {
						$nResult = self::RESULT_OK;
					} else {
						// convertable als het 1 of 0 bevat
						if (is_numeric($p_vValue) && ((intVal($p_vValue) == 1) || (intVal($p_vValue) == 0))) {
							$nResult = self::RESULT_CONVERTABLE;
						}
					}
				break; 
				case self::TYPE_INT :
					if (is_int($p_vValue)) {
						$nResult = self::RESULT_OK;
					} else {
						// convertable als het een getal bevat
						if (is_numeric($p_vValue)) {
							$nResult = self::RESULT_CONVERTABLE;
						}
					}
				break; 
				case self::TYPE_FLOAT :
					if (is_float($p_vValue)) {
						$nResult = self::RESULT_OK;
					} else {
						// convertable als het een getal bevat
						if (is_numeric($p_vValue)) {
							$nResult = self::RESULT_CONVERTABLE;
						}
					}
				break; 
				case self::TYPE_ARRAY :
					if (is_array($p_vValue)) {
						$nResult = self::RESULT_OK;
					}
				break; 
				case self::TYPE_URL :
					if (CheckLib::checkURL($p_vValue)) {
						$nResult = self::RESULT_OK;
					}
				break; 
				case self::TYPE_EMAIL :
					if (CheckLib::checkEmail($p_vValue)) {
						$nResult = self::RESULT_OK;
					}
				break; 
				case self::TYPE_ZIPCODE :
					if (CheckLib::checkDutchZipcode($p_vValue)) {
						$nResult = self::RESULT_OK;
					}
				break; 
				case self::TYPE_PLAINTEXT :
					if (CheckLib::checkPlainText($p_vValue)) {
						$nResult = self::RESULT_OK;
					}
				break; 
				case self::TYPE_ALPHATEXT :
					if (CheckLib::checkAlphaText($p_vValue)) {
						$nResult = self::RESULT_OK;
					}
				break; 
				case self::TYPE_PHONE :
					if (CheckLib::checkPhoneNumber($p_vValue)) {
						$nResult = self::RESULT_OK;
					}
				break; 
				default : // resultaat invalid
			}
		} catch (Exception $e) {
			// bij een fout wordt het resultaat invalid
			$nResult = self::RESULT_INVALID;
		}	
		return $nResult;
	}
	
	/**
	 * isValidScope checkt de gegeven scope
	 * 
	 * @access private
	 * @param int $p_nScope
	 * @return boolean true als scope correct is
	 */
	private function isValidScope($p_nScope) {
		if (($p_nScope & self::SCOPE_ANY) == $p_nScope) {
			return true;
		} 
		return false;
	}
	
	/**
	 * isValidType checkt het gegeven type
	 * 
	 * @access private
	 * @param int $p_nType
	 * @return boolean true als type correct is
	 */
	private function isValidType($p_nType) {
		switch ($p_nType) {
			case  self::TYPE_STRING :
			case  self::TYPE_BOOLEAN :
			case  self::TYPE_INT :
			case  self::TYPE_FLOAT :
			case  self::TYPE_ARRAY :
			case 	self::TYPE_URL :
			case  self::TYPE_EMAIL :
			case  self::TYPE_ZIPCODE :
			case  self::TYPE_PLAINTEXT :
			case	self::TYPE_ALPHATEXT :
			case  self::TYPE_PHONE :
				return true;
			break;
			default : return false;
		}
	}
	
	/**
	 * getPrintableResult geeft een string met het resultaat terug (voor debugging)
	 */
	public static function getPrintableResult($p_nResult) {
		$sResult = 'Unknown result';
		switch ($p_nResult) {
			case self::RESULT_NOT_VALIDATED :
				$sResult = 'NOT_VALIDATED';
			break;
			case self::RESULT_OK :
				$sResult = 'OK';
			break;
			case self::RESULT_CONVERTABLE :
				$sResult = 'CONVERTABLE';
			break;
			case self::RESULT_EMPTY :
				$sResult = 'EMPTY';
			break;
			case self::RESULT_NON_EXISTENT :
				$sResult = 'NON_EXISTENT';
			break;
			case self::RESULT_INVALID :
				$sResult = 'INVALID';
			break;
		}	
		return $sResult;
	}
	
	/**
	 * debug toon alle input variabelen
	 */
	public function debug() {
		$sHTML = '';
		if (isset($_GET)) {
			foreach($_GET as $var => $value) {
				$sHTML .= "GET : " . $var . " -> " . $value . "<br/>";
			}
		}
		if (isset($_POST)) {
			foreach($_POST as $var => $value) {
				$sHTML .= "POST : " . $var . " -> " . $value . "<br/>";
			}
		}
		if (isset($_COOKIE)) {
			foreach($_COOKIE as $var => $value) {
				$sHTML .= "COOKIE : " . $var . " -> " . $value . "<br/>";
			}
		}
		if (isset($_SESSION)) {
			foreach($_SESSION as $var => $value) {
				$sHTML .= "SESSION : " . $var . " -> " . $value . "<br/>";
			}
		}
		return $sHTML;
	}
	
}
?>