<?php
/**
 * $RCSfile: iXMLExporter.class.php,v $
 * Author: $Author: wouter $
 * Date: $Date: 2008/03/17 16:38:11 $
 * @package complete-php-boek
 * History: 
 * $Log: iXMLExporter.class.php,v $
 * Revision 1.1  2008/03/17 16:38:11  wouter
 * added importXML
 * and rights parameter to Scherm constructor
 *
 * Revision 1.1  2008/03/17 11:37:59  wouter
 * added interface iXMLExporter and DOM functionality
 *
 */

/**
 * iXMLExporter
 */
interface iXMLExporter {
	function getGegevensAlsXML($p_aFilter = array());
}
?>