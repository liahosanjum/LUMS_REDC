/*
 * SimpleModal ebroucherrequest Form
 * http://www.ericmmartin.com/projects/simplemodal/
 * http://code.google.com/p/simplemodal/
 *
 * Copyright (c) 2009 Eric Martin - http://ericmmartin.com
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Revision: $Id: ebroucherrequest.js 204 2009-06-09 22:43:28Z emartin24 $
 *
 */
 
  var str = "<div style='width:100%; height:100%; vertical-align:text-top; margin-left:50%; margin-top:10%;' align='center'><img src='images/big.gif' border='0' /> Loading...</div>";
  
$(document).ready(function () {
																																																																									
	$('a.ebroucherrequest, #ebroucherrequestForm input.ebroucherrequest, #ebroucherrequestForm a.ebroucherrequest').click(function (e) {

		e.preventDefault();
		abc = $(str).modal({
					position: ["10%","30%","5%","50%"]
				});
		// load the ebroucherrequest form using ajax
		$.get("pages/ebroucherrequests.php", function(data){
		  abc.close();
			// create a modal dialog with the data
			//alert(data);
			$(data).modal({
//				closeHTML: "<a href='#' title='Close' class='modalCloseX simplemodal-close'>x</a>",
				position: ["2%","10%","5%","10%"],
				overlayId: 'ebroucherrequest-overlay',
				containerId: 'ebroucherrequest-container',
				onOpen: ebroucherrequest.open,
				onShow: ebroucherrequest.show,
				onClose: ebroucherrequest.close
			});
		});
	});

	// preload images
	var img = ['cancel.png', 'form_bottom.gif', 'form_top.gif', 'loading.gif', 'send.png'];
	$(img).each(function () {
		var i = new Image();
		i.src = 'images/ebroucherrequest/' + this;
	});
});

