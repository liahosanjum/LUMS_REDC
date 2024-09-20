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
	var counter = 0;
	var message = '';
	
	function showNextDiv()
	{
		$('.contact-message').html('');	
		$('.contact-message').hide();

		if (validate()) {
			toggleFunc($('.contact-divname').val());
		}
		else{
			$('.contact-message').html(message);	
			$('.contact-message').show();
		}	
	}
	
	function ifValidLogin()
	{
		$('#contact-message').html('');	
		$('#contact-message').hide();

		if (validateLogin()) {
			$.ajax({
						url: 'pages/applynowoep.php',
						data: $('form').serialize() + '&action=checklogin',
						type: 'post',
						cache: false,
						dataType: 'html',
						complete: function (abc) {
						var	res = abc.responseText;
							//alert(res);
							if(res != 0){										
								if(counter == 0){
									// refresh page to get the existing record of user if successfull login
									window.location.href = '';
									/*
									toggleFunc(1);
									$('#contact-ifregistered').value = 1;
									counter++;
									*/
								}	
							}
							else
							{
								$('#contact-title').html("Login Form");
								showLoginDiv();
								$('.contact-loading').hide();
								$('#contact-message').html("Invalid Email / Password.");	
								$('#contact-message').show();
							}
						}
					});
			counter = 0;
		}
		else{
			$('#contact-message').html(message);	
			$('#contact-message').show();
		}
	}
	
	function checkAvailability()
	{
		
		$('#contact-message').html('');	
		$('#contact-message').hide();

			if (validate()) {
				$.ajax({
					url: 'pages/applynowoep.php',
					data: $('form').serialize() + '&action=check&divnum='+getDivId(),
					type: 'post',
					cache: false,
					dataType: 'html',
					complete: function (xhr) {
						var msg = xhr.responseText;
						//alert(msg);
						if(msg == 1){
							if(counter == 0)
							{
								toggleFunc(1);
								counter++;
							}
						}
						else
						{
							$('#contact-title').html("Create Account");
							toggleFunc(0);
							$('.contact-loading').hide();
							$('#contact-message').html("Email (user name) already taken.");	
							$('#contact-message').show();
						}
					}
				});
				counter = 0;
			}
		else {
				$('#contact-message').html(message);	
				$('#contact-message').show();
		}	
	
	}
	
	function validate()
	{
		$('.contact-message').html('');	
		$('.contact-message').hide();

		message = '';
		if(getDivId() == '1')
		{
			var email = $('.contact-username').val();
			if (!email) {
				message += 'Email is required. ';
			}
	
			else if (!$('.contact-password').val()) {
				message += 'Password is required. ';
			}
			else if ($('.contact-password').val().length < 6) {
				message += 'Password must be atleast 6 characters long. ';
			}
			
			else if (!$('.contact-confpassword').val()) {
				message += 'Confirm Password is required. ';
			}
			else if($('#contact-confpassword').val() != $('#contact-password').val()) {
				message += 'Confirm Password doesn\'t match. ';
			}
		}
		else if(getDivId() == '2')
		{
			if (!$('#contact-firstname').val()) {
				message += 'First name is required. ';
			}
			else if (!$('#contact-lastname').val()) {
				message += 'Last name is required.';
			}
			else if (!$('#contact-prefix').val()) {
				message += 'Prefix is required.';
			}
			else if (!$('#contact-busemail').val()) {
				message += 'Business email is required. ';
			}
			
			else if (!validateEmail($('#contact-busemail').val())) {
				message += 'Business email is invalid. ';
			}
			
			else if (!$('#contact-emergencyname').val()) {
				message += 'Emergency name is required.';
			}
			else if (!$('#contact-emergencyphone').val()) {
				message += 'Emergency phone is required.';
			}
			else if (!isInteger($('#contact-emergencyphone').val()))
			{
				message += 'Emergency phone must be valid.';	
			}
			
	
		}
		else if(getDivId() == '3')
		{
			if (!$('#contact-contactdesignation').val()) {
				message += 'Designation is required. ';
			}
			else if (!$('#contact-companyname').val()) {
				message += 'Company/organization name is required.';
			}
			else if (!$('#contact-companyaddress').val()) {
				message += 'Address is required.';
			}
			else if (!$('#contact-city').val()) {
				message += 'City is required.';
			}
			else if (!$('#contact-country').val()) {
				message += 'Country is required.';
			}
			else if (!$('#contact-ctelephone').val()) {
				message += 'Telephone is required.';
			}
			else if (!isInteger($('#contact-ctelephone').val()))
			{
				message += 'Telephone must be valid.';	
			}
			else if ($('#contact-cell').val()) {
				if (!isInteger($('#contact-cell').val()))
				{
					message += 'Cell number must be valid.';	
				}
			}
			else if ($('#contact-fax').val()) {
				if (!isInteger($('#contact-fax').val()))
				{
					message += 'Fax number must be valid.';	
				}
			}
			
			
	
		}
		else if(getDivId() == '4')
		{
			
			if ($('#contact-parentnumemployees').val()) {
				if(!isInteger($('#contact-parentnumemployees').val()))
				{
					message += 'Number of employees must be an integer. ';
				}
			}

			else if (!$('#contact-services').val()) {
				message += 'Product/Services is required. ';
			}
			else if (!$('#contact-numemployees').val()) {
				message += 'Number of employees is required.';
			}
			else if(!isInteger($('#contact-numemployees').val()))
			{
				message += 'Number of employees must be an integer. ';
			}
			
			else if (!$('#contact-numemployeessupervision').val()) {
				message += 'Number of employees supervision is required.';
			}
			else if(!isInteger($('#contact-numemployeessupervision').val()))
			{
				message += 'Number of employees supervision must be an integer. ';
			}
			
			else if (!$('#contact-reportperson').val()) {
				message += 'Report person is required.';
			}
			else if (!$('#contact-industry').val()) {
				if(!$('#contact-industryother').val())
				{
					message += 'Specify other industry is required.';
				}
			}
			else if (!$('#contact-position').val()) {
				if(!$('#contact-positionother').val())
				{
					message += 'Specify other position is required.';
				}
			}


		}
		else if(getDivId() == '5')
		{
			
			if (!$('#contact-company1').val()) {
				message += 'Name of company is required. ';
			}
			else if (!$('#contact-position1').val()) {
				message += 'Title/Position is required.';
			}
			else if (!$('#contact-from1').val()) {
				message += 'Start date is required.';
			}
			else if (!$('#contact-to1').val()) {
				message += 'End date is required.';
			}
			else if (!$('#contact-numyearsexp').val()) {
				message += 'Total years experience is required.';
			}
			else if(!isInteger($('#contact-numyearsexp').val()))
			{
				message += 'Total years experience must be valid.';	
			}
			else if (!$('#contact-responsibility').val()) {
				message += 'Current responsibilities is required.';
			}
			else if (!$('#contact-university').val()) {
				message += 'University is required.';
			}
			else if (!$('#contact-year').val()) {
				message += 'Year is required.';
			}
			else if (!$('#contact-degree').val()) {
				message += 'Degree(Highest level attended) is required.';
			}


		}
		else if(getDivId() == '6')
		{
			
			if (!$('#contact-name').val()) {
				message += 'Name is required. ';
			}
			else if (!$('#contact-designation').val()) {
				message += 'Designation is required.';
			}
			else if (!$('#contact-address').val()) {
				message += 'Address is required.';
			}
			else if (!$('#contact-telephone').val()) {
				message += 'Telephone is required.';
			}
			
			else if(!isInteger($('#contact-telephone').val()))
			{
				message += 'Telephone must be valid.';	
			}
			else if (!$('#contact-email').val()) {
				message += 'Email is required.';
			}
			else if (!validateEmail($('#contact-email').val())) {
				message += 'Email is invalid. ';
			}
			
			else if ($('#contact-invoicetelephone').val()) {
				if(!isInteger($('#contact-invoicetelephone').val()))
				{
					message += 'Telephone must be valid.';	
				}
			}

			else if ($('#contact-invoiceemail').val()) {
				if(!validateEmail($('#contact-invoiceemail').val()))
				{
					message += 'Email must be valid.';	
				}
			}

			else if ($('#contact-executivetelephone').val()) {
				if(!isInteger($('#contact-executivetelephone').val()))
				{
					message += 'Telephone must be valid.';	
				}
			}
		
			else if ($('#contact-executiveemail').val()) {
				if(!validateEmail($('#contact-executiveemail').val()))
				{
					message += 'Email must be valid.';	
				}
			}

		}
		else if(getDivId() == '7')
		{
			
			if (!$('#contact-oepprogrammes').val()) {
				message += 'OEP Programme is required. ';
			}

		}
		
		if (message.length > 0) {

				//alert(message);
				return false;
		}
		else {
				return true;
		}
		
	
	}
	
	function validateLogin()
	{
		
		message = '';
		var email = $('#contact-loginusername').val();
		if (!email) {
			message += 'Email is required. ';
		}
		else if (!contact.validateEmail(email)) {
			message += 'Email is invalid. ';
		}

		else if (!$('#contact-loginpassword').val()) {
			message += 'Password is required. ';
		}
		else if ($('#contact-loginpassword').val().length < 6) {
			message += 'Password must be atleast 6 characters long. ';
		}
		
		if (message.length > 0) {

				//alert(message);
				return false;
		}
		else {
				return true;
		}
	
	}

	function validateEmail(email)
	{
		
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

	
	function defaultDiv()
	{
		if($('#contact-ifregistered').val() > 0)
		{
			toggleFunc(1);	
		}
		else
		{
			toggleFunc(0);		
		}
	}
	
	function getDivId()
	{
		var divid = document.getElementById('contact-divname').value;	
		return divid;
	}
	
	function setDivId(val)
	{
		//alert('BEFORE SET-> '+val);
		document.getElementById('contact-divname').value = parseInt(val)+1;
		//alert('AFTER SET-> '+document.getElementById('contact-divname').value);
	}
	
	function toggleFunc(divid)
	{
		setDivId(divid);	
		hideLoginDiv();
		//alert(getDivId());
		if(getDivId() == 8){
			$.ajax({
					url: 'pages/applynowoep.php',
					data: $('form').serialize() + '&action=create&divnum='+getDivId(),
					type: 'post',
					cache: false,
					dataType: 'html',
					complete: function (xhr) {
						var txt = xhr.responseText;
						$('#contact-title1').html('Success!');
						$('#contact-message1').html(txt);
						
					}
				});
		}
		
		for(var i=1; i<=8; i++)
		{			
			if(getDivId() == i)
			{
				var msg = $('#contact-message');
				msg.hide();
				msg.removeClass('contact-error').empty();
				document.getElementById("s"+i).style.display = 'block';
			}
			else
			{
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
		//alert('BEFORE SET-> '+document.getElementById('contact-divname').value);
		document.getElementById('contact-divname').value = parseInt(document.getElementById('contact-divname').value)-1;		
		//alert('AFTER SET-> '+document.getElementById('contact-divname').value);
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
				var msg = $('#contact-message');
				msg.hide();
				msg.removeClass('contact-error').empty();
				document.getElementById("s"+i).style.display = 'block';
				$('.contact-loading').hide();
				$('#contact-title').html('Create Account');
			
			}
			else
			{
				document.getElementById("s"+i).style.display = 'none';
			}
		}
		hideLoginDiv();
	}
	
	
	function showLoginDiv()
	{
		$('#contact-message').html('');	
		$('#contact-message').hide();
		$('#login').show();
		$('.contact-loading').hide();
		//$('#contact-title').html('Login Form');
		$('.contact-content').hide();
	}
	
	function hideLoginDiv()
	{
		document.getElementById("login").style.display = 'none';
	}