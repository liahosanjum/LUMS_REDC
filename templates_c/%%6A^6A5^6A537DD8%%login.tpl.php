<?php /* Smarty version 2.6.22, created on 2011-04-26 03:18:06
         compiled from login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'login.tpl', 246, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="<?php echo $this->_tpl_vars['pagedata']['keywords']; ?>
" />
<meta name="description" content="<?php echo $this->_tpl_vars['pagedata']['description']; ?>
" />
<title><?php echo $this->_tpl_vars['pagedata']['explorertitle']; ?>
Login Form</title>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "includes.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!--<script src='<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/js/alumnilogin.js' type='text/javascript'></script>-->
<?php echo '
<script type="text/javascript">
	function logoutAlumni()
	{
		document.forms["logout"].submit();
	}
</script>
'; ?>


</head>
<body>
<div id="main_container">
 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "header.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

<div class="contentspane">

<?php if ($this->_tpl_vars['pageview'] == 'display'): ?>  
  <div  class="content">
    
	<?php if ($this->_tpl_vars['error'] != ''): ?>
	<div class="error_message">
      <div class="error_header_strip">Create Account / Login</div>
      <div class="error_content_area">
      	<div style="float:left"><img src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/images/error.gif" border="0" alt="Error" style="padding-bottom:5px;"/></div><div class="error_txt1">
        <?php echo $this->_tpl_vars['error']; ?>
</div>
      </div>
     
    </div>
    <?php endif; ?>
	<div class="login_window">
      <div class="create_login">
        <?php if ($this->_tpl_vars['error'] == ''): ?>
		<div class="login_strip">Create Account / Login</div>
        <?php elseif ($this->_tpl_vars['error'] != ''): ?>
			<!--<div class="free_strip"></div>-->
		<?php endif; ?>
		
		<div class="create_login_area"><b style="font-size:16px;">Create an Account</b><br />
          To access programme applications<br />
          <br />
          <a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/login.php?action=create" style="border:none;"><img src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/images/createanaccount.gif" /></a>
		  </div>
      </div>
<!--      <div style="float:left; width:11px"><img src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/images/spacer.gif" /></div>-->
      <div class="create_login">
        <form name="login" id="login" method="post" action="">
			
			<div class="create_login">
			<?php if ($this->_tpl_vars['error'] == ''): ?>
				<div class="login_strip"><!--Login--></div>
			<?php else: ?>
          	<!--<div class="login_strip" style="background-color:#eaf4f6;">Login</div>-->
		  <?php endif; ?>
		  
          <div class="login_area">
		  <b style="font-size:16px">Login</b><br />
            <div style="height:29px;">
              <div class="input_txt">Email:</div>
              <div class="input_area">
                <input class="input" type="text" name="loginuser" id="loginuser" />
				<input type="hidden" name="action" id="action" value="loginform" />
              </div>
            </div>
            <div style="height:30px;margin-bottom:10px;">
              <div class="input_txt">Password:</div>
              <div class="input_area">
                <input class="input" type="password" name="loginpass" id="loginpass" />
              </div>
            </div>
            <div style="width:438px;">
              <div class="button_area" style="margin-bottom:0px"><input type="image" src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/images/login.gif" /></div>
              <div class="button_area" >
                <div class="login_link"><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/login.php?action=forgot" class="level1" >Forgot Your Password?</a></div>
				<div class="login_link"><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/login.php?action=change" class="level1" >Change Your Password</a></div>
              </div>
            </div>
          </div>
        </div>
		</form>
      </div>
    </div>
  </div>
<?php elseif ($this->_tpl_vars['pageview'] == 'forgot'): ?>
  <div  class="content">
    
	<?php if ($this->_tpl_vars['error'] != ''): ?>
	<div class="error_message">
      <div class="error_header_strip">Create Account / Login</div>
       <div class="error_content_area">
      	<div style="float:left"><img src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/images/error.gif" border="0" alt="Error" style="padding-bottom:5px;"/></div>
			<div class="error_txt1"><?php echo $this->_tpl_vars['error']; ?>
</div>
      </div>
    </div>
    <?php endif; ?>
	<div class="login_window">
      <div class="create_login">
        <?php if ($this->_tpl_vars['error'] == ''): ?>
		<div class="login_strip">Create Account / Login</div>
		<?php elseif ($this->_tpl_vars['error'] != ''): ?>
			<div class="free_strip"></div>
        <?php endif; ?>
		<div class="create_login_area"><b style="font-size:16px;">Create an Account</b><br />
          To access programme applications<br />
          <br />
          <a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/login.php?action=create" style="border:none;"><img src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/images/createanaccount.gif" /></a>
		  </div>
      </div>
      <div style="float:left; width:11px"><img src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/images/spacer.gif" /></div>
      <div class="create_login">
        <form name="login" id="login" method="post" action="">
			<div class="create_login">
          <div class="login_strip">Forgot Your Password</div>
          <div class="login_area">
            <div style="height:29px;">
              <div class="input_txt">Email:</div>
              <div class="input_area">
                <input class="input" type="text" name="forgotuser" id="forgotuser" />
				<input type="hidden" name="action" id="action" value="forgot" />
				<input type="hidden" name="state" id="state" value="submit" />
              </div>
            </div>
            <div style="height:30px;margin-bottom:10px;">
             <!-- <div class="input_txt">Password:</div>
              <div class="input_area">
                <input class="input" type="text" name="loginpass" id="loginpass" />
              </div>-->
            </div>
            <div style="width:438px;">
              <div class="button_area"><input type="image" src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/images/submit_create_button.gif" /></div>
              <div class="button_area">
                <div class="login_link"><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/login.php" class="level1" >Login here?</a></div>
              </div>
            </div>
          </div>
        </div>
		</form>
      </div>
    </div>
  </div>
  <?php elseif ($this->_tpl_vars['pageview'] == 'change'): ?>
  <div  class="content">
    
	<?php if ($this->_tpl_vars['error'] != ''): ?>
	<div class="error_message">
      <div class="error_header_strip">Create Account / Login</div>
       <div class="error_content_area">
      	<div style="float:left"><img src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/images/error.gif" border="0" alt="Error" style="padding-bottom:5px;"/></div>
			<div class="error_txt1"><?php echo $this->_tpl_vars['error']; ?>
</div>
      </div>
    </div>
    <?php endif; ?>
	<div class="login_window">
      <div class="create_login">
        <?php if ($this->_tpl_vars['error'] == ''): ?>
		<div class="login_strip">Create Account / Login</div>
		<?php elseif ($this->_tpl_vars['error'] != ''): ?>
			<div class="free_strip"></div>
        <?php endif; ?>
		<div class="create_login_area"><b style="font-size:16px;">Create an Account</b><br />
          To access programme applications<br />
          <br />
          <a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/login.php?action=create" style="border:none;"><img src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/images/createanaccount.gif" /></a>
		  </div>
      </div>
      <div style="float:left; width:11px"><img src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/images/spacer.gif" /></div>
      <div class="create_login">
        <form name="login" id="login" method="post" action="">
			<div class="create_login">
          <div class="login_strip">Change Your Password</div>
          <div class="login_area" style="padding-top:10px; height:175px">
            <div style="height:29px;">
              <div class="input_txt" style="width:120px">Email:</div>
              <div class="input_area">
                <input class="input" type="text" name="email" id="email" value="<?php echo $this->_tpl_vars['data']['email']; ?>
" />
				<input type="hidden" name="action" id="action" value="change" />
				<input type="hidden" name="state" id="state" value="submit" />
              </div>
            </div>
			<div style="height:29px;">
              <div class="input_txt" style="width:120px">Current Password:</div>
              <div class="input_area">
                <input class="input" type="password" name="currentpassword" id="currentpassword" />
              </div>
            </div>
			<div style="height:29px;">
              <div class="input_txt" style="width:120px">New Password:</div>
              <div class="input_area">
                <input class="input" type="password" name="newpassword" id="newpassword" />
              </div>
            </div>
			<div style="height:29px;">
              <div class="input_txt" style="width:120px">Confirm New Password:</div>
              <div class="input_area">
                <input class="input" type="password" name="confirmnewpassword" id="confirmnewpassword" />
              </div>
            </div>
            <div style="height:10px;">
             <!-- <div class="input_txt">Password:</div>
              <div class="input_area">
                <input class="input" type="text" name="loginpass" id="loginpass" />
              </div>-->
            </div>
            <div style="width:438px; padding-left:40px">
              <div class="button_area"><input type="image" src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/images/submit_create_button.gif" /></div>
              <div class="button_area">
                <div class="login_link"><a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/login.php" class="level1" >Login here?</a></div>
              </div>
            </div>
          </div>
        </div>
		</form>
      </div>
    </div>
  </div>
<?php elseif ($this->_tpl_vars['pageview'] == 'create'): ?>
  <div  class="content">
    	<?php if ($this->_tpl_vars['error'] != ''): ?>
		<div class="error_message">
		  <div class="error_header_strip">Create Account / Login</div>
		   <div class="error_content_area">
      	<div style="float:left"><img src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/images/error.gif" border="0" alt="Error" style="padding-bottom:5px;"/></div><div class="error_txt1">
        <?php echo $this->_tpl_vars['error']; ?>
</div>
      </div>
		</div>
		<?php endif; ?>

    <div class="error_message">
      <?php if ($this->_tpl_vars['error'] == ''): ?>
	  <div class="error_header_strip">Create Account / Login</div>
	  <?php endif; ?>
      
	  <form name="create" id="create" action="" method="post">
	  	<div class="create_new_account">
            <div style="height:29px;">
              <div class="input_txt_create">First Name:<span class="required">&nbsp;*</span></div>
              <div class="input_area">
                <input class="input" type="text" name="firstname" id="firstname" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['firstname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
				<input type="hidden" name="action" id="action" value="create" />
				<input type="hidden" name="state" id="state" value="submit" />
              </div>
            </div>
            <div style="height:29px;">
              <div class="input_txt_create">Last Name:<span class="required">&nbsp;*</span></div>
              <div class="input_area">
                <input class="input" type="text" name="lastname" id="lastname" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['lastname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
              </div>
            </div>
            <div style="height:29px;">
              <div class="input_txt_create">Email:<span class="required">&nbsp;*</span></div>
              <div class="input_area">
                <input class="input" type="text" name="email" id="email" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['email'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
              </div>
            </div>
            <div style="height:29px;">
              <div class="input_txt_create">Password:<span class="required">&nbsp;*</span></div>
              <div class="input_area">
                <input class="input" type="password" name="password" id="password" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['password'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
              </div>
            </div>
            <div style="height:29px;">
              <div class="input_txt_create">Confirm Password:<span class="required">&nbsp;*</span></div>
              <div class="input_area">
                <input class="input" type="password" name="confirm_password" id="confirm_password" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['confirm_password'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
              </div>
            </div>
            <div style="float:left; width:919px; padding-top:10px;">
              <!--<div class="button_area"><input type="image" src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/images/login.gif" /></div> -->
			  <div class="button_area_create">
			  <input type="image" src="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/images/submit_create_button.gif" />
                <a href="<?php echo $this->_tpl_vars['GENERAL']['BASE_URL_ROOT']; ?>
/login.php" class="level1" >Login here?</a>
              </div>
              </div>
            </div>
	   </form>			
    </div>
    
  </div>
<?php endif; ?>

</div>
<div class="clear"></div>
<div class="tabs_bar">
	<div class="tabs"></div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "bar.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</body>
</html>