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
 /* To get max length in a textarea*/
 
 var strLoading = "<div style='width:100%; height:100%; margin-left:50%; margin-top:10%; vertical-align:text-top; ' align='center'><img src='images/big.gif' border='0' /> Loading...</div>";
 
 function ismaxlength(obj)
   	{
		var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : ""
		if (obj.getAttribute && obj.value.length>mlength)
		obj.value=obj.value.substring(0,mlength)
	}

$(document).ready(function () {							
	$('a.contact, a.contactbar').click(function (e) {

		e.preventDefault();

		abc = $(strLoading).modal({
					position: ["10%","30%","5%","50%"]
				});
		
		// load the contact form using ajax
		$.get("pages/contact.php", function(data){
			abc.close();
			// create a modal dialog with the data
			$(data).modal({
				//closeHTML: "<a href='#' title='Close' class='modalCloseX simplemodal-close'>x</a>",
				position: ["2%","10%","5%","10%"],
				overlayId: 'contact-overlay',
				containerId: 'contact-container',
				onOpen: contact.open,
				onShow: contact.show,
				onClose: contact.close
			});
		});
	});

	// preload images
	var img = ['cancel.png', 'form_bottom.gif', 'form_top.gif', 'loading.gif', 'send.png'];
	$(img).each(function () {
		var i = new Image();
		i.src = 'images/contact/' + this;
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
		var h = 520;
		if ($('#contact-subject').length) {
			h += 26;
		}
		if ($('#contact-cc').length) {
			h += 22;
		}

		var title = $('#contact-container .contact-title').html();
		//$('#contact-container .contact-title').html('Loading...');
		dialog.overlay.fadeIn(200, function () {
			dialog.container.slideDown(500, function () {
				dialog.data.slideDown(500, function () {
					$('#contact-container .contact-content').animate({
						height: h
					}, function () {
						$('.contact-button').show();
						$('.contact-content2').show();
						$('#contact-container .contact-title').html(title);
						$('#contact-container form').fadeIn(500, function () {
							$('#contact-container #contact-firstname').focus();

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
				$('#contact-container .contact-title').html('Sending...');
				$('#contact-container form').fadeOut(200);
				$('#contact-content2').hide();
				$('#contact-container .contact-info').hide();
				$('#button').hide();
				$('#contact-container .contact-content').animate({
					height: '520px'
				}, function () {
					$('#contact-container .contact-loading').fadeIn(200, function () {
						$.ajax({
							url: 'pages/contact.php',
							data: $('#contact-container form').serialize() + '&action=send',
							type: 'post',
							cache: false,
							dataType: 'html',
							complete: function (xhr) {
									var msg = xhr.responseText;	
								$('#contact-container .contact-loading').fadeOut(200, function () {
									$('#contact-container .contact-title').html('Thank You');
									$('#contact-container .contact-message').html(msg).fadeIn(200);
									$('#contact-container .contact-content').css('height','520px');
									
									$('#contact-container .contact-message').show();
									$('#contact-content2').hide();
									$('#button').hide();
								});
							},
							error: contact.error
						});
					});
				});
			}
			else {
				if ($('#contact-container .contact-message:visible').length > 0) {
					var msg = $('#contact-container .contact-message div');
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
		//$('#contact-container .contact-title').html('Goodbye...');
		$('#contact-container form').fadeOut(200);
		$('#contact-content2').hide();
		$('#button').hide();
		$('#contact-container .contact-content').animate({
			height: 520
		}, function () {
			dialog.data.slideUp('slow', function () {
				dialog.container.slideUp('slow', function () {
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
		if (!$('#contact-container #contact-firstname').val()) {
			contact.message += 'First Name is required. ';
			return false;
		}
		
		if (!$('#contact-container #contact-lastname').val()) {
			contact.message += 'Last Name is required. ';
			return false;			
		}

		var email = $('#contact-container #contact-email').val();
		if (!email) {
			contact.message += 'Email is required. ';
			return false;			
		}
		else {
			if (!contact.validateEmail(email)) {
				contact.message += 'Email is invalid. ';
				return false;				
			}
		}

		if (!$('#contact-container #contact-company').val()) {
			contact.message += 'Company is required.';
			return false;			
		}
		
		if (!$('#contact-container #contact-mailingaddress').val()) {
			contact.message += 'Mailing Address is required.';
			return false;			
		}
		
		if (!$('#contact-container #contact-telephone').val()) {
			contact.message += 'Telephone is required.';
			return false;			
		}
		
		var n = $("input:checked").length;
		if (n <= 0) {
			contact.message += 'Atleast one checkbox should be checked for Request Information.';
			return false;			
		}
		
		
		if (contact.message.length > 0) {
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
		$('#contact-container .contact-message')
			.html($('<div class="contact-error">').append(contact.message))
			.fadeIn(200);
	}
};

