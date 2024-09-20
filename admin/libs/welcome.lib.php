<?php
/**
 * Welcome application library
 *
 */

class Welcome extends db{

	// smarty template object
    var $tpl = null;
	var $error = null;
	
    /**
     * class constructor
     */
    function Welcome() {
        $this->tpl =& new Smarty;
		$this->db();
		
    }
    
    function displayPage() {
        global $GENERAL;
         
        $this->tpl->assign('GENERAL', $GENERAL);
		// assign error message
        $this->tpl->assign('username', isset($_SESSION['adminusername'])?$_SESSION['adminusername']:" ");
		$this->tpl->assign('error', $this->error);
		
        $this->tpl->display('welcome.tpl');
    }
}
?>