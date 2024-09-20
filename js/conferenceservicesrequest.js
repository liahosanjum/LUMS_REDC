/*
 * SimpleModal conferenceservice Form
 * http://www.ericmmartin.com/projects/simplemodal/
 * http://code.google.com/p/simplemodal/
 *
 * Copyright (c) 2009 Eric Martin - http://ericmmartin.com
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Revision: $Id: conferenceservice.js 204 2009-06-09 22:43:28Z emartin24 $
 *
 */
 /* To get max length in a textarea*/
 
 function ismaxlength(obj)
   	{
		var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : ""
		if (obj.getAttribute && obj.value.length>mlength)
		obj.value=obj.value.substring(0,mlength)
	}
	
	 var str = "<div style='width:100%; height:100%; vertical-align:text-top; margin-left:50%; margin-top:10%;' align='center'><img src='images/big.gif' border='0' /> Loading...</div>";
	 
$(document).ready(function () {
	
							
	$('a.conferenceservice, #conferenceservicesrequestForm input.conferenceservice, #conferenceservicesrequestForm a.conferenceservice').click(function (e) {

		e.preventDefault();
		abc = $(str).modal({
					position: ["10%","30%","5%","50%"]
				});
		// load the conferenceservice form using ajax
		$.get("pages/conferenceservicesrequest.php", function(data){
			// create a modal dialog with the data
			abc.close();
			//alert(data);
			$(data).modal({
				//closeHTML: "<a href='#' title='Close' class='modalCloseX simplemodal-close'>x</a>",
				position: ["2%","10%","5%","10%"],
				overlayId: 'conferenceservice-overlay',
				containerId: 'conferenceservice-container',
				onOpen: conferenceservice.open,
				onShow: conferenceservice.show,
				onClose: conferenceservice.close
			});
		});
	});

	// preload images
	var img = ['cancel.png', 'form_bottom.gif', 'form_top.gif', 'loading.gif', 'send.png'];
	$(img).each(function () {
		var i = new Image();
		i.src = 'images/conferenceservice/' + this;
	});
});

