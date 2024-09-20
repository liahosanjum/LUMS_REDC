/*
 * SimpleModal ofp Form
 * http://www.ericmmartin.com/projects/simplemodal/
 * http://code.google.com/p/simplemodal/
 *
 * Copyright (c) 2009 Eric Martin - http://ericmmartin.com
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Revision: $Id: ofp.js 204 2009-06-09 22:43:28Z emartin24 $
 *
 */
 
 var str = "<div style='width:100%; height:100%; vertical-align:text-top; margin-left:50%; margin-top:10%; ' align='center'><img src='images/big.gif' border='0' /> Loading...</div>";
 
$(document).ready(function () {
							
	$('#ofpForm input.ofp, #ofpForm a.ofp').click(function (e) {
		e.preventDefault();
		abc = $(str).modal({
					position: ["10%","30%","5%","50%"]
				});
		// load the ofp form using ajax
		$.get("pages/ofprequests.php", function(data){
			// create a modal dialog with the data
			abc.close();
			//alert(data);
			$(data).modal({
				//closeHTML: "<a href='#' title='Close' class='modalCloseX simplemodal-close'>x</a>",
				position: ["2%","10%","5%","10%"],
				overlayId: 'ofp-overlay',
				containerId: 'ofp-container',
				onOpen: ofp.open,
				onShow: ofp.show,
				onClose: ofp.close
			});
		});
	});

	// preload images
	var img = ['cancel.png', 'form_bottom.gif', 'form_top.gif', 'loading.gif', 'send.png'];
	$(img).each(function () {
		var i = new Image();
		i.src = 'images/ofp/' + this;
	});
});

var ofp = {
	message: null,
	open: function (dialog) {
		// add padding to the buttons in firefox/mozilla
		if ($.browser.mozilla) {
			$('#ofp-container .ofp-button').css({
				'padding-bottom': '2px'
			});
		}
		// input field font size
		if ($.browser.safari) {
			$('#ofp-container .ofp-input').css({
				'font-size': '.9em'
			});
		}

		// dynamically determine height
		var h = 480;
		
		if ($('#ofp-subject').length) {
			h += 26;
		}
		if ($('#ofp-cc').length) {
			h += 22;
		}

		var title = $('#ofp-container .ofp-title').html();
		//$('#ofp-container .ofp-title').html('Loading...');
		dialog.overlay.fadeIn(200, function () {
			dialog.container.slideDown(500, function () {
				dialog.data.slideDown(500, function () {
					$('#ofp-container .ofp-content').animate({
						height: h
					}, function () {
						$('.ofp-button').show();
						$('.ofp-content2').show();
						$('#ofp-container .ofp-title').html(title);
						$('#ofp-container form').fadeIn(200, function () {
							$('#ofp-container #ofp-firstname').focus();

							$('#ofp-container .ofp-cc').click(function () {
								var cc = $('#ofp-container #ofp-cc');
								cc.is(':checked') ? cc.attr('checked', '') : cc.attr('checked', 'checked');
							});

							// fix png's for IE 6
							if ($.browser.msie && $.browser.version < 7) {
								$('#ofp-container .ofp-button').each(function () {
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
		$('#ofp-container .ofp-send').click(function (e) {
			e.preventDefault();
			// validate form
			if (ofp.validate()) {
				$('#ofp-container .ofp-message').fadeOut(function () {
					$('#ofp-container .ofp-message').removeClass('ofp-error').empty();
				});
				$('#ofp-container .ofp-title').html('Sending...');
				$('#ofp-container form').fadeOut(200);
				$('#msg').hide();
				$('#ofp-content2').hide();
				$('.ofp-info').hide();
				$('#button').hide();
				$('#ofp-container .ofp-content').animate({
					height: '520px'
				}, function () {
					$('#ofp-container .ofp-loading').fadeIn(200, function () {
						$.ajax({
							url: 'pages/ofprequests.php',
							data: $('#ofp-container form').serialize() + '&action=send',
							type: 'post',
							cache: false,
							dataType: 'html',
							complete: function (xhr) {
								
								var msg = xhr.responseText;
								$('#ofp-container .ofp-loading').fadeOut(200, function () {
									$('#ofp-container .ofp-title').html('Thank You');
									$('#ofp-container .ofp-message').html(msg).fadeIn(200);
									$('#ofp-container .ofp-content').css('height', '520px');
									$('#ofp-container .ofp-message').show();
									$('#msg').hide();
									$('#ofp-content2').hide();
									$('#button').hide();
									
								});
							},
							error: ofp.error
						});
					});
				});
			}
			else {
				if ($('#ofp-container .ofp-message:visible').length > 0) {
					
					var msg = $('#ofp-container .ofp-message div');
					msg.fadeOut(200, function () {
						msg.empty();
						ofp.showError();
						msg.fadeIn(200);
					});
				}
				else {
					$('#ofp-container .ofp-message').animate({
						height: '30px'
					}, ofp.showError);
				}
				
			}
		});
	},
	close: function (dialog) {
		$('#ofp-container .ofp-message').fadeOut();
		//$('#ofp-container .ofp-title').html('Goodbye...');
		$('#ofp-container form').fadeOut(200);
		$('#ofp-content2').hide();
		$('#msg').hide();
		$('#button').hide();
		$('#ofp-container .ofp-content').animate({
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
		ofp.message = '';
		if (!$('#ofp-container #ofp-firstname').val()) {
			ofp.message += 'First Name is required. ';
			return false;
		}
		
		if (!$('#ofp-container #ofp-lastname').val()) {
			ofp.message += 'Last Name is required. ';
			return false;			
		}
		if (!$('#ofp-container #ofp-organisation').val()) {
			ofp.message += 'Organization Name is required. ';
			return false;			
		}
		var phone = $('#ofp-container #ofp-phone').val();
		if (!$('#ofp-container #ofp-phone').val()) {
			ofp.message += 'Phone is required. ';
			return false;			
		}
		else {
			if (!ofp.validateNo(phone)) {
				ofp.message += 'Phone is invalid. ';
				return false;				
			}
		}
		var fax = $('#ofp-container #ofp-fax').val();
		if(fax){
		if (!ofp.validateNo(fax)) {
				ofp.message += 'Fax is invalid. ';
				return false;				
			}
		}
		var email = $('#ofp-container #ofp-email').val();
		if (!email) {
			ofp.message += 'Email is required. ';
			return false;			
		}
		else {
			if (!ofp.validateEmail(email)) {
				ofp.message += 'Email is invalid. ';
				return false;				
			}
		}
		if (ofp.message.length > 0) {
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
		$('#ofp-container .ofp-message')
			.html($('<div class="ofp-error">').append(ofp.message))
			.fadeIn(200);
	}
	
	
};
