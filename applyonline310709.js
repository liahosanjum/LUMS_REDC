/*
 * SimpleModal Contact Form
 * http://www.ericmmartin.com/projects/simplemodal/
 * http://code.google.com/p/simplemodal/
 *
 * Copyright (c) 2009 Eric Martin - http://ericmmartin.com
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Revision: $Id: contact.js 204 2009-06-09 22:43:28Z emartin24 $
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
$(document).ready(function () {
	//$('#contactForm input.contact, #contactForm a.contact').click(function (e) {
		//e.preventDefault();
		// load the contact form using ajax
		$.get("pages/"+page, function(data){
			// create a modal dialog with the data
			$(data).modal({
				//closeHTML: "<a href='#' title='Close' class='modalCloseX simplemodal-close'>x</a>",
				position: ["15%","15%","15%","15%"],
				overlayId: 'contact-overlay',
				containerId: 'contact-container',
				onOpen: contact.open,
				onShow: contact.show,
				onClose: contact.close
			});
		});
	//});

	// preload images
	var img = ['cancel.png', 'form_bottom.gif', 'form_top.gif', 'loading.gif', 'send.png'];
	$(img).each(function () {
		var i = new Image();
		i.src = 'images/applyonline/' + this;
	});
});

var contact = {
	message: null,

	open: function (dialog) {
		// add padding to the buttons in firefox/mozilla
		if ($.browser.mozilla) {
			$('#contact-container .contact-button').css({
				'padding-bottom': '2px'
			});
		}
		// input field font size
		if ($.browser.safari) {
			$('#contact-container .contact-input').css({
				'font-size': '.9em'
			});
		}

		// dynamically determine height
		var h = 190;
		if ($('#contact-subject').length) {
			h += 26;
		}
		if ($('#contact-cc').length) {
			h += 22;
		}

		var title = $('#contact-container .contact-title').html();
		$('#contact-container .contact-title').html('Loading...');
		dialog.overlay.fadeIn(200, function () {
			dialog.container.fadeIn(200, function () {
				dialog.data.fadeIn(200, function () {
					$('#contact-container .contact-content').animate({
						height: 'auto'
					}, function () {
						$('#contact-container .contact-title').html(title);
						$('#contact-container form').fadeIn(200, function () {
							$('#contact-container #contact-name').focus();

							$('#contact-container .contact-cc').click(function () {
								var cc = $('#contact-container #contact-cc');
								cc.is(':checked') ? cc.attr('checked', '') : cc.attr('checked', 'checked');
							});

							// fix png's for IE 6
							if ($.browser.msie && $.browser.version < 7) {
								$('#contact-container .contact-button').each(function () {
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

		$('#contact-container .contact-send').click(function (e) {
			e.preventDefault();
			// validate form
			if (contact.validate()) {
				$('#contact-container .contact-message').fadeOut(function () {
					$('#contact-container .contact-message').removeClass('contact-error').empty();
				});
				$('#contact-container .contact-title').html('Loading...');
				$('#contact-container form').fadeOut(200);
				$('#contact-container .contact-content').animate({
					height: '80px'
				}, function () {
					$('#contact-container .contact-loading').fadeIn(200, function () {
						$.ajax({
							url: 'pages/applyonline.php',
							data: $('#contact-container form').serialize() + '&action=send',
							type: 'post',
							cache: false,
							dataType: 'html',
							complete: function (xhr) {
								$('#contact-container .contact-loading').fadeOut(200, function () {
									$('#contact-container .contact-title').html('Thank you!');
									$('#contact-container .contact-message').html(xhr.responseText).fadeIn(200);
								});
							},
							error: contact.error
						});
					});
				});
			}
			else {
				if ($('#contact-container .contact-message:visible').length > 0) {
					var msg = $('#contact-container .contact-message');
					msg.fadeOut(200, function () {
						msg.empty();
						contact.showError();
						msg.fadeIn(200);
					});
				}
				else {
					$('#contact-container .contact-message').animate({
						height: '30px'
					}, contact.showError);
				}
				
			}
		});
		$('#contact-container .contact-create').click(function (e) {
			e.preventDefault();
			// validate form
			if (contact.validate()) {
				/*$('#contact-container .contact-message').fadeOut(function () {
					$('#contact-container .contact-message').removeClass('contact-error').empty();
				});
				$('#contact-container .contact-title').html('Loading...');
				$('#contact-container form').fadeOut(200);
				$('#contact-container .contact-content').animate({
					height: '180px'
				}, function () {
					$('#contact-container .contact-loading').fadeIn(200, function () {*/
						/*$.ajax({
							url: 'data/contact.php',
							data: $('#contact-container form').serialize() + '&action=create&divnum='+getDivId(),
							type: 'post',
							cache: false,
							dataType: 'html',
							complete: function (xhr) {
								var msg = xhr.responseText;
								//alert(msg);
								$('#contact-container .contact-loading').fadeOut(200, function () {
									//$('#contact-container .contact-title').html('Thank you!');
									//$('#contact-container .contact-message').html(msg).fadeIn(200);
									toggleFunc($('#contact-container #contact-divname').val());
									//document.getElementById('contact-message').innerHTML = xhr.responseText;
								});
							},
							error: contact.error
						});*/
						toggleFunc($('#contact-container #contact-divname').val());
				/*	});
				});*/
			}
			else {
				if ($('#contact-container .contact-message:visible').length > 0) {
//					var msg = $('#contact-container .contact-message div');
					var msg = $('#contact-container .contact-message');
					msg.fadeOut(200, function () {
						msg.empty();
						contact.showError();
						msg.fadeIn(200);
					});
				}
				else {
					$('#contact-container .contact-message').animate({
						height: '30px'
					}, contact.showError);
				}
				
			}
		});
		$('#contact-container .contact-check').click(function (e) {
			e.preventDefault();
			// validate form
			if (contact.validate()) {
				/*$('#contact-container .contact-message').fadeOut(function () {
					$('#contact-container .contact-message').removeClass('contact-error').empty();
				});
				$('#contact-container .contact-title').html('Loading...');
				$('#contact-container form').fadeOut(200);
				$('#contact-container .contact-content').animate({
					height: 180
				}, function () {
					$('#contact-container .contact-loading').fadeIn(200, function () {*/
						$.ajax({
							url: 'pages/applyonline.php',
							data: $('#contact-container form').serialize() + '&action=check&divnum='+getDivId(),
							type: 'post',
							cache: false,
							dataType: 'html',
							complete: function (xhr) {
								var msg = xhr.responseText;
								//alert(msg);
								$('#contact-container .contact-loading').fadeOut(200, function () {
									//$('#contact-container .contact-title').html('Thank you!');
									//$('#contact-container .contact-message').html(msg).fadeIn(200);
									if(msg == 1){
										if(counter == 0)
										{
											// in case of email available 
											window.location.href = '';
											//toggleFunc($('#contact-container #contact-divname').val());
											toggleFunc(1);
											counter++;
										}
									}
									else
									{
										$('#contact-container .contact-title').html("Create Account");
										toggleFunc(0);
										$('#contact-container .contact-loading').hide();
										$('#contact-container .contact-message').html("Email (user name) already taken.").fadeIn(200);	
										$('#contact-container .contact-message').show();
										//$('#contact-container .contact-message1').fadeOut(500);
										//document.getElementById("s1").style.display = 'block';
										//$('#contact-container .contact-message').html("Email (user name) already taken.").fadeIn(200);	
									}
									//document.getElementById('contact-message').innerHTML = xhr.responseText;
								});
							},
							error: contact.error
						});
						counter = 0;
						//toggleFunc($('#contact-container #contact-divname').val());
				/*	});
				});*/
			}
			else {
				if ($('#contact-container .contact-message:visible').length > 0) {
//					var msg = $('#contact-container .contact-message div');
					var msg = $('#contact-container .contact-message');
					msg.fadeOut(200, function () {
						msg.empty();
						contact.showError();
						msg.fadeIn(200);
					});
				}
				else {
					$('#contact-container .contact-message').animate({
						height: '30px'
					}, contact.showError);
				}
				
			}
		});
		$('#contact-container .contact-back').click(function (e) {
			e.preventDefault();
			
				/*$('#contact-container .contact-message').fadeOut(function () {
					$('#contact-container .contact-message').removeClass('contact-error').empty();
				});
				$('#contact-container form').fadeOut(200);
				$('#contact-container .contact-content').animate({
					height: 180
				}, function () {
					$('#contact-container .contact-loading').fadeIn(200, function () {*/
						showPrevDiv();	
					/*});
				});*/
				
				
			
		});
		$('#contact-container .contact-login').click(function (e) {
			e.preventDefault();
			
				$('#contact-container .contact-message').fadeOut(function () {
					$('#contact-container .contact-message').removeClass('contact-error').empty();
				});
				$('#contact-container form').fadeOut(200);
				$('#contact-container .contact-content').animate({
					height: 180
				}, function () {
					$('#contact-container .contact-loading').fadeIn(200, function () {
						showLoginDiv();	
					});
				});
				
				
			
		});
		$('#contact-container .contact-checklogin').click(function (e) {
			e.preventDefault();
			// validate form
			if (contact.validateLogin()) {
				/*$('#contact-container .contact-message').fadeOut(function () {
					$('#contact-container .contact-message').removeClass('contact-error').empty();
				});
				$('#contact-container .contact-title').html('Loading...');
				$('#contact-container form').fadeOut(200);*/
				/*$('#contact-container .contact-content').animate({
					height: 180
				}, function () {*/
					/*$('#contact-container .contact-loading').fadeIn(200, function () {*/
					//alert($('#contact-container form').serialize());
						$.ajax({
							url: 'pages/applyonline.php',
							data: $('#contact-container form').serialize() + '&action=checklogin',
							type: 'post',
							cache: false,
							dataType: 'html',
							complete: function (abc) {
							var	res = abc.responseText;
								
								$('#contact-container .contact-loading').fadeOut(200, function () {
									//$('#contact-container .contact-title').html('Thank you!');
									//$('#contact-container .contact-message').html(msg).fadeIn(200);
									//alert(res);
									if(res == 1){										
										
										if(counter == 0){
											window.location.href = '';
											//toggleFunc($('#contact-container #contact-divname').val());
											toggleFunc(1);
											$('#contact-ifregistered').value = 1;
											counter++;
										}	
										
									}
									else
									{
										$('#contact-container .contact-title').html("Login Form");
										showLoginDiv();
										$('#contact-container .contact-loading').hide();
										$('#contact-container .contact-message').html("Invalid Email / Password.").fadeIn(200);	
										$('#contact-container .contact-message').show();
										//$('#contact-container .contact-message1').fadeOut(500);
										//document.getElementById("s1").style.display = 'block';
										//$('#contact-container .contact-message').html("Email (user name) already taken.").fadeIn(200);	
									}
									//document.getElementById('contact-message').innerHTML = xhr.responseText;
								});
							},
							error: contact.error
						});
						counter = 0;
					/*});*/
				/*});*/
			}
			else {
				if ($('#contact-container .contact-message:visible').length > 0) {
//					var msg = $('#contact-container .contact-message div');
					var msg = $('#contact-container .contact-message');
					msg.fadeOut(200, function () {
						msg.empty();
						contact.showError();
						msg.fadeIn(200);
					});
				}
				else {
					$('#contact-container .contact-message').animate({
						height: '30px'
					}, contact.showError);
				}
				
			}
		});
	},
	close: function (dialog) {
		$('#contact-container .contact-message').fadeOut();
		$('#contact-container .contact-title').html('Goodbye...');
		$('#contact-container form').fadeOut(200);
		$('#contact-container .contact-content').animate({
			height: 40
		}, function () {
			dialog.data.fadeOut(200, function () {
				dialog.container.fadeOut(200, function () {
					dialog.overlay.fadeOut(200, function () {
						$.modal.close();
					});
				});
			});
		});
	},
	error: function (xhr) {
		alert(xhr.statusText);
	},
	validate: function () {
		contact.message = '';
	
/*		if(getDivId() == '1')
		{
			var email = $('#contact-container #contact-username').val();
			if (!email) {
				contact.message += 'Email is required. ';
			}
			else if (!contact.validateEmail(email)) {
				contact.message += 'Email is invalid. ';
			}
	
			else if (!$('#contact-container #contact-password').val()) {
				contact.message += 'Password is required. ';
			}
			else if ($('#contact-container #contact-password').val().length < 6) {
				contact.message += 'Password must be atleast 6 characters long. ';
			}
			
			else if (!$('#contact-container #contact-confpassword').val()) {
				contact.message += 'Confirm Password is required. ';
			}
			else if($('#contact-container #contact-confpassword').val() != $('#contact-container #contact-password').val()) {
				contact.message += 'Confirm Password doesn\'t match. ';
			}
		}
		else if(getDivId() == '2')
		{
			if (!$('#contact-container #contact-firstname').val()) {
				contact.message += 'First name is required. ';
			}
			else if (!$('#contact-container #contact-lastname').val()) {
				contact.message += 'Last name is required.';
			}
			else if (!$('#contact-container #contact-prefix').val()) {
				contact.message += 'Prefix is required.';
			}
			else if (!$('#contact-container #contact-busemail').val()) {
				contact.message += 'Business email is required. ';
			}
			
			else if (!contact.validateEmail($('#contact-container #contact-busemail').val())) {
				contact.message += 'Business email is invalid. ';
			}
			
			else if (!$('#contact-container #contact-emergencyname').val()) {
				contact.message += 'Emergency name is required.';
			}
			else if (!$('#contact-container #contact-emergencyphone').val()) {
				contact.message += 'Emergency phone is required.';
			}
			else if (!isInteger($('#contact-container #contact-emergencyphone').val()))
			{
				contact.message += 'Emergency phone must be valid.';	
			}
			
	
		}
		else if(getDivId() == '3')
		{
			if (!$('#contact-container #contact-contactdesignation').val()) {
				contact.message += 'Designation is required. ';
			}
			else if (!$('#contact-container #contact-companyname').val()) {
				contact.message += 'Company/organization name is required.';
			}
			else if (!$('#contact-container #contact-companyaddress').val()) {
				contact.message += 'Address is required.';
			}
			else if (!$('#contact-container #contact-city').val()) {
				contact.message += 'City is required.';
			}
			else if (!$('#contact-container #contact-country').val()) {
				contact.message += 'Country is required.';
			}
			else if (!$('#contact-container #contact-ctelephone').val()) {
				contact.message += 'Telephone is required.';
			}
			else if (!isInteger($('#contact-container #contact-ctelephone').val()))
			{
				contact.message += 'Telephone must be valid.';	
			}
			else if ($('#contact-container #contact-cell').val()) {
				if (!isInteger($('#contact-container #contact-cell').val()))
				{
					contact.message += 'Cell number must be valid.';	
				}
			}
			else if ($('#contact-container #contact-fax').val()) {
				if (!isInteger($('#contact-container #contact-fax').val()))
				{
					contact.message += 'Fax number must be valid.';	
				}
			}
			
			
	
		}
		else if(getDivId() == '4')
		{
			
			if ($('#contact-container #contact-parentnumemployees').val()) {
				if(!isInteger($('#contact-container #contact-parentnumemployees').val()))
				{
					contact.message += 'Number of employees must be an integer. ';
				}
			}

			else if (!$('#contact-container #contact-services').val()) {
				contact.message += 'Product/Services is required. ';
			}
			else if (!$('#contact-container #contact-numemployees').val()) {
				contact.message += 'Number of employees is required.';
			}
			else if(!isInteger($('#contact-container #contact-numemployees').val()))
			{
				contact.message += 'Number of employees must be an integer. ';
			}
			
			else if (!$('#contact-container #contact-numemployeessupervision').val()) {
				contact.message += 'Number of employees supervision is required.';
			}
			else if(!isInteger($('#contact-container #contact-numemployeessupervision').val()))
			{
				contact.message += 'Number of employees supervision must be an integer. ';
			}
			
			else if (!$('#contact-container #contact-reportperson').val()) {
				contact.message += 'Report person is required.';
			}
			else if (!$('#contact-container #contact-industry').val()) {
				if(!$('#contact-container #contact-industryother').val())
				{
					contact.message += 'Specify other industry is required.';
				}
			}
			else if (!$('#contact-container #contact-position').val()) {
				if(!$('#contact-container #contact-positionother').val())
				{
					contact.message += 'Specify other position is required.';
				}
			}


		}
		else if(getDivId() == '5')
		{
			
			if (!$('#contact-container #contact-company1').val()) {
				contact.message += 'Name of company is required. ';
			}
			else if (!$('#contact-container #contact-position1').val()) {
				contact.message += 'Title/Position is required.';
			}
			else if (!$('#contact-container #contact-from1').val()) {
				contact.message += 'Start date is required.';
			}
			else if (!$('#contact-container #contact-to1').val()) {
				contact.message += 'End date is required.';
			}
			else if (!$('#contact-container #contact-numyearsexp').val()) {
				contact.message += 'Total years experience is required.';
			}
			else if(!isInteger($('#contact-container #contact-numyearsexp').val()))
			{
				contact.message += 'Total years experience must be valid.';	
			}
			else if (!$('#contact-container #contact-responsibility').val()) {
				contact.message += 'Current responsibilities is required.';
			}
			else if (!$('#contact-container #contact-university').val()) {
				contact.message += 'University is required.';
			}
			else if (!$('#contact-container #contact-year').val()) {
				contact.message += 'Year is required.';
			}
			else if (!$('#contact-container #contact-degree').val()) {
				contact.message += 'Degree(Highest level attended) is required.';
			}


		}
		else if(getDivId() == '6')
		{
			
			if (!$('#contact-container #contact-name').val()) {
				contact.message += 'Name is required. ';
			}
			else if (!$('#contact-container #contact-designation').val()) {
				contact.message += 'Designation is required.';
			}
			else if (!$('#contact-container #contact-address').val()) {
				contact.message += 'Address is required.';
			}
			else if (!$('#contact-container #contact-telephone').val()) {
				contact.message += 'Telephone is required.';
			}
			
			else if(!isInteger($('#contact-container #contact-telephone').val()))
			{
				contact.message += 'Telephone must be valid.';	
			}
			else if (!$('#contact-container #contact-email').val()) {
				contact.message += 'Email is required.';
			}
			else if (!contact.validateEmail($('#contact-container #contact-email').val())) {
				contact.message += 'Email is invalid. ';
			}
			
			else if ($('#contact-container #contact-invoicetelephone').val()) {
				if(!isInteger($('#contact-container #contact-invoicetelephone').val()))
				{
					contact.message += 'Telephone must be valid.';	
				}
			}

			else if ($('#contact-container #contact-invoiceemail').val()) {
				if(!contact.validateEmail($('#contact-container #contact-invoiceemail').val()))
				{
					contact.message += 'Email must be valid.';	
				}
			}

			else if ($('#contact-container #contact-executivetelephone').val()) {
				if(!isInteger($('#contact-container #contact-executivetelephone').val()))
				{
					contact.message += 'Telephone must be valid.';	
				}
			}
		
			else if ($('#contact-container #contact-executiveemail').val()) {
				if(!contact.validateEmail($('#contact-container #contact-executiveemail').val()))
				{
					contact.message += 'Email must be valid.';	
				}
			}

		}
		else if(getDivId() == '7')
		{
			
			if (!$('#contact-container #contact-oepprogrammes').val()) {
				contact.message += 'OEP Programme is required. ';
			}

		}
*/		
		if (contact.message.length > 0) {

				//alert(contact.message);
				return false;
		}
		else {
				return true;
		}
	},
	validateLogin: function () {
		contact.message = '';
/*		var email = $('#contact-container #contact-loginusername').val();
		if (!email) {
			contact.message += 'Email is required. ';
		}
		else if (!contact.validateEmail(email)) {
			contact.message += 'Email is invalid. ';
		}

		else if (!$('#contact-container #contact-loginpassword').val()) {
			contact.message += 'Password is required. ';
		}
		else if ($('#contact-container #contact-loginpassword').val().length < 6) {
			contact.message += 'Password must be atleast 6 characters long. ';
		}
*/		
		if (contact.message.length > 0) {

				//alert(contact.message);
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
		if (!/^"(.+)"$/.test(local)) {
			// It's a dot-string address...check for valid characters
			if (!/^[-a-zA-Z0-9!#$%*\/?|^{}`~&'+=_\.]*$/.test(local))
				return false;
		}

		// Make sure domain contains only valid characters and at least one period
		if (!/^[-a-zA-Z0-9\.]*$/.test(domain) || domain.indexOf(".") === -1)
			return false;	

		return true;
	},
	showError: function () {
		$('#contact-container .contact-message').html($('<div class="contact-error">').append(contact.message)).fadeIn(200);
	}
};
	
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
		var divid = document.getElementById('contact-divname').value;	
		return divid;
	}
	
	function setDivId(val)
	{
		alert('BEFORE SET-> '+val);
		document.getElementById('contact-divname').value = parseInt(val)+1;
		alert('AFTER SET-> '+document.getElementById('contact-divname').value);
	}
	
	function toggleFunc(divid)
	{
		setDivId(divid);	
		hideLoginDiv();
		//alert(getDivId());
		if(getDivId() == 8){
		$.ajax({
					url: 'pages/applyonline.php',
					data: $('#contact-container form').serialize() + '&action=create&divnum='+getDivId(),
					type: 'post',
					cache: false,
					dataType: 'html',
					complete: function (xhr) {
						var txt = xhr.responseText;
						$('#contact-container .contact-loading').fadeOut(200, function () {
							$('#contact-container .contact-title1').html('Success!');
							$('#contact-container .contact-message1').html(txt).fadeIn(200);
						});
					},
					error: contact.error
				});
		}
		for(var i=1; i<=8; i++)
		{			
			if(getDivId() == i)
			{
				$('#contact-container form').fadeIn(200);	
				var msg = $('#contact-container .contact-message');
				msg.hide();
				msg.removeClass('contact-error').empty();
				document.getElementById("s"+i).style.display = 'block';
			}
			else
			{
				$('#contact-container form').fadeIn(200);		
				document.getElementById("s"+i).style.display = 'none';
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
		alert('BEFORE SET-> '+document.getElementById('contact-divname').value);
		document.getElementById('contact-divname').value = parseInt(document.getElementById('contact-divname').value)-1;		
		alert('AFTER SET-> '+document.getElementById('contact-divname').value);
	}
	
	function showPrevDiv()
	{
		if($('#contact-ifregistered').value != 1 && getPrevDivId() != 2)
			setPrevDivId();
		
		//alert(getPrevDivId());
		for(var i = 1; i <= 8; i++)
		{			
			if(getPrevDivId() == i)
			{
				$('#contact-container form').fadeIn(200);	
				var msg = $('#contact-container .contact-message');
				msg.hide();
				msg.removeClass('contact-error').empty();
				document.getElementById("s"+i).style.display = 'block';
				$('#contact-container .contact-loading').hide();
				$('#contact-container .contact-title').html('Create Account');
			
			}
			else
			{
				$('#contact-container form').fadeIn(200);		
				document.getElementById("s"+i).style.display = 'none';
			}
		}
		hideLoginDiv();
	}
	
	
	function showLoginDiv()
	{
		$('#contact-container form').fadeIn(200);
		//document.getElementById("login").style.display = 'block';
		$('#login').show();
		$('#contact-container .contact-loading').hide();
		$('#contact-container .contact-title').html('Login Form');
		$('#contact-container .contact-content').hide();
	}
	
	function hideLoginDiv()
	{
		document.getElementById("login").style.display = 'none';
	}