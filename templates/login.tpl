<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="{$pagedata.keywords}" />
<meta name="description" content="{$pagedata.description}" />
<title>{$pagedata.explorertitle}Login Form</title>
{include file="includes.tpl"}
<!--<script src='{$GENERAL.BASE_URL_ROOT}/js/alumnilogin.js' type='text/javascript'></script>-->
{literal}
<script type="text/javascript">
	function logoutAlumni()
	{
		document.forms["logout"].submit();
	}
</script>
{/literal}

</head>
<body>
<div id="main_container">
 {include_php file="header.php"}
<div class="contentspane">

{if $pageview eq 'display'}  
  <div  class="content">
    
	{if $error ne ''}
	<div class="error_message">
      <div class="error_header_strip">Create Account / Login</div>
      <div class="error_content_area">
      	<div style="float:left"><img src="{$GENERAL.BASE_URL_ROOT}/images/error.gif" border="0" alt="Error" style="padding-bottom:5px;"/></div><div class="error_txt1">
        {$error}</div>
      </div>
     
    </div>
    {/if}
	<div class="login_window">
      <div class="create_login">
        {if $error eq ''}
		<div class="login_strip">Create Account / Login</div>
        {elseif $error ne ''}
			<!--<div class="free_strip"></div>-->
		{/if}
		
		<div class="create_login_area"><b style="font-size:16px;">Create an Account</b><br />
          To access programme applications<br />
          <br />
          <a href="{$GENERAL.BASE_URL_ROOT}/login.php?action=create" style="border:none;"><img src="{$GENERAL.BASE_URL_ROOT}/images/createanaccount.gif" /></a>
		  </div>
      </div>
