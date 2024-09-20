<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="{$pagedata.keywords}" />
<title>{$pagedata.explorertitle}</title>
<meta name="keywords" content="{$pagedata.keywords}" />
<meta name="description" content="{$pagedata.description}" />
{include file="includes.tpl"}
{literal}



<script type="text/javascript">

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
function submitForm()
		{
			document.forms[0].submit();
		}
		</script>
        {/literal}
        {literal}
<script type="text/javascript">
	jQuery().ready(function(){
		// simple accordion
		jQuery('#list1a').accordion();
			});
			function showDiv(divId)
        		{
					 var divPane = document.getElementById(divId);
					if(divPane.style.display == "none")
					{
						divPane.style.display = "";
						if(divId == 'oep')
				{
				window.location.href ="oep_programme.php?section_id=0&pcid=151";
				}
				if(divId == 'ofp')
				{
				window.location.href ="ofp_programme.php?section_id=0&pcid=150";
				}
					}
					else if(divPane.style.display == "block" || divPane.style.display == "")
					{
						divPane.style.display = "none";
					}
        		}
	
	function showAll(divId)
	{
		var divPane = document.getElementById(divId);
            if(divPane.style.display == "none")
            {
                divPane.style.display = "";
				$(".oep_programmes").show();
            }
            else if(divPane.style.display == "block" || divPane.style.display == "")
            {
                divPane.style.display = "none";
            }
		//$("#oep").show();
		//$(".oep_programmes").show();
	}
	</script>

{/literal}
</head>
<body>
<div id="main_container">
 {include_php file="header.php"}
<div class="contentspane">
  <div  class="content">
    <div class="left_pane">
 <div class="programm_tab"><span class="showall"><a class="showall" href="javascript:showAll('oep')">Show All Programmes</a></span></div>
 <div>
		<ul>
			<li><a href="#" onclick="javascript:showDiv('oep');" ><strong>Open Enrollment Programmes</strong></a></li>
		</ul>
	</div>	
    
		<div id="oep" style="display:block;">
			{php}$index = 0;{/php}
			<ul style="padding-left:10px">
				{foreach from=$category item="entry"}		
				<li class="level1">
				{php}$programmes = getProgrammes($this->_tpl_vars['category'][$index]['oepcatid']); {/php}
				<a class="{if $smarty.get.oepcatid eq $entry.oepcatid}selected{/if}" href="#" onclick="showDiv('programmes_{$entry.oepcatid}');" >{$entry.name}</a>
				{php}if($programmes[0]['name'] != ""){{/php}
				<div id="programmes_{$entry.oepcatid}" style="display:{if $smarty.get.oepcatid eq $entry.oepcatid}block{/if}none;" class="oep_programmes">
					<ul style="margin-left:0px">
					{php}
					for($i=0; $i < count($programmes); $i++)
					{
					if($i==count($programmes)-1)
						{
					{/php}
					<li class="last">
					<a  href="programmedetail.php?oepid ={php}echo $programmes[$i]['oepid'];{/php}&oepcatid={$entry.oepcatid}" >{php}echo $programmes[$i]['name'];{/php}</a></li>
					{php}
						}
					else
						{
					{/php}
					<li class="level2">
					<a  href="programmedetail.php?oepid ={php}echo $programmes[$i]['oepid'];{/php}&oepcatid={$entry.oepcatid}" >{php}echo $programmes[$i]['name'];{/php}</a></li>
					{php}
						}
					}
					{/php}
					</ul>
				</div>
				{php}}{/php}
				</li>
				
