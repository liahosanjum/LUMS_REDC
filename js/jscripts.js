/// check the user name already exist
function check_user_name(siteurl)
{ 
	//set_data1('');
	var user_name = document.getElementById('email').value;
	
	$.ajax({
		   
			  type: "POST",
			  url: siteurl+"/ajax_php/chk_user.php",
			  data: "username="+user_name,
			  beforeSend:function()
			  {
				  $("#loading_img").show();
			  }, 
			  success: function(data){
				    //alert(data);
					//setTimeout('set_data1(\''+data+'\')',1500)
				  }
			  /*complete:function()
			  {
				 $("#loading_img").hide();
			  }*/
			});
	$("#error").html("");
}

//function validate(){
//
//var email=document.getElementById('email').value;
//
// if(email=="")
//{
//	document.getElementById('message').innerHTML="Email is  Required Fields";
//	//document.getElementById('message').style.display="block";
//	
//	return false;
//	else{ 
//	return true ;
//	}
//}
// if(name=="")
//{
//	document.getElementById('message').innerHTML="Name is  Required Fields";
//	//document.getElementById('message').style.display="block";
//	
//	return false;
//    else
//	{
//	return true ;
//	}
//}
//
//
//return true;
//}



function subscribe(siteurl)
{ 
	
	var name = $('#name').val();
	var email = $('#email').val();
	var companyname = $('#companyname').val();
	var designation = $('#designation').val();
	
	if(name == "")
   {
	   $("#error").html("Please insert name");
	   return false;
   }
    if(email == "" || email == "Email Address*")
   {
	   $("#error").html("Please insert email");
	   return false;
   }
	else {
			if (!validateEmail(email)) {
				$("#error").html("Please insert a valid email");
				return false;				
			}
		}

   if(companyname == "")
   {
	   $("#error").html("Please insert company name");
	   return false;
   }

  if(designation == "")
   {
	   $("#error").html("Please insert designation");
	   return false;
   }

	str = "<div style=\"border-bottom:#d8e6ec solid 1px; padding-bottom:10px;\">" +
		"<p><img src=\"" + siteurl + "/images/small.gif\" style=\"border:none\" /> Submitting ...</p>" +
		"</div>";

	$("#error").html(str);
	$("#error").show();
	
	$.ajax({
			  type: "POST",
			  url: siteurl+"/ajax_php/subscribe.php",
			  data: $('#frmSubscribe').serialize() + '&action=send',
			  //data: "email="+user_email,
			  //data: "name="+user_name,
			  // $("#error").show();
			   success: function(data){
//				   alert(data);
					//if(data == "You have been subscribed successfully")
					//{
						//$('#form').hide();
					//}
					$('#name').val('Name');
					$('#email').val('Email Address*');
					$('#companyname').val('Company Name');
					$('#designation').val('Designation');
					  $("#error").html(data);
					//setTimeout('set_data1(\''+data+'\')',1500)
				  }
			  /*complete:function()
			  {
				 $("#loading_img").hide();
			  }*/
			});
	
	
	
}
 function validateEmail(email) {
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
		/*	if (!/^[-a-zA-Z0-9!#$%*\/?|^{}`~&'+=_\.]*$/.test(local))
				return false; */ // COMMENTED BY BILAL KHAN ON 27-10-2009
		}

		// Make sure domain contains only valid characters and at least one period
		if (!/^[-a-zA-Z0-9\.]*$/.test(domain) || domain.indexOf(".") === -1)
			return false;	

		return true;
	}

function doSearch(mon)
{
	mon = new String(mon);
	if(mon.length == 1)
	{
		mon = "0" + mon;
	}

	document.getElementById("month").value = mon;
	document.forms['upcoming'].submit();
}

function getoepprogramme(month, year, siteurl)
{

	$('.monthtabs a').removeClass('active');
	$('.monthtabs #' + month).addClass('active');
	
	// show loader
	strProgrammes = "<div style=\"border-bottom:#d8e6ec solid 1px; padding-bottom:10px;\">" +
		"<p><img src=\"" + siteurl + "/images/small.gif\" style=\"border:none\" /> Loading programmes ...</p>" +
		"</div>";

	$("#programmes").html(strProgrammes);
	$("#programmes").show();

	$.ajax({
			  
			  type: "POST",
			  url: siteurl+"/ajax_php/oeppro.php",
			  data: "month="+ month + "&year="+ year,
			  success: function(response){

					if(response != "")
					{
						response = response.substring(0, response.length - 1);
//						alert(response)
						var listArray = response.split(";");
									
						strProgrammes = "";
						 
						for(j=0; j < listArray.length; j++)
						{
							temp = listArray[j]; // [id:name]
							tempArray = temp.split("~");
							
							id = tempArray[0];
							catid = tempArray[1];
							name = tempArray[2];
							startdate = tempArray[3];
							enddate = tempArray[4];
//							avail = tempArray[5];
				
							strProgrammes += 	"<div style=\"border-bottom:#d8e6ec solid 1px; padding-bottom:10px;\">" +
							"<p>" + startdate + " "+"<span style=\"font-weight:bold; padding-left:5px; padding-right:5px;\"> to </span>" +" "+ enddate + "</p>";
							
//							if(avail == "Y")
//							{
								strProgrammes += "<a class=\"txt\" href=\"programmedetail.php?oepid_=" + id + "&oepcatid=" + catid + "\">" + name + "</a>";
//							}
//							else
//							{
//								str += "<a class=\"txt\" style=\"color:red\" href=\"programmedetail.php?oepid_=" + id + "&oepcatid=" + catid + "\">" + name + "</a>";
//							}
							
							strProgrammes += "</div>";
	
						}
						if(j>0)
							strProgrammes += 
							"<form name='upcoming' id='upcoming' method='post' action='prog_finder.php'>" + 
							"<input type='hidden' name = 'month' id='month'>" +
							"<div align='right'><a href='#' onclick=\"doSearch("+month+")\" style='color:#000' class='left_links_news_events'>See All</a></div>" + 
							"</form>";
					}
					else
					{
						strProgrammes = "<div style=\"border-bottom:#d8e6ec solid 1px; padding-bottom:10px;\">" +
							"<p>No programme currently being offered</p>" +
							"</div>";
					}
				    $("#programmes").html(strProgrammes);
					$("#programmes").show();
				  }
			});
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