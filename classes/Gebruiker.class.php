<?php
/**
 * Bestand	: Gebruiker.class.php
 * Schrijver: Peter Meint Heida
 * Datum	: 18-01-2016
 *
 * Revisie 1.# ##-##-2016 Peter Meint Heida
 * toegevoegd: ---
 * Gewijzigd : ---
 * verwijderd: ---
 *
 */

/**
 * Gebruiker
 * @access public
 */
class Gebruiker extends Persoon {
	const BEZOEKER = 0;
	const NIEUWS_BEKIJKEN = 0;
	const NIEUWS_AANPASSEN = 1;
	const LEDEN_BEKIJKEN = 2;
	const LEDEN_AANPASSEN = 4;
	const ADMIN = 7;
	
	const TOEGANG_GEWEIGERD = 50;
	
	protected $m_sGebruikersNaam;
	protected $m_sWachtwoord;
	protected $m_bLoggedIn;
	protected $m_aRechten;
	
	/**
	 * constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->m_sGebruikersNaam = '';
		$this->m_sWachtwoord = '';
		$this->m_bLoggedIn = false;
		$this->m_aRechten = array();
		
		// controleer of gebruiker al is ingelogd
		$oValidator = InputValidator::instantiate();
		$oValidator->addValidation('gebruiker_id', InputValidator::SCOPE_SESSION, InputValidator::TYPE_INT, true);
		$oValidator->addValidation('gebruiker', InputValidator::SCOPE_SESSION, InputValidator::TYPE_STRING, true);
		$oValidator->addValidation('ingelogd', InputValidator::SCOPE_SESSION, InputValidator::TYPE_BOOLEAN, true);
		$oValidator->addValidation('rechten', InputValidator::SCOPE_SESSION, InputValidator::TYPE_ARRAY, true);
		if ($oValidator->ValidateAll() == InputValidator::RESULT_OK) {
			$this->m_nId = $oValidator->getValue('gebruiker_id', InputValidator::SCOPE_SESSION);
			if ($this->m_nId > 0)  {
				$this->m_sGebruikersNaam = $oValidator->getValue('gebruiker', InputValidator::SCOPE_SESSION);
				$this->m_bLoggedIn = $oValidator->getValue('ingelogd', InputValidator::SCOPE_SESSION);
				$this->m_aRechten = $oValidator->getValue('rechten', InputValidator::SCOPE_SESSION);
				// haal de persoongegevens op
				$this->laadGegevens($this->m_nId);
			} 
		} 
		// leeg de lijst met validatie variabelen zodat validator schoon gebruik kan worden
		$oValidator->clearValidation();
	}
	
	/**
	 * login Deze methode logt een gebruiker in
	 * @access public
	 * @param string $p_sNaam De naam van de gebruiker
	 * @param string $p_sWachtwoord Het wachtwoord
	 * @return boolean True als gebruiker correct is ingelogd, false bij fout
	 */
	public function login($p_sNaam, $p_sWachtwoord) {
		try {
			// Zoek of de gebruiker bestaat in de database
			$oDB = new DB();
			$this->m_sWachtwoord = md5($p_sWachtwoord);
			$sSelectiequery = "SELECT lid_nummer FROM gebruikers WHERE gebruikersnaam = '".$p_sNaam."' AND wachtwoord = '".md5($p_sWachtwoord)."';";

			$oResultaat = $oDB->query($sSelectiequery);

			// Gegevens van de gebruiker uit de database halen
			if (($aRecord = $oResultaat->fetch(PDO::FETCH_ASSOC)) !== false) {
					$this->m_nId = intVal($aRecord['lid_nummer']);
					$this->laadGegevens($this->m_nId);
					$this->m_bLoggedIn = true;
					$oResultaat->closeCursor();
					// haal de rechten van de gebruiker op
					$sSelectiequery = "SELECT rechten FROM gebruikers WHERE lid_nummer = '".$this->m_nId."';";
					$oResultaat = $oDB->query($sSelectiequery);
					$this->m_aRechten = array();
					while(($aRecord = $oResultaat->fetch(PDO::FETCH_ASSOC)) !== false) {
						$this->m_aRechten[] = intVal($aRecord['rechten']);
					}
				$oResultaat = null;
				// zet gebruiker informatie in session
				$_SESSION['gebruiker'] = $p_sNaam;
				$_SESSION['gebruiker_id'] = $this->m_nId;
				$_SESSION['ingelogd'] = true;
				$_SESSION['rechten'] = $this->m_aRechten;
				$_SESSION['laatste_pagina'] = SchermGenerator::WELKOM;
			}
			$oDB = null;
		} catch (PDOException $e) {
			// een fout logt direct de gebruiker uit
			$this->logout();
		}
		return $this->m_bLoggedIn;
	}

