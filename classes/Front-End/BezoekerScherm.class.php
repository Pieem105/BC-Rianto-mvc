<?php
/**
 * Bestand	: BezoekerScherm.class.php
 * Schrijver: Peter Meint Heida
 * Datum	: 23-12-2015
 */

/**
 * BezoekerScherm
 */
class BezoekerScherm extends Scherm {
	
	protected $p_nPagina;
	protected $p_sKop;
	protected $p_sInhoud;

	public function __construct($p_nPaginaId, $p_sTitel) {
		$this->m_nPagina = $p_nPaginaId;
		$this->p_sKop = '';
		$this->p_sInhoud = '';
		parent::__construct($p_sTitel, array());
	} 

	/**
	* bouwScherm bouwt het scherm op
	* @return boolean False als er iets mis is gegaan, anders true
	*/
	public function bouwScherm() {
		$this->m_aData['categories'] = '';
		$this->m_aData['postlink'] = SchermGenerator::genereerLink(SchermGenerator::WELKOM); 
		$this->addScript('js/functies.js');
		$this->m_sTemplate = 'bezoekerpagina.tpl';

		$sSelectiequery  = "SELECT pagina_id, titel, inhoud ";
		$sSelectiequery .= "FROM `webpaginas` ";
		$sSelectiequery .= "WHERE pagina_id = ". $this->m_nPagina;
		
		// Databaseverbinding met MySQL openen
		$rDatabaseverbinding = mysqli_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_WACHTWOORD) or die(mysqli_errno());

		// Verbinding controleren
		if (mysqli_connect_errno())
		  {
		  echo "Fout bij het maken van een verbinding met MySQL: " . mysqli_connect_error();
		  }

		// De database van BC Rianto selecteren
		mysqli_select_db($rDatabaseverbinding, MYSQL_DATABASENAAM) or die(sprintf('Hieronder de foutmelding\n', mysqli_connect_errno(), mysqli_connect_error()));

		 // Gegevens van jarigen uit de database halen
		$rRecordset = mysqli_query($rDatabaseverbinding, $sSelectiequery) or die(mysqli_error($rDatabaseverbinding));

		// Stap 5. Resultaten verwerken als een associatieve array
		while ($aRecord = mysqli_fetch_array($rRecordset, MYSQL_ASSOC)) {
			$this->p_sKop .= $aRecord['titel'];
			$this->p_sInhoud .= $aRecord['inhoud'];
		}
		
		$this->m_sHTML = "<h2>".$this->p_sKop."</h2>".$this->p_sInhoud."<br>";

		// Resultaat in MySQL vrijgeven
		mysqli_free_result($rRecordset);
		// Databaseverbinding met MySQL sluiten
		mysqli_close($rDatabaseverbinding);
		// Eventueel nog systeembronnen (resources) opruimen
		unset($rRecordset);
		unset($rDatabaseverbinding);
		return true;
	}	
}
?>