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
 * Revision: $Id: alumni.js 204 2009-06-09 22:43:28Z emartin24 $
 *
 */
 var str = "<div style='width:100%; height:100%; margin-top: 134px; vertical-align:text-top; ' align='center'><img src='images/big.gif' border='0' /> Loading...</div>";
 
function popup()
{
	// load the alumni form using ajax
		$.get("pages/alumnilogin.php", function(data){
			$('.alumni-title').html(data);
			$('.alumni-message').hide();
			$('form').show();
			
			
			// add padding to the buttons in firefox/mozilla
		if ($.browser.mozilla) {
			$('#apply-container .alumni-button').css({
				'padding-bottom': '2px'
			});
		}
		// input field font size
		if ($.browser.safari) {
			$('#apply-container .alumni-input').css({
				'font-size': '.9em'
			});
		}

		// dynamically determine height
		var h = 160;
		if ($('#alumni-subject').length) {
			h += 26;
		}
		if ($('#alumni-cc').length) {
			h += 22;
		}

		var title = $('#apply-container .alumni-title').html();
		$('#apply-container .alumni-title').html('Alumni Login');
		
		$('#apply-container .alumni-content').animate({
				height: h
		}, function () {
						$('#apply-container .alumni-title').html(title);
						$('#apply-container form').fadeIn(200, function () {
							$('#apply-container #alumni-username').focus();

							// fix png's for IE 6
							if ($.browser.msie && $.browser.version < 7) {
								$('#apply-container .alumni-button').each(function () {
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
		/*
		dialog = this;
		dialog.overlay.fadeIn(200, function () {
											 
			dialog.container.fadeIn(200, function () {
				dialog.data.fadeIn(200, function () {
					$('#apply-container .alumni-content').animate({
						height: h
					}, function () {
						$('#apply-container .alumni-title').html(title);
						$('#apply-container form').fadeIn(200, function () {
							$('#apply-container #alumni-username').focus();

							// fix png's for IE 6
							if ($.browser.msie && $.browser.version < 7) {
								$('#apply-container .alumni-button').each(function () {
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
		});*/	
				
//			alumni.open(data);
			// create a modal dialog with the data
/*			$(data).modal({
				closeHTML: "<a href='#' title='Close' class='modalCloseX simplemodal-close'>x</a>",
				position: ["15%",],
				overlayId: 'alumni-overlay',
				containerId: 'apply-container',
				onOpen: alumni.open,
				onShow: alumni.show,
				onClose: alumni.close
			});*/
		});
}

$(document).ready(function () {
	$('a.alumnilogin').click(function (e) {
		
		e.preventDefault();
				abc = $(str).modal({
					position: ["2%","30%","5%","50%"]
				});

		// load the alumni form using ajax
		$.get("pages/alumnilogin.php", function(data){
				abc.close();
			// create a modal dialog with the data
			$(data).modal({
//				closeHTML: "<a href='#' title='Close' class='modalCloseX simplemodal-close'>x</a>",
				position: ["20%","10%","5%","20%"],
				overlayId: 'alumni-overlay',
				containerId: 'apply-container',
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
		i.src = 'images/alumni/' + this;
	});
});

var alumni = {
	message: null,
	open: function (dialog) {
		// add padding to the buttons in firefox/mozilla
		if ($.browser.mozilla) {
			$('#apply-container .alumni-button').css({
				'padding-bottom': '2px'
			});
		}
		// input field font size
		if ($.browser.safari) {
			$('#apply-container .alumni-input').css({
				'font-size': '.9em'
			});
		}

		// dynamically determine height
		var h = 160;
		if ($('#alumni-subject').length) {
			h += 26;
		}
		if ($('#alumni-cc').length) {
			h += 22;
		}

		var title = $('#apply-container .alumni-title').html();
		$('#apply-container .alumni-title').html('Loading...');
		dialog.overlay.fadeIn(200, function () {
			dialog.container.fadeIn(200, function () {
				dialog.data.fadeIn(200, function () {
					$('#apply-container .alumni-content').animate({
						height: h
					}, function () {
						$('#apply-container .alumni-title').html(title);
						$('#apply-container form').fadeIn(200, function () {
							$('#apply-container #apply-name').focus();

							$('#apply-container .alumni-cc').click(function () {
								var cc = $('#apply-container #alumni-cc');
								cc.is(':checked') ? cc.attr('checked', '') : cc.attr('checked', 'checked');
							});

							// fix png's for IE 6
							if ($.browser.msie && $.browser.version < 7) {
								$('#apply-container .alumni-button').each(function () {
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
		$('.apply-check').click(function (e) {
			e.preventDefault();
			// validate form
			if (alumni.validate()) {
				$('#apply-container .apply-message').fadeOut(function () {
					$('#apply-container .apply-message').removeClass('alumni-error').empty();
				});
				$('#apply-container .apply-title').html('Sending...');
				$('#apply-container form').fadeOut(200);
				$('#apply-container .apply-content').animate({
					height: '250px'
				}, function () {
					$('#apply-container .apply-loading').fadeIn(200, function () {
						$.ajax({
							url: 'pages/alumnilogin.php',
							data: $('#apply-container form').serialize() + '&action=send',
							type: 'post',
							cache: false,
							dataType: 'html',
							complete: function (xhr) {
								msg = xhr.responseText;
								alert(msg);
								$('#apply-container .apply-loading').fadeOut(200, function () {
									$('#apply-container .apply-title').html('Thank you!');
									$('#apply-container .apply-message').html(msg).fadeIn(200);
									
									if(msg == 0 || msg == 2)
									{
										$('#apply-container .apply-title').html('Login Failed!');
//										$('#apply-container .alumni-message').append('<a href=\"#\" class=\"alumnilogin\" onclick=\"popup();\">Try again</a>');
										$('#apply-container .apply-content').animate({
																height: '250px'
															});
									}
									else
									{
											
									}
									$('#apply-container .apply-message div').show();
								});
							},
							error: alumni.error
						});
					});
				});
			}
			else {
				if ($('#apply-container .apply-message:visible').length > 0) {
					var msg = $('#apply-container .apply-message div');
					msg.fadeOut(200, function () {
						msg.empty();
						alumni.showError();
						msg.fadeIn(200);
					});
				}
				else {
					$('#apply-container .apply-message').animate({
						height: '30px'
					}, alumni.showError);
				}
				
			}
		});
	},
	close: function (dialog) {
		$('#apply-container .apply-message').fadeOut();
		$('#apply-container .apply-title').html('Goodbye...');
		$('#apply-container form').fadeOut(200);
		$('#apply-container .apply-content').animate({
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
		alumni.message = '';
		username = $('#apply-container #apply-username').val();
		if (!username) {
			alumni.message += 'Username is required. ';
			return false;
		}
		else {
			if (!alumni.validateEmail(username)) {
				alumni.message += 'Username must be an email address';
				return false;				
			}
		}
		
		if (!$('#apply-container #apply-password').val()) {
			alumni.message += 'Password is required. ';
			return false;			
		}

		if (alumni.message.length > 0) {
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
		$('#apply-container .apply-message')
			.html($('<div class="apply-error">').append(alumni.message))
			.fadeIn(200);
	}
};