<?php
/**
 * Bestand	: BCRiantoInfoObject.class.php
 * Schrijver: Peter Meint Heida
 * Datum	: 23-12-2015
 */
 
/**
 * BCRiantoInfoObject
 * @access public
 * @abstract
 */
class BCRiantoInfoObject {

	/**
	* @access private
	*/
	private static $s_oInstance;
	private static $s_oxmlBCRiantoDoc;

	// Contructor
	// @access public
	public function __construct() {
	}
	
	/**
	* instantiate return a singleton object for the Debug class
	*
	* The method return a new object if it does not exist, otherwise return the existing object
	* @access public
	* @return Debug
	*/
  public static function instantiate()  {
    if (self::$s_oInstance === null) {
      self::$s_oInstance = new BCRiantoInfoObject();
	}

    if (self::$s_oxmlBCRiantoDoc === null) {
		self::$s_oxmlBCRiantoDoc = new DOMDocument();
		self::$s_oxmlBCRiantoDoc->load("xml/contact.xml");
    }

    return self::$s_oInstance;
  }
   
	// Destructor
	// @access public
	function __destruct() {
		// nothing to destruct
	}

	public function toonLogo() {
		echo '<a href="index.php?i=interesse">' . $this->model->logo . '</a>';
	}
	
	public function getAfbeeldingenCarousel() {
		$images = glob('./afbeeldingen/carousel/*.jpg');
		if(count($images)): 
			natcasesort($images);
			foreach($images as $image):
			endforeach;
		endif;
		return $images;
	} 

	public function getContactInfo() {

		$contact=self::$s_oxmlBCRiantoDoc->getElementsByTagName('contact')->item(0);
		$naam = $contact->getElementsByTagName('naam')->item(0)->childNodes->item(0)->nodeValue;
		$telefoon = $contact->getElementsByTagName('telefoon')->item(0)->childNodes->item(0)->nodeValue;
		$email = $contact->getElementsByTagName('email')->item(0)->childNodes->item(0)->nodeValue;

		return array('naam' => $naam, 'telefoon' => $telefoon, 'email' => $email);
	}

	public function getJarigenVanDeMaand() {
		// Query voor het verkrijgen van de jarigen van deze maand
		$sSelectiequery  = "SELECT voornaam, tussenvoegsel, achternaam, DAY(geboorte_datum) AS dag ";
		$sSelectiequery .= "FROM `ledenlijst` ";
		$sSelectiequery .= "WHERE MONTH(geboorte_datum)= MONTH(CURRENT_TIMESTAMP) ";
		$sSelectiequery .= "ORDER BY DAY(geboorte_datum)";

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
		$n = 0;
		$aJarigen = '';
		// Stap 5. Resultaten verwerken als een associatieve array
		while ($aRecord = mysqli_fetch_array($rRecordset, MYSQL_ASSOC)) {
			// Aanmaken nieuwe jarige
			$aJarigen[$n] = array('dag' => $aRecord['dag'], 'naam' => $aRecord['voornaam']. ' ' . $aRecord['tussenvoegsel'] . ' ' . $aRecord['achternaam']);
			$n++;
		}

		// Resultaat in MySQL vrijgeven
		mysqli_free_result($rRecordset);
		// Databaseverbinding met MySQL sluiten
		mysqli_close($rDatabaseverbinding);
		// Eventueel nog systeembronnen (resources) opruimen
		unset($rRecordset);
		unset($rDatabaseverbinding);
		return $aJarigen;
	}

}
?>
