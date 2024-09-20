/*
 * SimpleModal apply Form
 * http://www.ericmmartin.com/projects/simplemodal/
 * http://code.google.com/p/simplemodal/
 *
 * Copyright (c) 2009 Eric Martin - http://ericmmartin.com
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Revision: $Id: apply.js 204 2009-06-09 22:43:28Z emartin24 $
 *
 */

var counter=0;
var page = "";
if(uid == 0)
{
	page = "createlogin.php";		
	
}
else
{
	page = "applyonline.php";	
}

if(iflogged != ""){
	$(document).ready(function () {
		//$('#applyForm input.apply, #applyForm a.apply').click(function (e) {
		//e.preventDefault();
		// load the apply form using ajax
		$.get("pages/"+page, function(data){
			// create a modal dialog with the data
			$(data).modal({
				//closeHTML: "<a href='#' title='Close' class='modalCloseX simplemodal-close'>x</a>",
				position: ["2%","10%","5%","10%"],
				overlayId: 'apply-overlay',
				containerId: 'apply-container',
				onOpen: apply.open,
				onShow: apply.show,
				onClose: apply.close
			});
		});
	//});

	// preload images
	var img = ['cancel.png', 'form_bottom.gif', 'form_top.gif', 'loading.gif', 'send.png'];
	$(img).each(function () {
		var i = new Image();
		i.src = 'images/applyonline/' + this;
	});});
}
else
{
	$(document).ready(function () {
	$('a.apply').click(function (e) {
	e.preventDefault();
		// load the apply form using ajax
		$.get("pages/"+page, function(data){
			// create a modal dialog with the data
			$(data).modal({
				//closeHTML: "<a href='#' title='Close' class='modalCloseX simplemodal-close'>x</a>",
				position: ["2%","10%","5%","10%"],
				overlayId: 'apply-overlay',
				containerId: 'apply-container',
				onOpen: apply.open,
				onShow: apply.show,
				onClose: apply.close
			});
		});
	});

	// preload images
	var img = ['cancel.png', 'form_bottom.gif', 'form_top.gif', 'loading.gif', 'send.png'];
	$(img).each(function () {
		var i = new Image();
		i.src = 'images/applyonline/' + this;
	});});
}