<!--				</div>-->
				{php}$index++;{/php}
				{/foreach}
			</ul>					
        </div>
		<div>
		<ul>
			<li><a href="#" onclick="javascript:showDiv('ofp');" ><strong>Organization Focused Programmes</strong></a></li>
		</ul>
		</div>
		<ul style="margin-left:5px">
		<div id="ofp" style="display:none;">
        {foreach from=$page item="entry"}
		<li class="level1">
		<a href="ofp_programme.php?section_id={$entry.psid}&pcid={$entry.pcid}" >{$entry.pagename}</a></li>
		{/foreach}
        </div>
		</ul>
		<div class="clear"></div>
		<div class="social_area" align="center">
        <div style="padding-bottom:30px;"><a href="http://www.facebook.com/home.php#!/pages/Rausing-Executive-Development-Centre-REDC/196041647077444" target="_blank"><img src="images/facebook.jpg" border="0" /></a></div>
        <div style="padding-bottom:30px"><a href="http://twitter.com/REDC_LUMS" target="_blank"><img src="images/twitter.jpg" border="0" /></a></div>
        <div style="padding-bottom:10px"><a href="http://www.linkedin.com/groups?gid=2640725&trk=anetsrch_name&goback=.gdr_1265196991819_1" target="_blank"><img src="images/delicious.jpg" border="0" /></a></div>
      </div>
    	
		
	  <!-- <div id="ebroucherrequestForm">
	   <ul>
	   		<li><a href="#" class="ebroucherrequest">Request a Printed Brochure</a></li>
	   </ul>
	   </div>-->
    </div>
    <div class="center_pane_full">
   	  <div class="program_heading_prog_finder">
      <div class="main_heading_cms" style="background:url({$GENERAL.FRONT_UPLOAD_URL}/homeSectionPictures/{$simage.0.sec_image}) no-repeat;"><h1>{$pagedata.pagetitle}</h1></div>
        	<!--<div class="main_heading" style="background:url(images/banr.gif) no-repeat;"><h1>{$pagedata.pagename}</h1></div>-->
            <div class="programme_details" style="display:{if $pagedata.details eq ""}none{/if}" >{$pagedata.details}</div>
    
      </div>
      <form action="prog_finder.php" method="post" name="programmefinder" >
        <div class="listing">
        	<div class="forms_listing">
        	<div class="forminputs_listing">
            <ul>
            
            	<li class="txt" style="font-family:Verdana, Arial, Helvetica, sans-serif;">Programme Name:</li>
                <!--echo $_POST["search_by_name"];--> 
               {if $formvars.search_by_name eq 'Programme Name'}
                
                <li><input name="search_by_name" type="text" id="search_by_name" class="bluebar" value="" style="font-family:Verdana, Arial, Helvetica, sans-serif;" /></li>
                {else}
                 <li><input name="search_by_name" type="text" id="search_by_name" class="bluebar" value="{$formvars.search_by_name}" /></li>
               {/if}
            </ul>
			<ul>
            	
                <li class="txt">Programme Category:</li>
                <li>
				 <select name="search_by_oepcatid" class="bluebar" style="font-size:13px; font-family:Verdana, Arial, Helvetica, sans-serif;"  id="search_by_oepcatid">
                		<option value="">Programme Category</option>
							{foreach from=$category item="cat"}
								{if $formvars.search_by_oepcatid eq $cat.oepcatid}
									<option value="{$cat.oepcatid}" selected="selected">{$cat.name|escape}</option>
								{else}
									<option value="{$cat.oepcatid}">{$cat.name|escape}</option>
								{/if}
							{/foreach}
						
						<!--{foreach from=$pname item='cat'}
								 
								{if $data.search_by_oepcatid eq $cat.oepcatid}
									<option value="{$cat.oepcatid}" selected="selected">{$cat.name}</option>
								{else}
									<option value="{$cat.oepcatid}">{$cat.name}</option>
								{/if}	
								
							{/foreach}-->
              	    </select>
                </li>
            </ul>
            <ul>
            	<li class="txt"> Programme Level:</li>
                <li>
				{if $formvars.month eq $month.month}
				{/if}
               <select name="programme_by_level" class="bluebar" id="programme_by_level" style="font-size:13px; font-family:Verdana, Arial, Helvetica, sans-serif;">
					<option value="">Programme Level</option>							
                            <option value="Top Management" >Top Management</option>
                            <option value="Senior Management" >Senior Management</option>
                            <option value="Middle Management">Middle Management</option>
                            <option value="First Line Managers">First Line Managers</option>
                            <option value="Others">Others</option>
                    </select>
                </li>
            </ul>
            {literal}<script type="text/javascript">
			selectDropdown('programme_by_level','{/literal}{$formvars.search}{literal}')
			</script>
			{/literal}
              <ul>
            	<li class="txt">Start Month:</li>
                <li>
				
               <select name="month" class="bluebar" id="month" style="font-size:13px; font-family:Verdana, Arial, Helvetica, sans-serif;">
	               <option value="">Start Month</option>
				 <option value="01">January</option>
				 <option value="02">February</option>
				 <option value="03">March</option>
				 <option value="04">April</option>
				 <option value="05">May</option>
				 <option value="06">June</option>
				 <option value="07">July</option>
				 <option value="08">August</option>
				 <option value="09">September</option>
				 <option value="10">October</option>
				 <option value="11">November</option>
				 <option value="12">December</option>
              	    </select>
                </li>
            </ul>
            {literal}<script type="text/javascript">
			selectDropdown('month','{/literal}{$formvars.month}{literal}')
			</script>
			{/literal}
			
            <div class="clear"></div>
            <ul>
            	<li class="empty">&nbsp; </li>
                
            <li style="margin-left:67px;"><a href="#" class="next_listing" onclick="javascript: submitForm();">Search&nbsp;&nbsp;</a></li>
           
            </ul>

            </div>            

			            
        </div>
        
        </div>
        <div class="listing_sections">
		<div class="error_txt">{$error}</div>
        	<ul>
            	<li class="blue name">
                	Programme Name
                </li>
                <li class="blue category">
                Category
                </li>
                <li class="blue date_listing_blue" style="border-right:#c0c7cd solid 1px;">
                	Date
                </li>
                 <li  class="blue detail" style="border-right:#c0c7cd solid 1px;">
                	Detail
                </li>
				<li  class="blue detail" style="">
                	Apply
                </li>
            </ul>
            
			<ul>
			   {foreach from=$data item="entry" name=list}
			{if $smarty.foreach.list.index % 2 eq 0}
				{assign var="class" value="gray"}	
			{else}
				{assign var="class" value="lightblue"}	
			{/if}
            	<li class="{$class} boldtxt name"><a href="{$GENERAL.BASE_URL_ROOT}/programmedetail.php?oepid_={$entry.oepid}&oepcatid={$entry.oepcatid}" class="list1">
                	{$entry.name|truncate:54}</a>
                </li>
                <li class="{$class} normaltxt category">
                {$entry.category_name}
                </li>
				
                <li class="{$class} date_listing">

				{if $entry.status ne 'tba'}
                	<span class="boldtxt">From:</span>{$entry.startdate|date_format:" %b %e, %Y"}<br />
                    <span class="boldtxt margin_top">To:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$entry.enddate|date_format:" %b %e, %Y"}
                {else}
					<span class="boldtxt">TBA</span>
				{/if}
                </li>
				
                <li class="{$class} detail ">
                 <a class="list1" href="{$GENERAL.BASE_URL_ROOT}/programmedetail.php?oepid_={$entry.oepid}&oepcatid={$entry.oepcatid}">
                	More</a>
                 </li>
				 
				 <li class="{$class} detail ">
                 <!--<a class="list1" href="{$GENERAL.BASE_URL_ROOT}/programmedetail.php?oepid_={$entry.oepid}&oepcatid={$entry.oepcatid}">
                	More</a>-->
                    {if $entry.status ne 'tba'}
					<a class="list1" href="{$GENERAL.BASE_URL_ROOT}/apply.php?pid={php} echo encrypt($this->_tpl_vars['entry']['oepid']);{/php}#apply">
                	Apply</a>
                    {else}
                    <span style="font-weight:bold">Apply</span>
                    {/if}
                 </li>
				{/foreach}
				
            </ul>
			
           <!-- <ul>
            	<li class="gray boldtxt name">
                	General Managment                </li>
                <li class="gray normaltxt category">
                General Managment                </li>
                <li class="gray date_listing">
                	<span class="boldtxt">From:</span> 08-11-2009<br />
                    <span class="boldtxt margin_top">To:&nbsp;&nbsp;&nbsp;&nbsp;</span> 18-11-2009</li>
            </ul>-->
        </div>
        
        
    </div>
    <div style="width:100%; display:{if $pagenum < 10}none;{/if}">{$paging}</div>
  </div>
    
</div>
</form>
<div class="clear"></div>

<div class="tabs_bar">
<!--<div class="ab_for_pro_finder" align="center"> {$paging}</div>-->

	<div class="tabs">
		
	</div>
</div>
{include file="footer.tpl"}
</div>
{include_php file="bar.php"}
</body>
</html>