var conferenceservice = {
	message: null,
	open: function (dialog) {
		// add padding to the buttons in firefox/mozilla
		if ($.browser.mozilla) {
			$('#conferenceservice-container .conferenceservice-button').css({
				'padding-bottom': '2px'
			});
		}
		// input field font size
		if ($.browser.safari) {
			$('#conferenceservice-container .conferenceservice-input').css({
				'font-size': '.9em'
			});
		}

		// dynamically determine height
		var h = 500;
		
		if ($('#conferenceservice-subject').length) {
			h += 26;
		}
		if ($('#conferenceservice-cc').length) {
			h += 22;
		}

		var title = $('#conferenceservice-container .conferenceservice-title').html();
		//$('#conferenceservice-container .conferenceservice-title').html('Loading...');
		dialog.overlay.fadeIn(200, function () {
			dialog.container.slideDown(500, function () {
				dialog.data.slideDown(500, function () {
					$('#conferenceservice-container .conferenceservice-content').animate({
						height: h
					}, function () {
						$('.conferenceservice-button').show();
						$('.conferenceservice-content2').show();
						$('#conferenceservice-container .conferenceservice-title').html(title);
						$('#conferenceservice-container form').fadeIn(200, function () {
							$('#conferenceservice-container #conferenceservice-firstname').focus();

							$('#conferenceservice-container .conferenceservice-cc').click(function () {
								var cc = $('#conferenceservice-container #conferenceservice-cc');
								cc.is(':checked') ? cc.attr('checked', '') : cc.attr('checked', 'checked');
							});

							// fix png's for IE 6
							if ($.browser.msie && $.browser.version < 7) {
								$('#conferenceservice-container .conferenceservice-button').each(function () {
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
		$('#conferenceservice-container .conferenceservice-send').click(function (e) {
			e.preventDefault();
			// validate form
			if (conferenceservice.validate()) {
				$('#conferenceservice-container .conferenceservice-message').fadeOut(function () {
					$('#conferenceservice-container .conferenceservice-message').removeClass('conferenceservice-error').empty();
				});
				$('#conferenceservice-container .conferenceservice-title').html('Sending...');
				$('#conferenceservice-container form').fadeOut(200);				
				$('#conferenceservice-content2').hide();
				$('.conferenceservice-info').hide();
				$('#button').hide();
				$('#conferenceservice-container .conferenceservice-content').animate({
					height: '520px'
				}, function () {
					$('#conferenceservice-container .conferenceservice-loading').fadeIn(200, function () {
						$.ajax({
							url: 'pages/conferenceservicesrequest.php',
							data: $('#conferenceservice-container form').serialize() + '&action=send',
							type: 'post',
							cache: false,
							dataType: 'html',
							complete: function (xhr) {
								var msg = xhr.responseText;		
								$('#conferenceservice-container .conferenceservice-loading').fadeOut(200, function () {
									$('#conferenceservice-container .conferenceservice-title').html('Thank You');
									$('#conferenceservice-container .conferenceservice-message').html(msg).fadeIn(200);
									$('#conferenceservice-container .conferenceservice-content').css('height', '520px');
									$('#conferenceservice-container .conferenceservice-message').show();
									$('#conferenceservice-content2').hide();
									$('#button').hide();
									
								});
							},
							error: conferenceservice.error
						});
					});
				});
			}
			else {
				if ($('#conferenceservice-container .conferenceservice-message:visible').length > 0) {
					
					var msg = $('#conferenceservice-container .conferenceservice-message div');
					msg.fadeOut(200, function () {
						msg.empty();
						conferenceservice.showError();
						msg.fadeIn(200);
					});
				}
				else {
					$('#conferenceservice-container .conferenceservice-message').animate({
						height: '30px'
					}, conferenceservice.showError);
				}
				
			}
		});
	},
	close: function (dialog) {
		$('#conferenceservice-container .conferenceservice-message').fadeOut();
		//$('#conferenceservice-container .conferenceservice-title').html('Goodbye...');
		$('#conferenceservice-container form').fadeOut(200);
		$('#conferenceservice-content2').hide();
		$('#button').hide();
		$('#conferenceservice-container .conferenceservice-content').animate({
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
		conferenceservice.message = '';
		
		if (!$('#conferenceservice-container #conferenceservice-firstname').val()) {
			
			conferenceservice.message += 'First Name is required. ';
			return false;
		}
		
		if (!$('#conferenceservice-container #conferenceservice-lastname').val()) {
			conferenceservice.message += 'Last Name is required. ';
			return false;			
		}
		if (!$('#conferenceservice-container #conferenceservice-organisation').val()) {
			conferenceservice.message += 'Organization is required. ';
			return false;			
		}
		var phoneno = $('#conferenceservice-container #conferenceservice-phoneno').val();
		if (!$('#conferenceservice-container #conferenceservice-phoneno').val()) {
			conferenceservice.message += 'Telephone is required. ';
			return false;			
		}
		else {
			if (!conferenceservice.validateNo(phoneno)) {
				conferenceservice.message += 'Telephone is invalid. ';
				return false;				
			}
		}
		var fax = $('#conferenceservice-container #conferenceservice-fax').val();
		if(fax){
		if (!conferenceservice.validateNo(fax)) {
				conferenceservice.message += 'Fax is invalid. ';
				return false;				
			}
		}
		var mobile = $('#conferenceservice-container #conferenceservice-mobile').val();
		if(mobile)
		{
		if (!conferenceservice.validateNo(mobile)) {
				conferenceservice.message += 'Mobile is invalid. ';
				return false;				
			}
		}
		var email = $('#conferenceservice-container #conferenceservice-email').val();
		if (!email) {
			
			conferenceservice.message += 'Email is required. ';
			return false;			
		}
		else {
			if (!conferenceservice.validateEmail(email)) {
				conferenceservice.message += 'Email is invalid. ';
				return false;				
			}
		}
		if($('#conferenceservice-container #conferenceservice-month').val()== 02  && $('#conferenceservice-container #conferenceservice-date').val() > 28)
		{
			conferenceservice.message += 'Date Of Event is invalid. ';
			return false;
		}
		if(($('#conferenceservice-container #conferenceservice-month').val()== 4 || $('#conferenceservice-container #conferenceservice-month').val()== 6 || $('#conferenceservice-container #conferenceservice-month').val()== 9 || $('#conferenceservice-container #conferenceservice-month').val()== 11 )  && ($('#conferenceservice-container #conferenceservice-date').val() > 30))
		{
			conferenceservice.message += 'Date of Event is invalid. ';
			return false;
		}
		test = $('#conferenceservice-container #currentdate').val();
		array = test.split("-");
		//cdate = array[0]+array[1]+array[2];
		cdate = array[2]+array[0]+array[1];
		currentdate = parseInt(cdate);
		//currentdate = parseInt(cdate,10);
		year = $('#conferenceservice-container #conferenceservice-year').val();
		month = $('#conferenceservice-container #conferenceservice-month').val();
		date = $('#conferenceservice-container #conferenceservice-date').val();
		//edate = month+date+year;
		edate = year+month+date;
		eventdate = parseInt(edate);
		if(eventdate < currentdate)
		{
			
			conferenceservice.message += 'Date of event must be greater than or equal to current date.';
			return false;			
		}
	
		if (!$('#conferenceservice-container #conferenceservice-participants').val()) {
			conferenceservice.message += 'No of Participants is required.';
			return false;			
		}
		var participants = $('#conferenceservice-container #conferenceservice-participants').val();
		if (!participants) {
			conferenceservice.message += 'No of Participants is required. ';
			return false;			
		}
		else {
			if (!conferenceservice.validateNo(participants)) {
				conferenceservice.message += 'No of Participants is invalid. ';
				return false;				
			}
		}
		var single = $('#conferenceservice-container #conferenceservice-single').val();
		if(single){
		if (!conferenceservice.validateNo(single)) {
				conferenceservice.message += 'Single is invalid. ';
				return false;				
			}
		}
		var double = $('#conferenceservice-container #conferenceservice-double').val();
		if(double){
		if (!conferenceservice.validateNo(double)) {
				conferenceservice.message += 'Double is invalid. ';
				return false;				
			}
		}
		
		if (conferenceservice.message.length > 0) {
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
		$('#conferenceservice-container .conferenceservice-message')
			.html($('<div class="conferenceservice-error">').append(conferenceservice.message))
			.fadeIn(200);
	}
	
	
};
