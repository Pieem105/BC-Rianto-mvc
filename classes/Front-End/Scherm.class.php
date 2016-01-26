<?php
/**
 * Bestand	: Scherm.class.php
 * Schrijver: Peter Meint Heida
 * Datum	: 23-12-2015
 *
 * Revisie 1.# ##-##-2016 Peter Meint Heida
 * toegevoegd: ---
 * Gewijzigd : ---
 * verwijderd: ---
 *
 */
 
/**
 * Scherm
 * @access public
 * @abstract
 */
abstract class Scherm {
	protected $m_sTitel;
	protected $m_sHTML;
	protected $m_oMenu;
	protected $m_oGebruiker;
	protected $m_aData;
	protected $m_aScripts;
	protected $m_oSmarty;
	protected $m_sTemplate;
	protected $m_aBenodigdeRechten;

	/**
	 * constructor
	 * Deze constructor controleert of de gebruiker is ingelogd, is dat het geval,
	 * dan wordt het ingelogde menu gecreeerd. Als de gebruiker de rechten admin heeft,
	 * wordt het adminmenu gecreeerd.
	 * @param string $p_sTitel De getoonde titel op het scherm
	 * @param array $p_aRechten array bevat alle benodigde rechten om deze pagina op te roepen. Een lege array 
	 * @throws InsufficientRightsException
	 */
	public function __construct($p_sTitel, $p_aRechten) {
		$this->m_sTitel = $p_sTitel;
		$this->m_sHTML = '';
		$this->m_aData = array();
		$this->m_aScripts = array();
		$this->m_oSmarty = null;
		$this->m_sTemplate = '';
		if (is_array($p_aRechten)) {
			$this->m_aBenodigdeRechten = $p_aRechten;
		} else {
			$this->m_aBenodigdeRechten = array(Gebruiker::TOEGANG_GEWEIGERD);
		}
		// genereer het menu aan de hand van de gebruikerrechten
		if (Registry::exists('Bezoeker')) {
			$this->m_oGebruiker = Registry::get('Bezoeker');
			if ($this->m_oGebruiker->isIngelogd()) {
				$oValidator = InputValidator::instantiate();
				$nPagina = intVal($oValidator->getValue('page', InputValidator::SCOPE_GET | InputValidator::SCOPE_POST));
				if($nPagina >= MenuGenerator::BEHEER) {
					$aRechten = $this->m_oGebruiker->__get('Rechten');
					$this->m_oMenu = MenuGenerator::genereerMenuObject(MenuGenerator::BEHEER, $aRechten);
					if (!$this->checkRechten()) {
						// genereer een Exception zodat dit scherm nooit per ongeluk getoond kan worden
						throw new OnvoldoendeRechtenException('Pagina '. $p_sTitel); 
					}
				} else {
					$this->m_oMenu = MenuGenerator::genereerMenuObject(MenuGenerator::BEZOEKER, array());
				}
			} else {
				$this->m_oMenu = MenuGenerator::genereerMenuObject(MenuGenerator::BEZOEKER, array());
			}
		} else {
			$this->m_oGebruiker = null;
		}
	}
	
	/**
	 * addScript	Voegt een javascript bestand toe aan de header van het scherm.
	 * 
	 * @access protected
	 * @param string $p_sScript	De javascript code
	 * @return void
	 * @todo check javascript code op niet bestaande bestanden
	 */
	protected function addScript($p_sScript) {
		$this->m_aScripts[] = $p_sScript;
	}
    
	/**
	 * toon Toont de gegevens op het scherm. maakt gebruik van Smarty templates
	 * 
	 * @return void
	 */
	public function toon() {
		// creeer een Smarty-object
		$oSmarty = new SmartyWrapper();
		$oSmarty->assign('sTitel', $this->m_sTitel);
		$oSmarty->assign('sHTML', $this->m_sHTML);

		$oBCRiantoInfo = BCRiantoInfoObject::instantiate();
		$aContactInfo = $oBCRiantoInfo->getContactInfo();
		$aAfbeeldingenCarousel = $oBCRiantoInfo->getAfbeeldingenCarousel();
		$aJarigenVanDeMaand = $oBCRiantoInfo->getJarigenVanDeMaand();
		
		if (is_object($this->m_oMenu)) {
			$oSmarty->assign('aMenu', $this->m_oMenu->getData());
		}
		$sNaam = '';
		
		$oSmarty->assign('aContact', $aContactInfo);
		$oSmarty->assign('aAfbeeldingen', $aAfbeeldingenCarousel);
		$oSmarty->assign('aJarigenVanDeMaand', $aJarigenVanDeMaand);
		$oSmarty->assign('sGebruikerNaam', $sNaam);
		$oSmarty->assign('aScripts', $this->m_aScripts);
		$oSmarty->assign('aData', $this->m_aData);
		
		if (strlen($this->m_sTemplate) > 0) {
			$oSmarty->display($this->m_sTemplate);
		} else {
			throw new WebsiteException('Geen template gedefinieerd');
		}
	}
    
	/**
	* bouwScherm
	* 
	* @access public
	* @abstract
	* @return boolean 
	*/
	public abstract function bouwScherm();
	
	/**
	 * handlePagina	Deze methode handelt eventuele input voor de pagina af
	 * 
	 * Deze method retourneert een nieuw (of hetzelfde) scherm object. Standaard wordt het schermobject
	 * teruggegeven. Subklassen kunnen deze methode overloaden om afhandeling te regelen en eventueel 
	 * een redirect doen.
	 * @return Scherm het huidige schermobject 
	 */
	public function handlePagina() {
		return $this;
	}
	
	/**
	 * checkRechten Controleert of de huidige gebruiker de juiste rechten heeft om deze pagina te benaderen
	 * Het recht TOEGANG_GEWEIGERD geeft aan dat er geen enkele toegang mogelijk is.
	 * De membervariabele m_aBenodigdeRechten bevat alle rechten die nodig zijn. Alleen als de gebruiker alle rechten
	 * bezit, wordt toegang verleend   
	 * @access private
	 * @return boolean true als gebruiker alle rechten bezit, false als niet aan alle rechten is voldaan of TOEGANG_GEWEIGERD 
	 */
	private function checkRechten() {
		$bResult = false;
		if (!in_array(Gebruiker::TOEGANG_GEWEIGERD, $this->m_aBenodigdeRechten)) {
			// test alle rechten in de array voor de huidige gebruiker
			if ($this->m_oGebruiker) {
				$bRechten = false;
				if (count($this->m_aBenodigdeRechten) != 0) {
					for ($c = 0; ($c < count($this->m_aBenodigdeRechten)) && ($bRechten == false); $c++) {
						$bRechten = $this->m_oGebruiker->heeftRechten($this->m_aBenodigdeRechten[$c]);
					}
				} else {
					// Er zijn geen rechtenvoorwaarden, iedereen mag de pagina bezoeken
					$bRechten = true;
				}
				$bResult = $bRechten;
			}
		}
		return $bResult; 
	}
}
?>