<!--      <div style="float:left; width:11px"><img src="{$GENERAL.BASE_URL_ROOT}/images/spacer.gif" /></div>-->
      <div class="create_login">
        <form name="login" id="login" method="post" action="">
			
			<div class="create_login">
			{if $error eq ''}
				<div class="login_strip"><!--Login--></div>
			{else}
          	<!--<div class="login_strip" style="background-color:#eaf4f6;">Login</div>-->
		  {/if}
		  
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
              <div class="button_area" style="margin-bottom:0px"><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/login.gif" /></div>
              <div class="button_area" >
                <div class="login_link"><a href="{$GENERAL.BASE_URL_ROOT}/login.php?action=forgot" class="level1" >Forgot Your Password?</a></div>
				<div class="login_link"><a href="{$GENERAL.BASE_URL_ROOT}/login.php?action=change" class="level1" >Change Your Password</a></div>
              </div>
            </div>
          </div>
        </div>
		</form>
      </div>
    </div>
  </div>
{elseif $pageview eq 'forgot'}
  <div  class="content">
    
	{if $error ne ''}
	<div class="error_message">
      <div class="error_header_strip">Create Account / Login</div>
       <div class="error_content_area">
      	<div style="float:left"><img src="{$GENERAL.BASE_URL_ROOT}/images/error.gif" border="0" alt="Error" style="padding-bottom:5px;"/></div>
			<div class="error_txt1">{$error}</div>
      </div>
    </div>
    {/if}
	<div class="login_window">
      <div class="create_login">
        {if $error eq ''}
		<div class="login_strip">Create Account / Login</div>
		{elseif $error ne ''}
			<div class="free_strip"></div>
        {/if}
		<div class="create_login_area"><b style="font-size:16px;">Create an Account</b><br />
          To access programme applications<br />
          <br />
          <a href="{$GENERAL.BASE_URL_ROOT}/login.php?action=create" style="border:none;"><img src="{$GENERAL.BASE_URL_ROOT}/images/createanaccount.gif" /></a>
		  </div>
      </div>
      <div style="float:left; width:11px"><img src="{$GENERAL.BASE_URL_ROOT}/images/spacer.gif" /></div>
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
              <div class="button_area"><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/submit_create_button.gif" /></div>
              <div class="button_area">
                <div class="login_link"><a href="{$GENERAL.BASE_URL_ROOT}/login.php" class="level1" >Login here?</a></div>
              </div>
            </div>
          </div>
        </div>
		</form>
      </div>
    </div>
  </div>
  {elseif $pageview eq 'change'}
  <div  class="content">
    
	{if $error ne ''}
	<div class="error_message">
      <div class="error_header_strip">Create Account / Login</div>
       <div class="error_content_area">
      	<div style="float:left"><img src="{$GENERAL.BASE_URL_ROOT}/images/error.gif" border="0" alt="Error" style="padding-bottom:5px;"/></div>
			<div class="error_txt1">{$error}</div>
      </div>
    </div>
    {/if}
	<div class="login_window">
      <div class="create_login">
        {if $error eq ''}
		<div class="login_strip">Create Account / Login</div>
		{elseif $error ne ''}
			<div class="free_strip"></div>
        {/if}
		<div class="create_login_area"><b style="font-size:16px;">Create an Account</b><br />
          To access programme applications<br />
          <br />
          <a href="{$GENERAL.BASE_URL_ROOT}/login.php?action=create" style="border:none;"><img src="{$GENERAL.BASE_URL_ROOT}/images/createanaccount.gif" /></a>
		  </div>
      </div>
      <div style="float:left; width:11px"><img src="{$GENERAL.BASE_URL_ROOT}/images/spacer.gif" /></div>
      <div class="create_login">
        <form name="login" id="login" method="post" action="">
			<div class="create_login">
          <div class="login_strip">Change Your Password</div>
          <div class="login_area" style="padding-top:10px; height:175px">
            <div style="height:29px;">
              <div class="input_txt" style="width:120px">Email:</div>
              <div class="input_area">
                <input class="input" type="text" name="email" id="email" value="{$data.email}" />
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
              <div class="button_area"><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/submit_create_button.gif" /></div>
              <div class="button_area">
                <div class="login_link"><a href="{$GENERAL.BASE_URL_ROOT}/login.php" class="level1" >Login here?</a></div>
              </div>
            </div>
          </div>
        </div>
		</form>
      </div>
    </div>
  </div>
{elseif $pageview eq 'create'}
  <div  class="content">
    	{if $error ne ''}
		<div class="error_message">
		  <div class="error_header_strip">Create Account / Login</div>
		   <div class="error_content_area">
      	<div style="float:left"><img src="{$GENERAL.BASE_URL_ROOT}/images/error.gif" border="0" alt="Error" style="padding-bottom:5px;"/></div><div class="error_txt1">
        {$error}</div>
      </div>
		</div>
		{/if}

    <div class="error_message">
      {if $error eq ''}
	  <div class="error_header_strip">Create Account / Login</div>
	  {/if}
      
	  <form name="create" id="create" action="" method="post">
	  	<div class="create_new_account">
            <div style="height:29px;">
              <div class="input_txt_create">First Name:<span class="required">&nbsp;*</span></div>
              <div class="input_area">
                <input class="input" type="text" name="firstname" id="firstname" value="{$data.firstname|escape}" />
				<input type="hidden" name="action" id="action" value="create" />
				<input type="hidden" name="state" id="state" value="submit" />
              </div>
            </div>
            <div style="height:29px;">
              <div class="input_txt_create">Last Name:<span class="required">&nbsp;*</span></div>
              <div class="input_area">
                <input class="input" type="text" name="lastname" id="lastname" value="{$data.lastname|escape}" />
              </div>
            </div>
            <div style="height:29px;">
              <div class="input_txt_create">Email:<span class="required">&nbsp;*</span></div>
              <div class="input_area">
                <input class="input" type="text" name="email" id="email" value="{$data.email|escape}" />
              </div>
            </div>
            <div style="height:29px;">
              <div class="input_txt_create">Password:<span class="required">&nbsp;*</span></div>
              <div class="input_area">
                <input class="input" type="password" name="password" id="password" value="{$data.password|escape}" />
              </div>
            </div>
            <div style="height:29px;">
              <div class="input_txt_create">Confirm Password:<span class="required">&nbsp;*</span></div>
              <div class="input_area">
                <input class="input" type="password" name="confirm_password" id="confirm_password" value="{$data.confirm_password|escape}" />
              </div>
            </div>
            <div style="float:left; width:919px; padding-top:10px;">
              <!--<div class="button_area"><input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/login.gif" /></div> -->
			  <div class="button_area_create">
			  <input type="image" src="{$GENERAL.BASE_URL_ROOT}/images/submit_create_button.gif" />
                <a href="{$GENERAL.BASE_URL_ROOT}/login.php" class="level1" >Login here?</a>
              </div>
              </div>
            </div>
	   </form>			
    </div>
    
  </div>
{/if}

</div>
<div class="clear"></div>
<div class="tabs_bar">
	<div class="tabs"></div>
</div>
{include file="footer.tpl"}
</div>
{include_php file="bar.php"}
</body>
</html>