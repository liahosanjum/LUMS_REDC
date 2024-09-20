{assign var="tpl_path" value=$GENERAL.BASE_DIR_ADMIN_TPL}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
{include file="$tpl_path/top_header.tpl"}


{literal}
<style type="text/css" media="print">
#btnPrint
{
	display:none;	
}
{/literal}
</style>
</head>
<body >
  {if $pageview eq "detail"}
 	<table border="0" cellspacing="0" cellpadding="0" width="680" align="center">
    <tbody>
        <tr>
            <td style="border-bottom: rgb(211,211,211) 1px solid; padding-bottom: 5px"><img alt="" src="{$GENERAL.FRONT_IMG_URL}/logo.jpg" /></td>
            <td align="right" style="border-bottom: rgb(211,211,211) 1px solid; padding-bottom: 5px"><img alt="" src="{$GENERAL.FRONT_IMG_URL}/redc.jpg" /></td>
        </tr>
        <tr>
            <td colspan="2" >

	 <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr id="btnPrint">
              <td colspan="5" align="center" class="toolbar button"><a style="text-decoration:none; color:#000; font:Verdana, Geneva, sans-serif" href="javascript:window.print();" class="toolbar"><img src="{$GENERAL.ADMIN_IMG_URL}/toolbar/Print-icon.png" border="0" alt=""  /> <br />Print</a></td>
            </tr>
            <tr>
              <td width="10" align="center">&nbsp;</td>
              <td width="100%" valign="top" class="boderInner2">
			 
					<table width="98%" border="0" cellspacing="1" cellpadding="1" class="normalTxt">
                  <tr height="25" >
                    <td align="left" colspan="2" class="tipbox">
						
					</td>
                  </tr>
                
				  <tr class="row2">
                    <td width="24%" align="right" valign="top" class="fieldtitle">Name :&nbsp;</td>
                    <td width="76%" align="left">
					{$data.firstname|escape}&nbsp;{$data.lastname|escape}
					<!--<input type="hidden" name="uid" value="{$data.uid|escape}"/>
					<input type="hidden" name="prevname" value="{$oldemail}"/>
					<input type="hidden" name="oepaid" value="{$data.oepaid|escape}"/>-->
					
				      <span class="required">&nbsp;</span></td>
                  </tr> 
				  <tr class="row2">
                    <td width="24%" align="right" valign="top" class="fieldtitle">Email :&nbsp;</td>
                    <td width="76%" align="left">
					{$data.busemail|escape}
					<!--<input type="hidden" name="uid" value="{$data.uid|escape}"/>
					<input type="hidden" name="prevname" value="{$oldemail}"/>
					<input type="hidden" name="oepaid" value="{$data.oepaid|escape}"/>-->
					
				      <span class="required">&nbsp;</span></td>
                  </tr> 
				  <tr class="row2">
                    <td width="24%" align="right" valign="top" class="fieldtitle">Previously Attended Programmes :&nbsp;</td>
                    <td width="76%" align="left">
                    {foreach from=$programmes item="programme"}
					{$programme.name}<br />
                    {/foreach}
					</td>
                  </tr> 
				  
				 <!-- <tr class="row2">
                    <td width="24%" align="right" valign="top" class="fieldtitle">Password :&nbsp;</td>
                    <td width="76%" align="left">{$data.password|escape}
                      <span class="required">&nbsp;</span></td>
                  </tr> -->
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Personal Data</span></td>
				</tr>
                  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">First Name :&nbsp;</td>
                    <td width="81%" align="left">{$data.firstname|escape}
                      <span class="required">&nbsp;</span></td>
                  </tr> 
                  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Middle Name :&nbsp;</td>
                    <td width="81%" align="left">{$data.middlename|escape}
                    </td>
                  </tr> 
                  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Last Name :&nbsp;</td>
                    <td width="81%" align="left">{$data.lastname|escape}
                    </td>
                  </tr> 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Prefix :&nbsp;</td>
                    <td width="81%" align="left">
							{$data.prefix}
					</td>
                  </tr> 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Gender :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.gender}
					</td>
                  </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Natoinality :&nbsp;</td>
                    <td width="81%" align="left">{$data.nationality|escape}
                    </td>
                  </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Business Email :&nbsp;</td>
                    <td width="81%" align="left">{$data.busemail|escape}
                      </td>
                  </tr>
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  

				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">In case of emergency, please notify</span></td>
				</tr>  
				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">Name :&nbsp;</td>
                    <td width="74%" align="left">{$data.emergencyname|escape}
                      <span class="required">&nbsp;</span></td>
                  </tr>
				  <tr class="row2">
                    <td width="26%" align="right" valign="top" class="fieldtitle">Telephone :&nbsp;</td>
                    <td width="74%" align="left">{$data.emergencyphone|escape}
                      </td>
                  </tr>
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Contact Data</span></td>
				</tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Designation :&nbsp;</td>
                    <td width="81%" align="left">{$data.contactdesignation|escape}
                    </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Company/Organisation Name :&nbsp;</td>
                    <td width="81%" align="left">{$data.companyname|escape}
                      </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Parent Company Name (If different from company name) :&nbsp;</td>
                    <td width="81%" align="left">{$data.companyother|escape}
                      </td>
                  </tr>
				  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Organisation Address :&nbsp;</td>
                    <td width="81%" align="left">{$data.companyaddress|escape}
                     </td>
					</tr> 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">City :&nbsp;</td>
                    <td width="81%" align="left">{$data.city|escape}
                    </td>
                  </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Country :&nbsp;</td>
                    <td width="81%" align="left">{$data.countryname|escape}</td>
                  </tr>
  				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Telephone :&nbsp;</td>
                    <td width="81%" align="left">{$data.ctelephone|escape}</td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Cell Number :&nbsp;</td>
                    <td width="81%" align="left">{$data.cell|escape}
                    </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Fax Number :&nbsp;</td>
                    <td width="81%" align="left">{$data.fax|escape}
                     </td>
                  </tr>   
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Organisational Data</span></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Your Parent Company/Organisation</span></td>
				</tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Products/Services :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.parentservices|escape}
                     </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">No. of Employees :&nbsp;</td>
                    <td width="81%" align="left">{$data.parentnumemployees|escape}
                      </td>
                  </tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Your Company/Division</span></td>
				</tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Products/Services :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.services|escape}</td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">No. of Employees :&nbsp;</td>
                    <td width="81%" align="left">{$data.numemployees|escape}
                      </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">How many employees are under your supervision? :&nbsp;</td>
                    <td width="81%" align="left">{$data.numemployeessupervision|escape}
                      </td>
                  </tr>
				 
				  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">What is the title position of the person to whom you report? :&nbsp;</td>
                    <td width="81%" align="left">{$data.reportperson|escape}
                     </td>
					</tr> 
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Please select your current industry :&nbsp;</td>
                    <td width="81%" align="left">
				
							{$data.industry} 
						
                      </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Specify Other :&nbsp;</td>
                    <td width="81%" align="left">{$data.industryother|escape}
                      </td>
                  </tr>
				  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">What function best describes your position :&nbsp;</td>
                    <td width="81%" align="left">
					
						{$data.position}
				</td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Specify Other :&nbsp;</td>
                    <td width="81%" align="left">{$data.positionother|escape}
                      </td>
                  </tr>
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Professional Data</span></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Work Experience</span></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span>Please list your last three positions in reverse chronological order starting with your current one. If all are in the same company, please give the major promotional sequence.</span></td>
				</tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Name of Company :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.company1|escape}
                      </td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Title / Position :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.position1|escape}
                      </td>
                </tr>
				
                  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">From :&nbsp;</td>
                    <td width="81%" align="left">
						<div style="float:left;">{$data.from1|escape}</div></td>
                  </tr>
				 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">To :&nbsp;</td>
                    <td width="81%" align="left">
						<div style="float:left;">{$data.to1|escape}</div></td>
                  </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Name of Company :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.company2|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Title / Position :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.position2|escape}</td>
                </tr>
				 
                  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">From :&nbsp;</td>
                    <td width="81%" align="left">
						<div style="float:left;">{$data.from2|escape}</div></td>
                  </tr>
				  
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">To :&nbsp;</td>
                    <td width="81%" align="left">
						<div style="float:left;">{$data.to2|escape}</div></td>
                  </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Name of Company :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.company3|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Title / Position :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.position3|escape}</td>
                </tr>
				
                  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">From :&nbsp;</td>
                    <td width="81%" align="left">
						<div style="float:left;">{$data.from3|escape}</div></td>
                  </tr>
				 
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">To :&nbsp;</td>
                    <td width="81%" align="left">
						<div style="float:left;">{$data.to3|escape}</div></td>
                  </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Please estimate total number of years of professional experience :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.numyearsexp|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Please describe your current responsibilities including your level in the organisation :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.responsibility|escape}</td>
                  </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Management Level :&nbsp;</td>
                    <td width="81%" align="left">{$data.mgtlevel|escape}
                      </td>
                  </tr>				  
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Specify Other :&nbsp;</td>
                    <td width="81%" align="left">{$data.mgtlevel_other|escape}
                      </td>
                  </tr>		
				  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Education</span></td>
				</tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">University :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.university|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Year :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.year|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Degree (Highest level attended) :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.degree|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="100%" colspan="2" align="left" valign="top" class="fieldtitle">If you have attended other REDC programmes, please list them below.&nbsp;</td>
                </tr>
				
				
				
				
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Programme :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.atndotherredcprog1|escape}</td>
                </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Date(MM/YYYY) :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.atndotherredcprogdate1|escape}</td>
                </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Programme :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.atndotherredcprog2|escape}</td>
                </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Date(MM/YYYY) :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.atndotherredcprogdate2|escape}</td>
                </tr>
				
			
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Objectives</span></td>
				</tr>
				<tr class="row2">
                    <td colspan="2" style="padding-left:5px;" class="fieldtitle">What are your objectives of attending this programme? What do you expect to achieve by the end of this programme. :&nbsp;</td>
				</tr>
				<tr>	
                    <td width="19%" align="right">&nbsp;</td>
					<td width="81%" align="left">
						{$data.objectives|escape}</td>
                  </tr>
				<tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Sponsorship and Invoicing</span></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">I have read and accepted all policies written in the brochure. I understand that upon completion and receipt of invoice, the organisation will become liable for all charges including cancellation and transfer charges, if applicable.</span></td>
				</tr>

				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Name :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.name|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Designation :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.designation|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Address :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.address|escape}</td>
                  </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Telephone :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.telephone|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Fax :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.sponsorfax|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Email :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.email|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Website :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.website|escape}</td>
                </tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Name and address to which invoice should be sent (if different from above)</span></td>
				</tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Name :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.invoicename|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Designation :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.invoicedesignation|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Address :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.invoiceaddress|escape}</td>
                  </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Telephone :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.invoicetelephone|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Fax :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.invoicefax|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Email :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.invoiceemail|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Website :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.invoicewebsite|escape}</td>
                </tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Executive Development (Person in charge of management development in your company)</span></td>
				</tr>

				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Name :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.executivename|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Designation :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.executivedesignation|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Address :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.executiveaddress|escape}</td>
                  </tr>
				
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Telephone :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.executivetelephone|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Fax :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.executivefax|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Email :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.executiveemail|escape}</td>
                </tr>
				<tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Website :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.executivewebsite|escape}</td>
                </tr>
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Do you wish to be informed about our programmes via email on regular basis? :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.informemail}
						</td>
                  </tr>
				  
				  <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Do you wish to avail residence at REC-LUMS during the programme? :&nbsp;</td>
                    <td width="81%" align="left">
						{$data.availresidence}
						</td>
                  </tr>
				  
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">Information Source</span></td>
				</tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">How did you learn about us? :&nbsp;</td>
                    <td width="81%" align="left">
					{$data.learnabout}
						</td>
                  </tr>	
				  
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Other :&nbsp;</td>
                    <td width="81%" align="left">
					{$data.learnabout_other}
						</td>
                  </tr>		
				  
				  			<!--   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">OEP Programmes :&nbsp;</td>
                    <td width="81%" align="left">
						
							{foreach from=$programme item='prog'}
								{if $prog.oepid eq $data.oepid}
									{$prog.name}
								{/if}
							{/foreach}
					  </td>
                  </tr>
				   <tr class="row2">
                    <td width="19%" align="right" valign="top" class="fieldtitle">Application Status :&nbsp;</td>
                    <td width="81%" align="left">
					
							{if $data.applicationstatus eq ''}  {/if}
							{if $data.applicationstatus eq 'A'}Approve {/if}
							{if $data.applicationstatus eq 'R'}Reject {/if}
					
                      </td>
                  </tr>-->
		                        
			  <tr><td colspan="2" height="5"></td></tr>
                  <tr>
                    <td colspan="2" align="center" valign="top" >
						  <table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td>
									  
									</td>
									
								  </tr>
							</table>

        			  </td>
                    </tr>
                                    
                </table>
			
			  </td>
            </tr>
            <tr>
              <td height="10" colspan="5" align="center"></td>
            </tr>
          </table>	
		  <tr>
            <td style="font-family: arial; color: rgb(184,184,184); font-size: 12px; padding-top: 8px">Tel: +92-42-35608333 Fax: +92-42-35722591<br />
            &copy; 2010 Rausing Executive Development Centre</td>
        </tr>
    </tbody>
</table>
  {/if}
</body>
</html>
