<?php
// Process
$class1 = "apply-content";
$class2 = "apply-content1";
$action = "";
if (empty($action)) {
	// Send back the apply form HTML
	$output = "<div style='display:none;' class='wraper_login'>
	<div align='right'><a href='#' title='Close' class='modalCloseX simplemodal-close'><img src='images/applyonline/crossicon.jpg' border='0' /></a></div>
	<input type='hidden' name='divname' value='1' id='apply-divname'/>
	<input type='hidden' name='ifregistered' value='".$ifregistered."' id='apply-ifregistered'/>
	<div class='forms-apply apply-content'>
	<form action='#' style='display:block;' >
	<div class='forminputs-apply'>
	<span id='oep-ul'></span>
	<script language='javascript'>
		ifProgrammeExists();
	</script>
	<div id='s1'>
	<h2 class='apply-title'>Create Account:</h2>
	<div class='apply-loading' style='display:none;'></div>
	<div class='apply-message' style='display:none;'></div>
	<div style='height:30px;'></div>
			<ul>
            	<li class='txt'>Email (user name):<span class='required'>*</span></li>
                <li>
					<input type='text' id='apply-username' name='username' tabindex='1001' maxlength='30' class='bluebar' />
				</li>
            </ul>
			<ul>
				<li class='txt'>Password:<span class='required'>*</span></li>
				<li>
					<input type='password' id='apply-password' class='bluebar' name='password' maxlength='30' tabindex='1002' />
				</li>	
			</ul>
			<ul>
				<li class='txt'>Confirm Password:<span class='required'>*</span></li>
				<li>
					<input type='password' id='apply-confpassword' class='bluebar' name='confpassword' maxlength='30' tabindex='1003' />
				</li>	
			</ul>

			<ul>
				<li class='txt1'>&nbsp;</li>
				<li>
					<button type='button' class='next-apply apply-check apply-button' tabindex='1004'>Save &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='images/applyonline/next_bullet.gif' /></button>
				</li>	
			</ul>
			<div class='clear' />
			<p>
				<div align='center'><span class='apply-login' style='padding-left:134px; cursor:pointer; color:#000;'>Already registered, click here to login.</span></div>
				
			</p>
	
	</div>
	
	<div id='password' style='display:none'>
	<h2 class='apply-title'>Change Password:</h2>
	<div class='apply-loading' style='display:none;'></div>
	<div class='apply-message' style='display:none;'></div>
	<div style='height:30px;'></div>
			<ul>
            	<li class='txt'>Email (user name):<span class='required'>*</span></li>
                <li>
					<input type='text' id='apply-username-password' name='username_password' tabindex='1001' maxlength='30' class='bluebar' />
				</li>
            </ul>
			<ul>
				<li class='txt'>Password:<span class='required'>*</span></li>
				<li>
					<input type='password' id='apply-password-password' class='bluebar' name='password_password' maxlength='30' tabindex='1002' />
				</li>	
			</ul>
			<ul>
				<li class='txt'>New Password:<span class='required'>*</span></li>
				<li>
					<input type='password' id='apply-new-password' class='bluebar' name='newpassword_password' maxlength='30' tabindex='1002' />
				</li>	
			</ul>
			<ul>
				<li class='txt'>Confirm Password:<span class='required'>*</span></li>
				<li>
					<input type='password' id='apply-conf-new-password' class='bluebar' name='confnewpassword_password' maxlength='30' tabindex='1003' />
				</li>	
			</ul>

			<ul>
				<li class='txt1'>&nbsp;</li>
				<li>
					<button type='button' class='next-apply apply-password apply-button' tabindex='1004'>Save &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='images/applyonline/next_bullet.gif' /></button>
				</li>	
			</ul>
			<div class='clear' />
			<p>
				<div align='center' style='padding-left: 138px'><span class='apply-login' style='cursor:pointer; color:#000;'>Already registered, click here to login.</span></div>
			</p>
	
	</div>
	
	<div class='apply-content1' id='login' style='display:none;'>
	<h2 class='apply-title'>Login:</h2>
	<div class='apply-loading' style='display:none;'></div>
	<div class='apply-message' style='display:none;'></div>
	
	<div style='height:30px;'></div>
			<ul>
            	<li class='txt'>Email (user name):<span class='required'>*</span></li>
                <li>
					<input type='text' id='apply-loginusername' name='loginusername' tabindex='1001' maxlength='30' class='bluebar' />
				</li>
            </ul>
			<ul>
				<li class='txt'>Password:<span class='required'>*</span></li>
				<li>
					<input type='password' id='apply-loginpassword' class='bluebar' name='loginpassword' maxlength='30' tabindex='1002' />
				</li>	
			</ul>

			<ul>
				<li class='txt1'>&nbsp;</li>
				<li>
					<button type='submit' class='next-apply apply-checklogin apply-button' tabindex='1003'>Login &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='images/applyonline/next_bullet.gif' /></button>
				</li>	
			
			</ul>
			
			<div class='clear' />
			<p>
				<div align='center' onclick='hideLoginDiv();' style='padding-left:112px' ><span style='cursor:pointer; color:#000;' class='apply-login'>Click here to create new account.</span></div>
		
			<div align='center' onclick='showForgotDiv();' style='padding-left:22px' ><span style='cursor:pointer; color:#000;' class='apply-login'>Forgot Password?</span></div>
			<div align='center' style='padding-left:22px'><span class='apply-password-link apply-login' style='cursor:pointer; color:#000;' >Change Password</span></div>
			</p>
			
	
	</div>
	
	<div class='apply-content1' id='forgot' style='display:none;'>
	<h2 class='apply-title'>Forgot Password:</h2>
	<div class='apply-loading' style='display:none;'></div>
	<div class='apply-message' style='display:none;'></div>
	
	<div style='height:30px;'></div>
			<ul>
            	<li class='txt'>Email (user name):<span class='required'>*</span></li>
                <li>
					<input type='text' id='apply-forgotusername' name='forgotusername' tabindex='1001' maxlength='30' class='bluebar' />
				</li>
            </ul>
			<ul>
				<li class='txt1'>&nbsp;</li>
				<li>
					<button type='submit' class='next-apply apply-forgotpass apply-button' tabindex='1002'>Submit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='images/applyonline/next_bullet.gif' /></button>
				</li>	
			
			</ul>
			
			<div class='clear' />
			<p>
				<div align='center' onclick='hideForgotDiv();' style='padding-left: 110px'><span style='cursor:pointer; color:#000;' class='apply-login'>Click here to create new account.</span></div>
				<div align='center' onclick='showLoginDiv();' style='padding-left: 26px'><span style='cursor:pointer; color:#000;' class='apply-login'>Click here to login.</span></div>
			</p>
	
	</div>

	<div class='apply-content1' id='msgdiv' style='display:none;'>
	<h2 class='apply-title'>Confirmation:</h2>
	<div class='apply-message' style='display:none;'></div>
	<div class='clear' />
	<p>
		<div align='center'><span style='color:#000;'>Email has been sent to your email address.</span></div>
		<div align='center' onclick='showLoginDiv();'><span style='cursor:pointer; color:#000;'>Click here to login.</span></div>
	</p>
	</div>

	</div>
	</form>
	</div>
	<div class='apply-bottom'></div>
</div>";

//http://www.ericmmartin.com/projects/simplemodal/
	echo $output;
}

exit;

?>