	/**
	 * logout logt de huidige gebruiker uit
	 * 
	 * logout leegt eventuele sessievariabelen en zet status op uitgelogd
	 * @return void 
	 */
	public function logout() {
		$this->m_sGebruikersNaam = 'onbekend';
		$this->m_sWachtwoord = '';
		$this->m_aRechten = array();
		unset($_SESSION['gebruiker']);
		unset($_SESSION['gebruiker_id']);
		unset($_SESSION['ingelogd']);
		unset($_SESSION['rechten']);
		unset($_SESSION['laatste_pagina']);
		$this->m_bLoggedIn = false;
	}
	/**
	 * heeftRechten Deze methode controleert of de huidige gebruiker de gevraagde rechten bezit.
	 * @param int $p_nRecht	De gevraagde rechten (zie constanten)
	 * @return boolean True als gebruiker de gevraagde rechten bezit, false in andere gevallen   
	 */
	public function heeftRechten($p_nRecht) {
		$bResult = false;
		if (in_array($p_nRecht, $this->m_aRechten)) {
			$bResult = true;
		} 		return $bResult;
	}
	
	/**
	 * isAdmin Heeft deze gebruiker administratierechten
	 * @return boolean True als gebruiker admin rechten heeft 
	 */
	public function isAdmin() {
		$bResult = $this->heeftRechten(self::ADMIN);
		return $bResult;
	}
	
	/**
	 * isIngelogd Geeft true terug als deze gebruiker is ingelogd
	 * 
	 * @return boolean True als gebruiker is ingelogd, false als gebruiker niet is ingelogd 
	 */
	public function isIngelogd() {
		return $this->m_bLoggedIn;
	}

	/**
	 * setter overloaded van Persoon
	 * 
	 * Eerst worden eigen properties afgehandeld. Bestaat de property niet,
	 * dan wordt de setter van de parent klasse aangeroepen.
	 */
	public function __set($p_sProperty, $p_vValue) {
		switch ($p_sProperty) {
			case 'GebruikersNaam' : $this->m_sGebruikerNaam = $p_vValue;
			break;
			case 'Wachtwoord' :
				// LET OP het wachtwoord wordt ALTIJD geencrypt. Je kunt dus maar een keer een ww zetten 
				$this->m_sWachtwoord = md5($p_vValue);
			break;
			case 'LaatstePagina' : 
				// sla de laatst bekeken pagina op in de session 
				$_SESSION['laatste_pagina'] = $p_vValue;
			break;
			case 'Rechten' : 
				if (is_array($p_vValue)) {
					$this->m_aRechten = $p_vValue;
				}
			break;
			default : parent::__set($p_sProperty, $p_vValue);
		}
	}
	
	/**
	 * getter overloaded van Persoon 
	 * 
	 * Eerst worden eventuele eigen properties (van Gebruiker) afgehandeld, 
	 * als de gevraagde property niet bestaat, dan wordt de aanvraag doorgestuurd
	 * naar de parent klasse 
	 */
	public function __get($p_sProperty) {
		$vResult = null;
		switch ($p_sProperty) {
			case 'GebruikersNaam' : $vResult = $this->m_sGebruikerNaam;
			break;
			case 'LaatstePagina' : $vResult = $_SESSION['laatste_pagina'];
			break;
			case 'Rechten' :
				$vResult = $this->m_aRechten;
			break;
			default : // roep getter van parent aan
				$vResult = parent::__get($p_sProperty);
		} 
		return $vResult;
	}

}
?>