var ebroucherrequest = {
	message: null,
	open: function (dialog) {
		// add padding to the buttons in firefox/mozilla
		if ($.browser.mozilla) {
			$('#ebroucherrequest-container .ebroucherrequest-button').css({
				'padding-bottom': '2px'
			});
		}
		// input field font size
		if ($.browser.safari) {
			$('#ebroucherrequest-container .ebroucherrequest-input').css({
				'font-size': '.9em'
			});
		}

		// dynamically determine height
		var h = 520;
		var w = 300;
		if ($('#ebroucherrequest-subject').length) {
			h += 26;
		}
		if ($('#ebroucherrequest-cc').length) {
			h += 22;
		}

		var title = $('#ebroucherrequest-container .ebroucherrequest-title').html();
		//$('#ebroucherrequest-container .ebroucherrequest-title').html('Loading...');
		dialog.overlay.fadeIn(200, function () {
			dialog.container.slideDown(500, function () {
				dialog.data.slideDown(500, function () {
					$('#ebroucherrequest-container .ebroucherrequest-content').animate({
						height: h
					}, function () {
						$('.ebroucherrequest-button').show();
						$('.ebroucherrequest-content2').show();
						$('#ebroucherrequest-container .ebroucherrequest-title').html(title);
						$('#ebroucherrequest-container form').fadeIn(200, function () {
							$('#ebroucherrequest-container #ebroucherrequest-firstname').focus();

							$('#ebroucherrequest-container .ebroucherrequest-cc').click(function () {
								var cc = $('#ebroucherrequest-container #ebroucherrequest-cc');
								cc.is(':checked') ? cc.attr('checked', '') : cc.attr('checked', 'checked');
							});

							// fix png's for IE 6
							if ($.browser.msie && $.browser.version < 7) {
								$('#ebroucherrequest-container .ebroucherrequest-button').each(function () {
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
		$('#ebroucherrequest-container .ebroucherrequest-send').click(function (e) {
			e.preventDefault();
			// validate form
			if (ebroucherrequest.validate()) {
				$('#ebroucherrequest-container .ebroucherrequest-message').fadeOut(function () {
					$('#ebroucherrequest-container .ebroucherrequest-message').removeClass('ebroucherrequest-error').empty();
				});
				$('#ebroucherrequest-container .ebroucherrequest-title').html('Sending...');
				$('#ebroucherrequest-container form').fadeOut(200);
				$('#ebroucherrequest-content2').hide();
				$('.ebroucherrequest-info').hide();
				$('#button').hide();
				$('#ebroucherrequest-container .ebroucherrequest-content').animate({
					height: '520px'
				}, function () {
					$('#ebroucherrequest-container .ebroucherrequest-loading').fadeIn(200, function () {
						$.ajax({
							url: 'pages/ebroucherrequests.php',
							data: $('#ebroucherrequest-container form').serialize() + '&action=send',
							type: 'post',
							cache: false,
							dataType: 'html',
							complete: function (xhr) {
								var msg = xhr.responseText;
								$('#ebroucherrequest-container .ebroucherrequest-loading').fadeOut(200, function () {
									$('#ebroucherrequest-container .ebroucherrequest-title').html('Thank you');
									$('#ebroucherrequest-container .ebroucherrequest-message').html(msg).fadeIn(200);
									$('#ebroucherrequest-container .ebroucherrequest-content').css('height','520px');
									$('#ebroucherrequest-container .ebroucherrequest-message').show();
									$('#ebroucherrequest-content2').hide();
									$('#button').hide();
									
								});
							},
							error: ebroucherrequest.error
						});
					});
				});
			}
			else {
				if ($('#ebroucherrequest-container .ebroucherrequest-message:visible').length > 0) {
					
					var msg = $('#ebroucherrequest-container .ebroucherrequest-message div');
					msg.fadeOut(200, function () {
						msg.empty();
						ebroucherrequest.showError();
						msg.fadeIn(200);
					});
				}
				else {
					$('#ebroucherrequest-container .ebroucherrequest-message').animate({
						height: '30px'
					}, ebroucherrequest.showError);
				}
				
			}
		});
	},
	close: function (dialog) {
		$('#ebroucherrequest-container .ebroucherrequest-message').fadeOut();
		//$('#ebroucherrequest-container .ebroucherrequest-title').html('Goodbye...');
		$('#ebroucherrequest-container form').fadeOut(200);
		$('#ebroucherrequest-content2').hide();
		$('#button').hide();
		$('#ebroucherrequest-container .ebroucherrequest-content').animate({
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
		ebroucherrequest.message = '';
		if (!$('#ebroucherrequest-container #ebroucherrequest-firstname').val()) {
			ebroucherrequest.message += 'First Name is required. ';
			return false;
		}
		
		if (!$('#ebroucherrequest-container #ebroucherrequest-lastname').val()) {
			ebroucherrequest.message += 'Last Name is required. ';
			return false;			
		}
		if (!$('#ebroucherrequest-container #ebroucherrequest-address').val()) {
			ebroucherrequest.message += 'Address is required. ';
			return false;			
		}
		if (!$('#ebroucherrequest-container #ebroucherrequest-city').val()) {
			ebroucherrequest.message += 'City is required. ';
			return false;			
		}
		var postalcode = $('#ebroucherrequest-container #ebroucherrequest-postalcode').val();
		if (!postalcode) {
			ebroucherrequest.message += 'Postal Code is required. ';
			return false;			
		}
		else {
			if (!ebroucherrequest.validateNo(postalcode)) {
				ebroucherrequest.message += 'Postal Code is invalid. ';
				return false;				
			}
		}
		var phone = $('#ebroucherrequest-container #ebroucherrequest-telephone').val();
		if (!$('#ebroucherrequest-container #ebroucherrequest-telephone').val()) {
			ebroucherrequest.message += 'Telephone is required. ';
			return false;			
		}
		else {
			if (!ebroucherrequest.validateNo(phone)) {
				ebroucherrequest.message += 'Telephone is invalid. ';
				return false;				
			}
		}
		var fax = $('#ebroucherrequest-container #ebroucherrequest-fax').val();
		if(fax){
		if (!ebroucherrequest.validateNo(fax)) {
				ebroucherrequest.message += 'Fax is invalid. ';
				return false;				
			}
		}
		var email = $('#ebroucherrequest-container #ebroucherrequest-email').val();
		if (!email) {
			ebroucherrequest.message += 'Email is required. ';
			return false;			
		}
		else {
			if (!ebroucherrequest.validateEmail(email)) {
				ebroucherrequest.message += 'Email is invalid. ';
				return false;				
			}
		}
		if (ebroucherrequest.message.length > 0) {
			return false;
		}
		else {
			return true;
		}
	},

	validateNo: function (no) {
		if (!/^[0-9]*$/.test(no)){
				return false;
		}
		return true;
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
		$('#ebroucherrequest-container .ebroucherrequest-message')
			.html($('<div class="ebroucherrequest-error">').append(ebroucherrequest.message))
			.fadeIn(200);
	}
	
	
};
