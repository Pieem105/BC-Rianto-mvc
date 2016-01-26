<?php
/**
 * Bestand	: LedenBekijkenScherm.class.php
 * Schrijver: Peter Meint Heida
 * Datum	: 19-01-2016
 *
 * Revisie 1.1 26-01-2016 Peter Meint Heida
 * Gewijzigd : Rechten toegevoegd als parameter bij de aanroep van de parent-constructor.
 * Toegevoegd: in bouwScherm het maken van een ledenlijst op basis van gegevens uit de database 'bcrianto@ledenlijst'.
 *
 */

/**
 * LedenBekijkenScherm
 */
class LedenBekijkenScherm extends Scherm {
	
	public function __construct() {
		parent::__construct('Leden bekijken', array(	Gebruiker::ADMIN,
														Gebruiker::LEDEN_BEKIJKEN,
														Gebruiker::LEDEN_AANPASSEN));
	} 

	/**
	* bouwScherm bouwt het scherm op
	* @return boolean False als er iets mis is gegaan, anders true
	*/
	public function bouwScherm() {
		$this->m_aData['categories'] = '';
		$this->m_aData['postlink'] = SchermGenerator::genereerLink(SchermGenerator::LEDEN_BEKIJKEN); 
		$this->m_sTemplate = 'ledenbekijken.tpl';	
		$this->m_sHTML = '<h2>Ledenlijst</h2>';
		try {
			// Zoek de leden op in de database
			$oDB = new DB();
			$sSelectiequery = "SELECT lid_nummer, inschrijf_datum, voornaam, tussenvoegsel, achternaam, straatnaam, huisnr, toevoegsel, postcode, woonplaats, post_straatnaam, post_huisnr, post_toevoegsel, post_postcode, post_woonplaats, geslacht, email, telefoon_vast, telefoon_mobiel, bondsnummer, geboorte_datum, lid_status FROM ledenlijst ORDER BY achternaam;";

			$oResultaat = $oDB->query($sSelectiequery);
			
			$this->m_sHTML .= "<table style='border:2px solid;border-width'>"; //width:100%;
			$this->m_sHTML .= "<tr style='border-bottom:2px solid;padding:5px'><th style='padding:2px'>Lidnr.</th><th style='padding:2px'>Inschrijfdatum</th><th style='padding:2px'>Voornaam</th><th style='padding:2px'>Tussenvoegsel</th><th style='padding:2px'>Achternaam</th>";
			$this->m_sHTML .= "<th style='padding:2px'>Straatnaam</th><th style='padding:2px'>Huisnr.</th><th style='padding:2px'>Postcode</th><th style='padding:2px'>Woonplaats</th><th style='padding:2px'>Straatnaam(post)</th><th style='padding:2px'>Huisnr(post)</th><th style='padding:2px'>Postcode(post)</th><th style='padding:2px'>Woonplaats(post)</th><th style='padding:2px'>Geslacht</th><th style='padding:2px'>E-mail</th><th style='padding:2px'>Telefoon(vast)</th><th style='padding:2px'>Telefoon(mobiel)</th><th style='padding:2px'>Bondsnummer</th><th style='padding:2px'>Geboorte-datum</th></tr>";

			while(($aRecord = $oResultaat->fetch(PDO::FETCH_ASSOC)) !== false) {
				$this->m_sHTML .= "<tr style='border-bottom:1px solid #CCF;padding:5px'>";
				
				$this->m_sHTML .= "<td style='padding:2px'>".$aRecord['lid_nummer']."</td>";
				$this->m_sHTML .= "<td style='padding:2px'>".$aRecord['inschrijf_datum']."</td>";
				$this->m_sHTML .= "<td style='padding:2px'>".$aRecord['voornaam']."</td>";
				$this->m_sHTML .= "<td style='padding:2px;text-align:center'>".$aRecord['tussenvoegsel']."</td>";
				$this->m_sHTML .= "<td style='padding:2px'>".$aRecord['achternaam']."</td>";
				$this->m_sHTML .= "<td style='padding:2px'>".$aRecord['straatnaam']."</td>";
				$this->m_sHTML .= "<td style='padding:2px;text-align:right'>".$aRecord['huisnr'].$aRecord['toevoegsel']."</td>";
				$this->m_sHTML .= "<td style='padding:2px'>".$aRecord['postcode']."</td>";
				$this->m_sHTML .= "<td style='padding:2px;text-align:right'>".$aRecord['woonplaats']."</td>";
				$this->m_sHTML .= "<td style='padding:2px'>".$aRecord['post_straatnaam']."</td>";
				$this->m_sHTML .= "<td style='padding:2px;text-align:right'>".$aRecord['post_huisnr'].$aRecord['post_toevoegsel']."</td>";
				$this->m_sHTML .= "<td style='padding:2px'>".$aRecord['post_postcode']."</td>";
				$this->m_sHTML .= "<td style='padding:2px;text-align:right'>".$aRecord['post_woonplaats']."</td>";
				$this->m_sHTML .= "<td style='padding:2px;text-align:right'>".$aRecord['geslacht']."</td>";
				$this->m_sHTML .= "<td style='padding:2px;text-align:right'>".$aRecord['email']."</td>";
				$this->m_sHTML .= "<td style='padding:2px;text-align:right'>".$aRecord['telefoon_vast']."</td>";
				$this->m_sHTML .= "<td style='padding:2px;text-align:right'>".$aRecord['telefoon_mobiel']."</td>";
				$this->m_sHTML .= "<td style='padding:2px;text-align:right'>".$aRecord['bondsnummer']."</td>";
				$this->m_sHTML .= "<td style='padding:2px;text-align:right'>".$aRecord['geboorte_datum']."</td>";
				$this->m_sHTML .= "</tr>";
			}
			$this->m_sHTML .= "/<table>";

		} catch (PDOException $e) {
		// een fout geeft een foutmelding weer.
		$this->m_sHTML = '<h2>Ledenlijst</h2><br>';
		$this->m_sHTML .= 'Er is iets fout gegaan bij het ophalen van de gegevens uit de ledenlijst!<br>';
		$this->m_sHTML .= 'Controleer de internetverbinding of neem contact op met de beheerder.<br>';
		
		}
		return true;
	}	
}
?>