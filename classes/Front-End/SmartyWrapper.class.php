<?php
/**
 * $RCSfile: SmartyWrapper.class.php,v $
 * Author: $Author: wouter $
 * Date: $Date: 2008/01/20 21:57:06 $
 * @package complete-php-boek
 * History: 
 * $Log: SmartyWrapper.class.php,v $
 * Revision 1.1  2008/01/20 21:57:06  wouter
 * added smarty
 *
 * 
 */

/**
 * SmartyWrapper Wrapper class vfor Smarty to set default paths
 */ 
class SmartyWrapper extends Smarty {
	public function __construct() {
		
		parent::__construct();
		$this->template_dir = "smarty/templates/";
		$this->cache_dir = "smarty/cache/";
		$this->compile_dir = "smarty/templates_c/";
		$this->config_dir = "smarty/configs/";
		$this->addPluginsDir('smarty/plugins');
		
		$this->debugging = false;
	}
	
} 
?>