var apply = {
	message: null,

	open: function (dialog) {
		// add padding to the buttons in firefox/mozilla
		if ($.browser.mozilla) {
			$('#apply-container .apply-button').css({
				'padding-bottom': '2px'
			});
		}
		// input field font size
		if ($.browser.safari) {
			$('#apply-container .apply-input').css({
				'font-size': '.9em'
			});
		}

		// dynamically determine height
		var h = 190;
	
		//var title = $('#apply-container .apply-title').html();
		//$('#apply-container .apply-title').html('Loading...');
		dialog.overlay.fadeIn(200, function () {
			dialog.container.fadeIn(200, function () {
				dialog.data.fadeIn(200, function () {
					$('#apply-container .apply-content').animate({
						height: 'auto'
					}, function () {
						//$('#apply-container .apply-title').html(title);
						$('#apply-container form').fadeIn(200, function () {
							//$('#apply-username').focus();
							// fix png's for IE 6
							if ($.browser.msie && $.browser.version < 7) {
								$('#apply-container .apply-button').each(function () {
									if ($(this).css('backgroundImage').match(/^url[("']+(.*\.png)[)"']+$/i)) {
										var src = RegExp.$1;
										$(this).css({
											backgroundImage: 'none',
											filter: 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' +  src + '", sizingMethod="crop")'
										});
									}
								});
							}
						});
					});
				});
			});
		});
	},
	show: function (dialog) {

		/*$('#apply-container .apply-send').click(function (e) {
			e.preventDefault();
			// validate form
			if (apply.validate()) {
				$('#apply-container .apply-message').fadeOut(function () {
					$('#apply-container .apply-message').removeClass('apply-error').empty();
				});
				$('#apply-container .apply-title').html('Loading...');
				$('#apply-container form').fadeOut(200);
				$('#apply-container .apply-content').animate({
					height: '80px'
				}, function () {
					$('#apply-container .apply-loading').fadeIn(200, function () {
						$.ajax({
							url: 'pages/applyonline.php',
							data: $('#apply-container form').serialize() + '&action=send',
							type: 'post',
							cache: false,
							dataType: 'html',
							complete: function (xhr) {
								$('#apply-container .apply-loading').fadeOut(200, function () {
									$('#apply-container .apply-title').html('Thank you!');
									$('#apply-container .apply-message').html(xhr.responseText).fadeIn(200);
								});
							},
							error: apply.error
						});
					});
				});
			}
			else {
				if ($('#apply-container .apply-message:visible').length > 0) {
					var msg = $('#apply-container .apply-message');
					msg.fadeOut(200, function () {
						msg.empty();
						apply.showError();
						msg.fadeIn(200);
					});
				}
				else {
					$('#apply-container .apply-message').animate({
						height: '30px'
					}, apply.showError);
				}
				
			}
		});*/
		$('#apply-container .apply-create').click(function (e) {
			e.preventDefault();
			// validate form
			if (apply.validate()) {
				/*$('#apply-container .apply-message').fadeOut(function () {
					$('#apply-container .apply-message').removeClass('apply-error').empty();
				});
				$('#apply-container .apply-title').html('Loading...');
				$('#apply-container form').fadeOut(200);
				$('#apply-container .apply-content').animate({
					height: '180px'
				}, function () {
					$('#apply-container .apply-loading').fadeIn(200, function () {*/
						/*$.ajax({
							url: 'data/apply.php',
							data: $('#apply-container form').serialize() + '&action=create&divnum='+getDivId(),
							type: 'post',
							cache: false,
							dataType: 'html',
							complete: function (xhr) {
								var msg = xhr.responseText;
								//alert(msg);
								$('#apply-container .apply-loading').fadeOut(200, function () {
									//$('#apply-container .apply-title').html('Thank you!');
									//$('#apply-container .apply-message').html(msg).fadeIn(200);
									toggleFunc($('#apply-container #apply-divname').val());
									//document.getElementById('apply-message').innerHTML = xhr.responseText;
								});
							},
							error: apply.error
						});*/
						toggleFunc($('#apply-container #apply-divname').val());
				/*	});
				});*/
			}
			else {
				if ($('#apply-container .apply-message:visible').length > 0) {
//					var msg = $('#apply-container .apply-message div');
					var msg = $('#apply-container .apply-message');
					//msg.fadeOut(200, function () {
						msg.empty();
						apply.showError();
						//msg.fadeIn(200);
					//});
				}
				else {
					$('#apply-container .apply-message').animate({
						height: '30px'
					}, apply.showError);
					apply.showError();
				}
				
			}
		});
		$('#apply-container .apply-check').click(function (e) {
			e.preventDefault();
			// validate form
			if (apply.validate()) {
				/*$('#apply-container .apply-message').fadeOut(function () {
					$('#apply-container .apply-message').removeClass('apply-error').empty();
				});
				$('#apply-container .apply-title').html('Loading...');
				$('#apply-container form').fadeOut(200);
				$('#apply-container .apply-content').animate({
					height: 180
				}, function () {
					$('#apply-container .apply-loading').fadeIn(200, function () {*/
						$.ajax({
							url: 'pages/applyonline.php',
							data: $('#apply-container form').serialize() + '&action=check&divnum='+getDivId(),
							type: 'post',
							cache: false,
							dataType: 'html',
							complete: function (xhr) {
								var msg = xhr.responseText;
								//alert(msg);
								$('#apply-container .apply-loading').fadeOut(200, function () {
									//$('#apply-container .apply-title').html('Thank you!');
									//$('#apply-container .apply-message').html(msg).fadeIn(200);
									if(msg == 1){
										if(counter == 0)
										{
											// in case of email available 
											window.location.href = callbackurl+'&cmd=1';
											//toggleFunc($('#apply-container #apply-divname').val());
											toggleFunc(1);
											counter++;
										}
									}
									else
									{
										$('#apply-container .apply-title').html("Create Account");
										toggleFunc(0);
										//$('#apply-container .apply-loading').hide();
										$('#apply-container .apply-message').empty();
										$('#apply-container .apply-message').show();
										$('#apply-container .apply-message').html($('<div class="apply-error">').append("Email (user name) already taken.")).fadeIn(200);
										
										//$('#apply-container .apply-message1').fadeOut(500);
										//document.getElementById("s1").style.display = 'block';
										//$('#apply-container .apply-message').html("Email (user name) already taken.").fadeIn(200);	
									}
									//document.getElementById('apply-message').innerHTML = xhr.responseText;
								});
							},
							error: apply.error
						});
						counter = 0;
						//toggleFunc($('#apply-container #apply-divname').val());
				/*	});
				});*/
			}
			else {
				//alert(apply.message)
				if ($('#apply-container .apply-message:visible').length > 0) {
//					var msg = $('#apply-container .apply-message div');
					var msg = $('#apply-container .apply-message');
					//msg.fadeOut(200, function () {
						msg.empty();
						apply.showError();
						//msg.fadeIn(200);
					//});
				}
				else {
					$('#apply-container .apply-message').animate({
						height: '30px'
					}, apply.showError);
					apply.showError();
				}
				
			}
		});
		$('#apply-container .apply-back').click(function (e) {
			e.preventDefault();
			
				/*$('#apply-container .apply-message').fadeOut(function () {
					$('#apply-container .apply-message').removeClass('apply-error').empty();
				});
				$('#apply-container form').fadeOut(200);
				$('#apply-container .apply-content').animate({
					height: 180
				}, function () {
					$('#apply-container .apply-loading').fadeIn(200, function () {*/
						showPrevDiv();	
					/*});
				});*/
				
				
			
		});
		$('#apply-container .apply-login').click(function (e) {
			e.preventDefault();
/*				$('#apply-container .apply-message').fadeOut(function () {
					$('#apply-container .apply-message').removeClass('apply-error').empty();
				});
				$('#apply-container form').fadeOut(200);
				$('#apply-container .apply-content').animate({
					height: 180
				}, function () {
					$('#apply-container .apply-loading').fadeIn(200, function () {
*/						showLoginDiv();	
				/*	});
				});
				*/
				
			
		});
		$('#apply-container .apply-checklogin').click(function (e) {
			e.preventDefault();
			// validate form
			//$('#apply-container .apply-message').html('');
			if (apply.validateLogin()) {
				/*$('#apply-container .apply-message').fadeOut(function () {
					$('#apply-container .apply-message').removeClass('apply-error').empty();
				});
				$('#apply-container .apply-title').html('Loading...');
				$('#apply-container form').fadeOut(200);*/
				/*$('#apply-container .apply-content').animate({
					height: 180
				}, function () {*/
					/*$('#apply-container .apply-loading').fadeIn(200, function () {*/
					//alert($('#apply-container form').serialize());
						$.ajax({
							url: 'pages/applyonline.php',
							data: $('#apply-container form').serialize() + '&action=checklogin',
							type: 'post',
							cache: false,
							dataType: 'html',
							complete: function (abc) {
							var	res = abc.responseText;
								
								$('#apply-container .apply-loading').fadeOut(200, function () {
									//$('#apply-container .apply-title').html('Thank you!');
									//$('#apply-container .apply-message').html(msg).fadeIn(200);
									//alert(res);
									if(res == 1){										
										
										if(counter == 0){
											window.location.href = callbackurl+'&cmd=1';
											//toggleFunc($('#apply-container #apply-divname').val());
											toggleFunc(1);
											$('#apply-ifregistered').value = 1;
											counter++;
										}	
										
									}
									else
									{
										$('#apply-container .apply-title').html("Login Form");
										showLoginDiv();
										//$('#apply-container .apply-loading').hide();
										//$('#apply-container .apply-message').html("Invalid Email / Password.").fadeIn(200);	
										$('#apply-container .apply-message').show();
										$('#apply-container .apply-message').html($('<div class="apply-error">').append("Invalid Email / Password.")).fadeIn(200);
										//$('#apply-container .apply-message1').fadeOut(500);
										//document.getElementById("s1").style.display = 'block';
										//$('#apply-container .apply-message').html("Email (user name) already taken.").fadeIn(200);	
									}
									//document.getElementById('apply-message').innerHTML = xhr.responseText;
								});
							},
							error: apply.error
						});
						counter = 0;
					/*});*/
				/*});*/
			}
			else {
				
				if ($('#apply-container .apply-message:visible').length > 0) {
					//var msg = $('#apply-container .apply-message div');
					var msg = $('#apply-container .apply-message');
					//msg.fadeOut(200, function () {
						msg.empty();
						apply.showError();
						//msg.fadeIn(200);
					//});
				}
				else {
					$('#apply-container .apply-message').animate({
						height: '30px'
					}, apply.showError);
					apply.showError();
				}
				
			}
		});
	},
	close: function (dialog) {
		//$('#apply-container .apply-message').fadeOut();
		//$('#apply-container .apply-title').html('Goodbye...');
		/*
		$('#apply-container form').fadeOut(200);
		$('#apply-container .apply-content').animate({
			height: 40
		}, function () {
			dialog.data.fadeOut(200, function () {
				dialog.container.fadeOut(200, function () {
					dialog.overlay.fadeOut(200, function () {*/
						$.modal.close();
						window.location.href = callbackurl;
				/*	});
				});
			});
		});*/
	},
	error: function (xhr) {
		alert(xhr.statusText);
	},
	validate: function () {
		apply.message = '';
		if(getDivId() == '1')
		{
			var email = $('#apply-container #apply-username').val();
			if (!email) {
				apply.message += 'Email is required. ';
			}
			else if (!apply.validateEmail(email)) {
				apply.message += 'Email is invalid. ';
			}
	
			else if (!$('#apply-container #apply-password').val()) {
				apply.message += 'Password is required. ';
			}
			else if ($('#apply-container #apply-password').val().length < 6) {
				apply.message += 'Password must be atleast 6 characters long. ';
			}
			
			else if (!$('#apply-container #apply-confpassword').val()) {
				apply.message += 'Confirm Password is required. ';
			}
			else if($('#apply-container #apply-confpassword').val() != $('#apply-container #apply-password').val()) {
				apply.message += 'Confirm Password doesn\'t match. ';
			}
		}
		else if(getDivId() == '2')
		{
			if (!$('#apply-container #apply-oepprogrammes').val()) {
				apply.message += 'OEP Programme is required. ';
			}
			
			else if (!$('#apply-container #apply-firstname').val()) {
				apply.message += 'First name is required. ';
			}
			else if (!$('#apply-container #apply-lastname').val()) {
				apply.message += 'Last name is required.';
			}
			else if (!$('#apply-container #apply-prefix').val()) {
				apply.message += 'Prefix is required.';
			}
			else if (!$('#apply-container #apply-busemail').val()) {
				apply.message += 'Business email is required. ';
			}
			
			else if (!apply.validateEmail($('#apply-container #apply-busemail').val())) {
				apply.message += 'Business email is invalid. ';
			}
			
			else if (!$('#apply-container #apply-emergencyname').val()) {
				apply.message += 'Emergency name is required.';
			}
			else if (!$('#apply-container #apply-emergencyphone').val()) {
				apply.message += 'Emergency phone is required.';
			}
			else if (!isInteger($('#apply-container #apply-emergencyphone').val()))
			{
				apply.message += 'Emergency phone must be valid.';	
			}
			
	
		}
		else if(getDivId() == '3')
		{
			if (!$('#apply-container #apply-contactdesignation').val()) {
				apply.message += 'Designation is required. ';
			}
			else if (!$('#apply-container #apply-companyname').val()) {
				apply.message += 'Company/organization name is required.';
			}
			else if (!$('#apply-container #apply-companyaddress').val()) {
				apply.message += 'Address is required.';
			}
			else if (!$('#apply-container #apply-city').val()) {
				apply.message += 'City is required.';
			}
			else if (!$('#apply-container #apply-country').val()) {
				apply.message += 'Country is required.';
			}
			else if (!$('#apply-container #apply-ctelephone').val()) {
				apply.message += 'Telephone is required.';
			}
			else if (!isInteger($('#apply-container #apply-ctelephone').val()))
			{
				apply.message += 'Telephone must be valid.';	
			}
			else if ($('#apply-container #apply-cell').val()) {
				if (!isInteger($('#apply-container #apply-cell').val()))
				{
					apply.message += 'Cell number must be valid.';	
				}
			}
			else if ($('#apply-container #apply-fax').val()) {
				if (!isInteger($('#apply-container #apply-fax').val()))
				{
					apply.message += 'Fax number must be valid.';	
				}
			}
			
			
	
		}
		else if(getDivId() == '4')
		{
			
			if ($('#apply-container #apply-parentnumemployees').val()) {
				if(!isInteger($('#apply-container #apply-parentnumemployees').val()))
				{
					apply.message += 'Number of employees must be an integer. ';
				}
			}

			else if (!$('#apply-container #apply-services').val()) {
				apply.message += 'Product/Services is required. ';
			}
			else if (!$('#apply-container #apply-numemployees').val()) {
				apply.message += 'Number of employees is required.';
			}
			else if(!isInteger($('#apply-container #apply-numemployees').val()))
			{
				apply.message += 'Number of employees must be an integer. ';
			}
			
			else if (!$('#apply-container #apply-numemployeessupervision').val()) {
				apply.message += 'Number of employees supervision is required.';
			}
			else if(!isInteger($('#apply-container #apply-numemployeessupervision').val()))
			{
				apply.message += 'Number of employees supervision must be an integer. ';
			}
			
			else if (!$('#apply-container #apply-reportperson').val()) {
				apply.message += 'Report person is required.';
			}
			else if (!$('#apply-container #apply-industry').val()) {
				if(!$('#apply-container #apply-industryother').val())
				{
					apply.message += 'Other industry is required.';
				}
			}
			else if (!$('#apply-container #apply-position').val()) {
				if(!$('#apply-container #apply-positionother').val())
				{
					apply.message += 'Other position is required.';
				}
			}


		}
		else if(getDivId() == '5')
		{
			var sy = $('#ys').val();
			var sm = $('#ms').val();
			var sd = $('#ds').val();
			
			var ey = $('#ye').val();
			var em = $('#me').val();
			var ed = $('#de').val();
			
			$('#apply-from1').val(sy+'-'+sm+'-'+sd);
			$('#apply-to1').val(ey+'-'+em+'-'+ed);

			if (!$('#apply-container #apply-company1').val()) {
				apply.message += 'Name of company is required. ';
			}
			else if (!$('#apply-container #apply-position1').val()) {
				apply.message += 'Title/Position is required.';
			}
/*			else if (!$('#apply-container #apply-from1').val()) {
				apply.message += 'Start date is required.';
			}
			else if (!$('#apply-container #apply-to1').val()) {
				apply.message += 'End date is required.';
			}
			
*/			
			else if(!sy || !sm || !sd) {
				apply.message += 'Start date is required.';
			}
			else if(!ey || !em || !ed) {
				apply.message += 'End date is required.';
			}
			
			else if(!validDate(sy ,sm ,sd ,ey ,em ,ed)) {
				apply.message += 'End date must be greater than or equal to start date.';
			}
			
			else if (!$('#apply-container #apply-numyearsexp').val()) {
				apply.message += 'Total years experience is required.';
			}
			else if(!isInteger($('#apply-container #apply-numyearsexp').val()))
			{
				apply.message += 'Total years experience must be valid.';	
			}
			else if (!$('#apply-container #apply-responsibility').val()) {
				apply.message += 'Current responsibilities is required.';
			}
			else if (!$('#apply-container #apply-university').val()) {
				apply.message += 'University is required.';
			}
			else if (!$('#apply-container #apply-year').val()) {
				apply.message += 'Year is required.';
			}
			else if (!$('#apply-container #apply-degree').val()) {
				apply.message += 'Degree(Highest level attended) is required.';
			}
			else if (!$('#apply-objectives').val()) {
				apply.message += 'What are your objectives of attending this programme? What do you expect to achieve by the end of this programme is required.';
			}

		}
		else if(getDivId() == '6')
		{
			
			if (!$('#apply-container #apply-name').val()) {
				apply.message += 'Name is required. ';
			}
			else if (!$('#apply-container #apply-designation').val()) {
				apply.message += 'Designation is required.';
			}
			else if (!$('#apply-container #apply-address').val()) {
				apply.message += 'Address is required.';
			}
			else if (!$('#apply-container #apply-telephone').val()) {
				apply.message += 'Telephone is required.';
			}
			
			else if(!isInteger($('#apply-container #apply-telephone').val()))
			{
				apply.message += 'Telephone must be valid.';	
			}
			else if (!$('#apply-container #apply-email').val()) {
				apply.message += 'Email is required.';
			}
			else if (!apply.validateEmail($('#apply-container #apply-email').val())) {
				apply.message += 'Email is invalid. ';
			}
			
			else if ($('#apply-container #apply-invoicetelephone').val()) {
				if(!isInteger($('#apply-container #apply-invoicetelephone').val()))
				{
					apply.message += 'Telephone must be valid.';	
				}
			}

			else if ($('#apply-container #apply-invoiceemail').val()) {
				if(!apply.validateEmail($('#apply-container #apply-invoiceemail').val()))
				{
					apply.message += 'Email must be valid.';	
				}
			}

			else if ($('#apply-container #apply-executivetelephone').val()) {
				if(!isInteger($('#apply-container #apply-executivetelephone').val()))
				{
					apply.message += 'Telephone must be valid.';	
				}
			}
		
			else if ($('#apply-container #apply-executiveemail').val()) {
				if(!apply.validateEmail($('#apply-container #apply-executiveemail').val()))
				{
					apply.message += 'Email must be valid.';	
				}
			}

		}
		else if(getDivId() == '7')
		{
			apply.message = '';

		}
	
		if (apply.message.length > 0) {

				//alert(apply.message);
				return false;
		}
		else {
				return true;
		}
	},
	validateLogin: function () {
		apply.message = '';
		var email = $('#apply-container #apply-loginusername').val();
		if (!email) {
			apply.message += 'Email is required. ';
		}
		else if (!apply.validateEmail(email)) {
			apply.message += 'Email is invalid. ';
		}

		else if (!$('#apply-container #apply-loginpassword').val()) {
			apply.message += 'Password is required. ';
		}
		else if ($('#apply-container #apply-loginpassword').val().length < 6) {
			apply.message += 'Password must be atleast 6 characters long. ';
		}
		
		if (apply.message.length > 0) {

				//alert(apply.message);
				return false;
		}
		else {
				return true;
		}
	},
	validateEmail: function (email) {
		var at = email.lastIndexOf("@");

		// Make sure the at (@) sybmol exists and  
		// it is not the first or last character
		if (at < 1 || (at + 1) === email.length)
			return false;

		// Make sure there aren't multiple periods together
		if (/(\.{2,})/.test(email))
			return false;

		// Break up the local and domain portions
		var local = email.substring(0, at);
		var domain = email.substring(at + 1);

		// Check lengths
		if (local.length < 1 || local.length > 64 || domain.length < 4 || domain.length > 255)
			return false;

		// Make sure local and domain don't start with or end with a period
		if (/(^\.|\.$)/.test(local) || /(^\.|\.$)/.test(domain))
			return false;

		// Check for quoted-string addresses
		// Since almost anything is allowed in a quoted-string address,
		// we're just going to let them go through
		/*
		if (!/^"(.+)"$/.test(local)) {
			// It's a dot-string address...check for valid characters
			if (!/^[-a-zA-Z0-9!#$%*\/?|^{}`~&'+=_\.]*$/.test(local))
				return false;
		}*/

		// Make sure domain contains only valid characters and at least one period
		if (!/^[-a-zA-Z0-9\.]*$/.test(domain) || domain.indexOf(".") === -1)
			return false;	

		return true;
	},
	showError: function () {
		$('#apply-container .apply-message').html($('<div class="apply-error">').append(apply.message)).fadeIn(200);
	}
};
	


	function validDate(sy ,sm ,sd ,ey ,em ,ed)
	{
		// Start Date
		
		var syear  		= sy;
		var smonth 		= sm;
		var sday   		= sd;
		
		var startDate 	= parseInt(syear+smonth+sday);	
		
		// End Date
		
		var eyear  = ey;
		var emonth = em;
		var eday   = ed;
		
		
		var endDate 	= parseInt(eyear+emonth+eday);	
		
		
		//alert(startDate+' <--> '+endDate);
		
		if(startDate > endDate)
		{
			return false;
		}
		else
		{
			return true;	
		}
		
	}


	function isInteger(s)
	{   
		var i;
		for (i = 0; i < s.length; i++)
		{   
			// Check that current character is number.
			var c = s.charAt(i);
			if (((c < "0") || (c > "9"))) return false;
		}
		// All characters are numbers.
		return true;
	}

	
	function getDivId()
	{
		var divid = document.getElementById('apply-divname').value;	
		return divid;
	}
	
	function setDivId(val)
	{
		//alert('BEFORE SET-> '+val);
		document.getElementById('apply-divname').value = parseInt(val)+1;
		//alert('AFTER SET-> '+document.getElementById('apply-divname').value);
	}
	
	function toggleFunc(divid)
	{
		setDivId(divid);	
		//hideLoginDiv();
		//alert(getDivId());
		if(getDivId() == 8){
		$.ajax({
					url: 'pages/applyonline.php',
					data: $('#apply-container form').serialize() + '&action=create&divnum='+getDivId(),
					type: 'post',
					cache: false,
					dataType: 'html',
					complete: function (xhr) {
						var txt = xhr.responseText;
						//$('#apply-container .apply-loading').fadeOut(200, function () {
							//$('#apply-container .apply-title1').html('Success!');
							//$('#apply-container .apply-message1').html(txt).fadeIn(200);
						//});
					},
					error: apply.error
				});
		}
		if(getDivId() == 1){
			$('#s1').show();	
		}
		else
		{
			for(var i=2; i<=8; i++)
			{			
				if(getDivId() == i)
				{
					//$('#apply-container form').fadeIn(200);	
					var msg = $('#apply-container .apply-message');
					msg.hide();
					msg.removeClass('apply-error').empty();
					document.getElementById("s"+i).style.display = 'block';
					if(i<8){	
						document.getElementById("p"+i).className = 'sharp';
						document.getElementById("i"+i).src = 'images/applyonline/'+i+'.gif';
					}
					
				}
				else
				{
					//$('#apply-container form').fadeIn(200);		
					document.getElementById("s"+i).style.display = 'none';
					if(i<8){
						document.getElementById("p"+i).className = '';
						document.getElementById("i"+i).src = 'images/applyonline/'+i+'_trans.gif';
					}
					
				}
			}
		}
	}

	function ismaxlength(obj)
   	{
		var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : ""
		if (obj.getAttribute && obj.value.length>mlength)
		obj.value=obj.value.substring(0,mlength)
	}
	
	function getPrevDivId()
	{
		if(parseInt(getDivId()) == 0)
			pdivid = 1;
		else
			pdivid = getDivId();
		
		return pdivid;
	}
	
	function setPrevDivId()
	{
		//alert('BEFORE SET-> '+document.getElementById('apply-divname').value);
		document.getElementById('apply-divname').value = parseInt(document.getElementById('apply-divname').value)-1;		
		//alert('AFTER SET-> '+document.getElementById('apply-divname').value);
	}
	
	function showPrevDiv()
	{
		if($('#apply-ifregistered').value != 1 && getPrevDivId() != 2)
			setPrevDivId();
		
		//alert(getPrevDivId());
		for(var i = 2; i <= 8; i++)
		{			
			if(getPrevDivId() == i)
			{
				//$('#apply-container form').fadeIn(200);	
				var msg = $('#apply-container .apply-message');
				msg.hide();
				msg.removeClass('apply-error').empty();
				document.getElementById("s"+i).style.display = 'block';
				$('#apply-container .apply-loading').hide();
				$('#apply-container .apply-title').html('Create Account');
				if(i<8){
					document.getElementById("p"+i).className = 'sharp';
					document.getElementById("i"+i).src = 'images/applyonline/'+i+'.gif';
				}
				
			
			}
			else
			{
				//$('#apply-container form').fadeIn(200);		
				document.getElementById("s"+i).style.display = 'none';
				if(i<8){
					document.getElementById("p"+i).className = '';
					document.getElementById("i"+i).src = 'images/applyonline/'+i+'_trans.gif';
				}
				
			}
		}
		//hideLoginDiv();
	}
	
	
	function showLoginDiv()
	{
		$('.apply-message').empty();
		$('.apply-message').hide();
		//$('#apply-container form').fadeIn(200);
		//$('#s1').style.display = 'none';
		document.getElementById("s1").style.display = 'none';
		document.getElementById("login").style.display = 'block';
		//$('#login').style.display = 'block';
		//$('#login').show();
		//$('#apply-container .apply-loading').hide();
		//$('#apply-container .apply-title').html('Login Form');
		
		//$('#apply-container .apply-content').hide();
	}
	
	function hideLoginDiv()
	{
		$('#login').hide();
		//document.getElementById("login").style.display = 'none';
		//document.getElementById("s1").style.display = 'none';
		$('#s1').show();
	}
	
	function selectDropdown(combo, page)
	{	
		var dropdown = document.getElementById(combo);
		if(dropdown != null)
		{
			for(i=0;i<dropdown.options.length;i++)
			{
				if(page == dropdown.options[i].value)
				{
					dropdown.selectedIndex = i;
					break;
				}
			}
		}
	}
	

	function ifProgrammeExists()
	{
			
		if(oepid != '')
		{
			$('#oep-ul').html("<input type='hidden' name='oepprogrammes' id='apply-oepprogrammes' value='"+oepid+"'");
		}
	}