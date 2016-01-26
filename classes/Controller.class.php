<?php
/**
 * Bestand	: Controller.class.php
 * Schrijver: Peter Meint Heida
 * Datum	: 23-12-2015
 */

/**
 * Controller class die de input en output controleert
 * 
 */
class Controller {
	
//	private $m_sTemplate;
	private $m_nPagina;
	private $m_oGebruiker;
	
	/**
	 * constructor
	 */
	public function __construct() {
//		$this->m_sTemplate = '';
		$this->m_nPagina = -1;
		$this->m_oGebruiker = null;
	}
	
	/**
	 * handlePagina Handelt de gegeven pagina af
	 * 
	 * Deze methode controleert of de juiste invoer is gegeven en handelt de pagina verder af
	 * Er wordt een gebruikerobject gemaakt dat de gegevens van de huidige gebruiker bevat.
	 * @return void
	 */
	public function handlePagina() {
		try {
			// vang alle fouten af
			// creeer een Gebruiker object
			$this->m_oGebruiker = new Gebruiker();
			// plaats de gebruiker in de Registry zodat andere objecten deze kunnen gebruiken
			Registry::add($this->m_oGebruiker, 'Bezoeker');
			
			// creeer de inputvalidator
			$oValidator = InputValidator::instantiate();
			$nResult = $oValidator->validate('page', InputValidator::SCOPE_GET | InputValidator::SCOPE_POST, InputValidator::TYPE_INT, true);
			if (($nResult == InputValidator::RESULT_OK) || ($nResult == InputValidator::RESULT_CONVERTABLE)) {
				// pagina bestaat in GET of POST
				$nPagina = intVal($oValidator->getValue('page', InputValidator::SCOPE_GET | InputValidator::SCOPE_POST));
				// maak het juiste Scherm object aan
				$oScherm = SchermGenerator::genereerSchermObject($nPagina);
			} else {
				// geen pagina opgegeven, ga naar homepage
				$oScherm = SchermGenerator::genereerSchermObject(SchermGenerator::WELKOM);
			}
		} catch (Exception $e) {
			// iets is fout gegaan, log uit en toon homepage
			if (is_object($this->m_oGebruiker)) {
				$this->m_oGebruiker->logout();
			}
			// zet exception in de registry zodat de errorpage de info kan tonen
			Registry::add($e, 'Exception');
			$oScherm = SchermGenerator::genereerSchermObject(SchermGenerator::ERRORPAGE);
		}
		if (is_object($oScherm)) {
			// handel eventuele input af
			$oScherm = $oScherm->handlePagina();
			// bouw het scherm met de juiste informatie en toon het 
			$oScherm->bouwScherm();
			$oScherm->toon();
		} else {
			// geen scherm object, heel erg fout.
			echo ('Er is geen scherm-object aangemaakt/of ontbreekt.'); 
		}
	}
}
?>