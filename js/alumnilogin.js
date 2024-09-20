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


var str = "<div style='width:100%; height:100%; vertical-align:text-top; margin-left:50%; margin-top:10%;' align='center'><img src='images/big.gif' border='0' /> Loading...</div>";

function showAlumniLogin()
{
			//abc = $.modal("<div style='width:100%; height:100%; vertical-align:text-top;' align='center'><img src='images/applyonline/loader.gif' border='0' />Loading...</div>");
			abc = $(str).modal({
					position: ["10%","30%","5%","50%"]
				});
			// load the apply form using ajax
			$.get("pages/alumnilogin.php", function(data){
													//alert(data);
				abc.close();
				// create a modal dialog with the data
				$(data).modal({
					//closeHTML: "<a href='#' title='Close' class='modalCloseX simplemodal-close'>x</a>",
					position: ["2%","10%","5%","10%"],
					overlayId: 'alumni-overlay',
					containerId: 'alumni-container',
					onOpen: alumni.open,
					onShow: alumni.show,
					onClose: alumni.close
				});
			});
		
		
}

	$(document).ready(function () {

		$('a.alumnilogin, .alumnilogin').click(function (e) {
										   
			e.preventDefault();
			//abc = $.modal("<div style='width:100%; height:100%; vertical-align:text-top;' align='center'><img src='images/applyonline/loader.gif' border='0' />Loading...</div>");
			abc = $(str).modal({
					position: ["10%","30%","5%","50%"]
				});
			// load the apply form using ajax
			$.get("pages/alumnilogin.php", function(data){
													//alert(data);
				abc.close();
				// create a modal dialog with the data
				$(data).modal({
					//closeHTML: "<a href='#' title='Close' class='modalCloseX simplemodal-close'>x</a>",
					position: ["2%","10%","5%","10%"],
					overlayId: 'alumni-overlay',
					containerId: 'alumni-container',
					onOpen: alumni.open,
					onShow: alumni.show,
					onClose: alumni.close
				});
			});
		
	});
	
	// preload images
		var img = ['cancel.png', 'form_bottom.gif', 'form_top.gif', 'loading.gif', 'send.png'];
		$(img).each(function () {
			var i = new Image();
			i.src = 'images/applyonline/' + this;
		});
	});

	
	
	


var alumni = {
	message: null,
	open: function (dialog) {
		
		// add padding to the buttons in firefox/mozilla
		if ($.browser.mozilla) {
			$('#alumni-container .alumni-button').css({
				'padding-bottom': '2px'
			});
		}
		// input field font size
		if ($.browser.safari) {
			$('#alumni-container .alumni-input').css({
				'font-size': '.9em'
			});
		}
		
	
		//var title = $('#apply-container .apply-title').html();
		//$('#apply-container .apply-title').html('Loading...');
		dialog.overlay.fadeIn(200, function () {
			dialog.container.slideDown(500, function () {
				$('#alumni-container form').show();									  
				dialog.data.slideDown(500, function () {
					$('#alumni-container .alumni-content').animate({
						height: 200
					}, function () {
						//$('#apply-container .apply-title').html(title);
						//$('#apply-container form').fadeIn(200, function () {
							//$('#apply-username').focus();
							// fix png's for IE 6
							if ($.browser.msie && $.browser.version < 7) {
								$('#alumni-container .alumni-button').each(function () {
									if ($(this).css('backgroundImage').match(/^url[("']+(.*\.png)[)"']+$/i)) {
										var src = RegExp.$1;
										$(this).css({
											backgroundImage: 'none',
											filter: 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' +  src + '", sizingMethod="crop")'
										});
									}
								});
							}
						//});
					});
				});
			});
		});
	},
	show: function (dialog) {
		$('#alumni-container .alumni-checklogin').click(function (e) {
			e.preventDefault();
			// validate form
			//$('#apply-container .apply-message').html('');
			if (alumni.validateLogin()) {
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
							url: 'pages/alumnilogin.php',
							data: $('#alumni-container form').serialize() + '&action=checklogin',
							type: 'post',
							cache: false,
							dataType: 'html',
							complete: function (abc) {
							var	res = abc.responseText;
								$('#alumni-container .alumni-loading').fadeOut(200, function () {
									//$('#apply-container .apply-title').html('Thank you!');
									//$('#apply-container .apply-message').html(msg).fadeIn(200);
									//alert(res);
									if(res == 1){										
										
										if(counter == 0){
											window.location.href = "alumni.php?section_id=0&pcid=518";
											//toggleFunc($('#apply-container #apply-divname').val());
											counter++;
										}	
										
									}
									else
									{
										$('#alumni-container .alumni-title').html("Login:");
										//$('#apply-container .apply-loading').hide();
										//$('#apply-container .apply-message').html("Invalid Email / Password.").fadeIn(200);	
										$('#alumni-container .alumni-message').show();
										$('#alumni-container .alumni-message').html($('<div class="alumni-error">').append("Invalid Email / Password.")).fadeIn(200);
										//$('#apply-container .apply-message1').fadeOut(500);
										//document.getElementById("s1").style.display = 'block';
										//$('#apply-container .apply-message').html("Email (user name) already taken.").fadeIn(200);	
									}
									//document.getElementById('apply-message').innerHTML = xhr.responseText;
								});
							},
							error: alumni.error
						});
						counter = 0;
					/*});*/
				/*});*/
			}
			else {
				
				if ($('#alumni-container .alumni-message:visible').length > 0) {
					//var msg = $('#apply-container .apply-message div');
					var msg = $('#alumni-container .alumni-message');
					//msg.fadeOut(200, function () {
						msg.empty();
						alumni.showError();
						//msg.fadeIn(200);
					//});
				}
				else {
					$('#alumni-container .alumni-message').animate({
						height: '30px'
					}, alumni.showError);
					alumni.showError();
				}
				
			}
		});
		
	},
	close: function (dialog) {

		$('#alumni-container .alumni-message').fadeOut();
		//$('#apply-container form').slideUp(500);
		$('#alumni-container .alumni-content').animate({
			height: 40
		}, function () {
			$('#alumni-container form').hide();
			dialog.data.slideUp(500, function () {
				dialog.container.slideUp(500, function () {
					dialog.overlay.fadeOut(200, function () {
						$.modal.close();
					});
				});
			});
		});
	
	},
	error: function (xhr) {
//		alert(xhr.statusText);
	},
	validateLogin: function () {
		alumni.message = '';
		var email = $('#alumni-container #alumni-loginusername').val();
		if (!email) {
			alumni.message += 'Email is required. ';
		}
		else if (!alumni.validateEmail(email)) {
			alumni.message += 'Email is invalid. ';
		}

		else if (!$('#alumni-container #alumni-loginpassword').val()) {
			alumni.message += 'Password is required. ';
		}
		else if ($('#alumni-container #alumni-loginpassword').val().length < 6) {
			alumni.message += 'Password must be atleast 6 characters long. ';
		}
		
		if (alumni.message.length > 0) {

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
		$('#alumni-container .alumni-message').html($('<div class="alumni-error">').append(alumni.message)).fadeIn(200);
	}
};
