<?php
/**
 * $RCSfile: CheckLib.class.php,v $
 * Author: $Author: wouter $
 * Date: $Date: 2008/04/06 02:12:49 $
 * @package webshop
 * History
 * $Log: CheckLib.class.php,v $
 * Revision 1.5  2008/04/06 02:12:49  wouter
 * added registreren
 *
 * Revision 1.4  2008/02/22 14:02:50  wouter
 * completed import CVS functionality
 *
 * Revision 1.3  2008/02/22 13:09:55  wouter
 * fixed exception problem, added import functionality
 *
 * Revision 1.2  2008/01/18 15:23:26  wouter
 * added PDO code
 *
 * Revision 1.1  2007/12/20 12:46:23  wouter
 * structuur changed (backend, frontend, util)
 * Menu class added
 * changed Scherm class
 *
 * Revision 1.2  2007/11/30 13:00:43  wouter
 * added check functions
 *
 * Revision 1.1  2007/09/18 16:01:38  wouter
 * added classes to support Bestelling
 *
 * Revision 1.1  2007/09/13 14:36:12  wouter
 * added webshop classes
 *
 * Revision 1.1  2007/09/05 11:48:41  wouter
 * added webshop classes
 *
 */
 
/**
 * CheckLib
 * @access public
 * @abstract
 */
abstract class CheckLib {

	/**
	 * checkURL checks if the given string is an URL
	 * @static
	 * @access public
	 * @param string $p_sURL
	 * @return boolean True if string is correct URL, false if not
	 */
	public static function checkURL($p_sURL) {
		if (preg_match('!^((ftp|(http(s)?))://)?(\.?([a-z0-9-]+))+\.[a-z]{2,6}(:[0-9]{1,5})?(/[a-zA-Z0-9.,;\?|\'+&%\$#=~_-]+)*$!i',$p_sURL) ) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * checkEmail checks if the given string is a valid Email address
	 * @static
	 * @access public
	 * @author Dave Child
	 * @link http://www.ilovejackdaniels.com/php/email-address-validation/ The email checking code
	 * is mostly copied from this website. I have changed it to match the correct coding standard. 
	 * @param string $p_sEmail
	 * @return boolean True if string is correct email address, false if not
	 */
	public static function checkEmail($p_sEmail) {
		// First, we check that there's one @ symbol, and that the lengths are right
		if (!preg_match('~^[^@]{1,64}@[^@]{1,255}$~', $p_sEmail)) {
			// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
			throw new WebshopException('wrong nr of characters : '.$p_sEmail);
			return false;
		}
		// Split it into sections to make life easier
		$aEmail = explode("@", $p_sEmail);
		$aLocal = explode(".", $aEmail[0]);
		for ($i = 0; $i < sizeof($aLocal); $i++) {
			if (!preg_match("~^(([A-Za-z0-9!#$%&'*+/=?^_`{|}-][A-Za-z0-9!#$%&'*+/=?^_`{|}\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$~", $aLocal[$i])) {
				//echo('name incorrect : "'.$aLocal[$i] . '" full: '.$p_sEmail.'<br />');
				return false;
			}
		}
		if (!preg_match("~^\[?[0-9\.]+\]?$~", $aEmail[1])) { 
			// Check if domain is IP. If not, it should be valid domain name
			$aDomain = explode(".", $aEmail[1]);
			if (sizeof($aDomain) < 2) {
				//echo('domains wrong : '.$p_sEmail.'<br />');
				return false; // Not enough parts to domain
			}
			for ($i = 0; $i < sizeof($aDomain); $i++) {
				if (!preg_match("~^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$~", $aDomain[$i])) {
					//echo('Domain part wrong ['.$i.']: '.$p_sEmail.'<br />');
					return false;
				}
			}
		}
		return true;    
	}    
	/**
	 * checkDutchZipcode checks if the given string is a valid dutch zipcode
	 * @static
	 * @access public
	 * @param string $p_sZipcode
	 * @return boolean True if string is correct zipcode, false if not
	 */
	public static function checkDutchZipcode($p_sZipcode) {
		if (preg_match("/^\d{4}[\s-]?[a-zA-Z]{2}$/",$p_sZipcode) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * checkPhoneNumber checks if the given string is a valid dutch phonenumber
	 * @static
	 * @access public
	 * @param string $p_sPhone
	 * @return boolean True if string is correct phonenumber, false if not
	 */
	public static function checkPhoneNumber($p_sPhone) {
		if (preg_match("/^[0-9]{10}$/",$p_sPhone) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * checkAccountNumber checks if the given string is a valid dutch bank accountnumber
	 * @static
	 * @access public
	 * @param string $p_sAccount
	 * @return boolean True if string is correct phonenumber, false if not
	 */
	public static function checkAccountNumber($p_sAccount) {
		if (preg_match("/^[1-9][0-9]{3,}$/",$p_sAccount) ) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * checkPlainText	checks if the given string contains only normal input characters
	 * 
	 * @static
	 * @access public
	 * @param string	$p_sText
	 * @return boolean True if string contains only plain characters
	 */
	public static function checkPlainText($p_sText) {
		if (preg_match("/[a-zA-Z\d\.\s\-]*$/",$p_sText) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * checkAlphaText	checks if the given string contains only normal input characters and NO numbers
	 * we accept '.', '-' and whitespaces
	 * @static
	 * @access public
	 * @param string	$p_sText
	 * @return boolean True if string contains only plain characters
	 */
	public static function checkAlphaText($p_sText) {
		if (preg_match("/[a-zA-Z\.\s\-]*$/",$p_sText) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * checkUserDefinedText	checks if the given string matches the given regular expression
	 * 
	 * @static
	 * @access public
	 * @param string	$p_sExpression
	 * @param string	$p_sText The text to check
	 * @return boolean True if string contains only plain characters
	 */
	public static function checkUserDefinedText($p_sExpression, $p_sText) {
		if (preg_match($p_sExpression, $p_sText) ) {
			return true;
		} else {
			return false;
		}
	}
}
?>