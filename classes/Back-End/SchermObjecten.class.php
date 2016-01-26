<?php
/**
 * Bestand	: SchermObjecten.class.php
 * Schrijver: Peter Meint Heida
 * Datum	: 23-12-2015
 */
 
/**
 * SchermObjecten
 * @access public
 * @abstract
 */
class SchermObjecten {

	/**
	* @var clsDebug singleton container
	* @access private
	*/
	private static $s_oInstance;

	private $m_sNaam;
	// Contructor
	// @access public
	public function __construct() {
		$this->m_sNaam = '';
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
      self::$s_oInstance = new SchermObjecten();
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
	
	public function toonCarousel() {
		echo '	<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">';
						$images = glob('./afbeeldingen/carousel/*.jpg');
						if(count($images)): 
							$n = 0;
							natcasesort($images);
							foreach($images as $image):
								$n++;
								if ($n!=1) {
									echo '<div class="item">';
								} else {
									echo '<div class="item active">';
								}
								echo '<img src=' . $image . ' style="height:100px" />';
								echo '</div>';
							endforeach;
						endif;
		echo '		</div>
				</div>';
	} 
	
	public function toonContactInfo() {

		$xmlDoc = new DOMDocument();
		$xmlDoc->load("xml/contact.xml");
		
		$contact=$xmlDoc->getElementsByTagName('contact')->item(0);
		$naam = $contact->getElementsByTagName('naam')->item(0)->childNodes->item(0)->nodeValue;
		$telefoon = $contact->getElementsByTagName('telefoon')->item(0)->childNodes->item(0)->nodeValue;
		$email = $contact->getElementsByTagName('email')->item(0)->childNodes->item(0)->nodeValue;

		echo '	<div style="text-align:center">
					<br>'. $naam . '<br>
					<span class="glyphicon glyphicon-earphone" > '. $telefoon . '</span><br>
					<a href="mailto:info@bcrianto.nl"><span class="glyphicon glyphicon-envelope" style="color:grey"> ' .  $email . '</span></a>
				</div>';
	}
}
?>
