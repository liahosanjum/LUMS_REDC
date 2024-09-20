/*
 * SimpleModal broucherrequest Form
 * http://www.ericmmartin.com/projects/simplemodal/
 * http://code.google.com/p/simplemodal/
 *
 * Copyright (c) 2009 Eric Martin - http://ericmmartin.com
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Revision: $Id: broucherrequest.js 204 2009-06-09 22:43:28Z emartin24 $
 *
 */
  var str = "<div style='width:100%; height:100%; vertical-align:text-top; margin-left:50%; margin-top:10%;' align='center'><img src='images/big.gif' border='0' /> Loading...</div>";
  
$(document).ready(function () {
							
	$('#broucherrequestForm input.broucherrequest, #broucherrequestForm a.broucherrequest').click(function (e) {
		e.preventDefault();
		abc = $(str).modal({
					position: ["10%","30%","5%","50%"]
				});
		// load the broucherrequest form using ajax
		$.get("pages/broucherrequest.php", function(data){
			// create a modal dialog with the data
			abc.close();
			//alert(data);
			$(data).modal({
				//closeHTML: "<a href='#' title='Close' class='modalCloseX simplemodal-close'>x</a>",
				position: ["2%","10%","5%","10%"],
				overlayId: 'broucherrequest-overlay',
				containerId: 'broucherrequest-container',
				onOpen: broucherrequest.open,
				onShow: broucherrequest.show,
				onClose: broucherrequest.close
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

var broucherrequest = {
	message: null,
	open: function (dialog) {
		// add padding to the buttons in firefox/mozilla
		if ($.browser.mozilla) {
			$('#broucherrequest-container .broucherrequest-button').css({
				'padding-bottom': '2px'
			});
		}
		// input field font size
		if ($.browser.safari) {
			$('#broucherrequest-container .broucherrequest-input').css({
				'font-size': '.9em'
			});
		}

		// dynamically determine height
		var h = 250;
		
		if ($('#broucherrequest-subject').length) {
			h += 26;
		}
		if ($('#broucherrequest-cc').length) {
			h += 22;
		}

		var title = $('#broucherrequest-container .broucherrequest-title').html();
		//$('#broucherrequest-container .broucherrequest-title').html('Loading...');
		dialog.overlay.fadeIn(200, function () {
			dialog.container.slideDown(500, function () {
				dialog.data.slideDown(500, function () {
					$('#broucherrequest-container .broucherrequest-content').animate({
						height: h
					}, function () {
						$('.broucherrequest-button').show();
						$('#broucherrequest-container .broucherrequest-title').html(title);
						$('#broucherrequest-container form').fadeIn(200, function () {
							$('#broucherrequest-container #broucherrequest-name').focus();

							$('#broucherrequest-container .broucherrequest-cc').click(function () {
								var cc = $('#broucherrequest-container #broucherrequest-cc');
								cc.is(':checked') ? cc.attr('checked', '') : cc.attr('checked', 'checked');
							});

							// fix png's for IE 6
							if ($.browser.msie && $.browser.version < 7) {
								$('#broucherrequest-container .broucherrequest-button').each(function () {
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
		$('#broucherrequest-container .broucherrequest-send').click(function (e) {
			e.preventDefault();
			// validate form
			if (broucherrequest.validate()) {
				$('#broucherrequest-container .broucherrequest-message').fadeOut(function () {
					$('#broucherrequest-container .broucherrequest-message').removeClass('broucherrequest-error').empty();
				});
				$('#broucherrequest-container .broucherrequest-title').html('Sending...');
				$('#broucherrequest-container form').fadeOut(200);
				$('#broucherrequest-content2').hide();
				$('#button').hide();
				$('#broucherrequest-container .broucherrequest-content').animate({
					height: '250px'
				}, function () {
					$('#broucherrequest-container .broucherrequest-loading').fadeIn(200, function () {
						$.ajax({
							url: 'pages/broucherrequest.php',
							data: $('#broucherrequest-container form').serialize() + '&action=send',
							type: 'post',
							cache: false,
							dataType: 'html',
							complete: function (xhr) {
								
								var msg = xhr.responseText;
								$('#broucherrequest-container .broucherrequest-loading').fadeOut(200, function () {
									$('#broucherrequest-container .broucherrequest-title').html('Thank you!');
									$('#broucherrequest-container .broucherrequest-message').html(msg).fadeIn(200);
									$('#broucherrequest-container .broucherrequest-content').css('height','250px');
									$('#broucherrequest-container .broucherrequest-message').show();
									$('#broucherrequest-content2').hide();
									$('#button').hide();
									
								});
							},
							error: broucherrequest.error
						});
					});
				});
			}
			else {
				if ($('#broucherrequest-container .broucherrequest-message:visible').length > 0) {
					
					var msg = $('#broucherrequest-container .broucherrequest-message div');
					msg.fadeOut(200, function () {
						msg.empty();
						broucherrequest.showError();
						msg.fadeIn(200);
					});
				}
				else {
					$('#broucherrequest-container .broucherrequest-message').animate({
						height: '30px'
					}, broucherrequest.showError);
				}
				
			}
		});
	},
	close: function (dialog) {
		$('#broucherrequest-container .broucherrequest-message').fadeOut();
		//$('#broucherrequest-container .broucherrequest-title').html('Goodbye...');
		$('#broucherrequest-container form').fadeOut(200);
		$('#broucherrequest-content2').hide();
		$('#button').hide();
		$('#broucherrequest-container .broucherrequest-content').animate({
			height: 250
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
		broucherrequest.message = '';
		if (!$('#broucherrequest-container #broucherrequest-name').val()) {
			broucherrequest.message += 'Name is required. ';
			return false;
		}
		var email = $('#broucherrequest-container #broucherrequest-email').val();
		if (!email) {
			broucherrequest.message += 'Email is required. ';
			return false;			
		}
		else {
			if (!broucherrequest.validateEmail(email)) {
				broucherrequest.message += 'Email is invalid. ';
				return false;				
			}
		}
		if (broucherrequest.message.length > 0) {
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
		$('#broucherrequest-container .broucherrequest-message')
			.html($('<div class="broucherrequest-error">').append(broucherrequest.message))
			.fadeIn(200);
	}
	
	
};
