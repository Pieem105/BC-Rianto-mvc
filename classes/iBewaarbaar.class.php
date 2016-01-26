<?php
/**
 * $RCSfile: iBewaarbaar.class.php,v $
 * Author: $Author: wouter $
 * Date: $Date: 2008/04/04 10:19:08 $
 * @package complete-php-boek
 * History: 
 * $Log: iBewaarbaar.class.php,v $
 * Revision 1.1  2008/04/04 10:19:08  wouter
 * added ArtikelAanpassenScherm
 *
 */

/**
 * iBewaarbaar
 */
interface iBewaarbaar {
	function laadGegevens($p_vId);
	function slaOp();
}
?>