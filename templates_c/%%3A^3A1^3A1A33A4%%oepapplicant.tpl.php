<?php /* Smarty version 2.6.22, created on 2011-04-26 03:22:25
         compiled from /home/netrasof/public_html/clients/lums_redc/templates/oepapplicant.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/home/netrasof/public_html/clients/lums_redc/templates/oepapplicant.tpl', 21, false),)), $this); ?>

  <?php if ($this->_tpl_vars['pageview'] == 'detail'): ?>
 	<table cellspacing="0" cellpadding="0" width="100%" align="center">
    <tbody>
        <!--<tr>
            <td style="border-bottom: rgb(211,211,211) 1px solid; padding-bottom: 5px"><img alt="" src="<?php echo $this->_tpl_vars['GENERAL']['FRONT_IMG_URL']; ?>
/logo.jpg" /></td>
            <td align="right" style="border-bottom: rgb(211,211,211) 1px solid; padding-bottom: 5px"><img alt="" src="<?php echo $this->_tpl_vars['GENERAL']['FRONT_IMG_URL']; ?>
/redc.jpg" /></td>
        </tr>-->
        <tr>
            <td >

	 <table width="100%" cellspacing="5" cellpadding="0" border="0" >
            
            <tr>
              <td width="100%" valign="top" >
			 
					<table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tr class="row2">
                    <td width="24%" align="right" valign="top" class="fieldtitle">Name :&nbsp;</td>
                    <td width="76%" align="left">
					<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['firstname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['lastname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

					</td>
                  </tr> 
				  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Email :&nbsp;</td>
                    <td align="left">
					<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['busemail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

					</td>
                  </tr> 
				  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Previously Attended Programmes :&nbsp;</td>
                    <td align="left">
                    <?php $_from = $this->_tpl_vars['programmes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['programme']):
?>
					<?php echo $this->_tpl_vars['programme']['name']; ?>
<br />
                    <?php endforeach; endif; unset($_from); ?>
					</td>
                  </tr> 
				  
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th"><strong>Personal Data</strong></span></td>
				</tr>
                  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">First Name :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['firstname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                  </tr> 
                  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Middle Name :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['middlename'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                    </td>
                  </tr> 
                  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Last Name :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['lastname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                    </td>
                  </tr> 
				  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Prefix :&nbsp;</td>
                    <td align="left"><?php echo $this->_tpl_vars['data']['prefix']; ?>
</td>
                  </tr> 
				  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Gender :&nbsp;</td>
                    <td align="left">
						<?php echo $this->_tpl_vars['data']['gender']; ?>

					</td>
                  </tr>
				  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Natoinality :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['nationality'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                    </td>
                  </tr>
				  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Business Email :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['busemail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                    </td>
                  </tr>
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  

				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th">In case of emergency, please notify</span></td>
				</tr>  
				  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Name :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['emergencyname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                      <span class="required">&nbsp;</span></td>
                  </tr>
				  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Telephone :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['emergencyphone'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                    </td>
                  </tr>
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th"><strong>Contact Data</strong></span></td>
				</tr>
				   <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Designation :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['contactdesignation'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                    </td>
                  </tr>
				   <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Company/Organisation Name :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['companyname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                     </td>
                  </tr>
				   <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Parent Company Name (If different from company name) :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['companyother'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                     </td>
                  </tr>
				  
				   <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Organisation Address :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['companyaddress'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                     </td>
					</tr> 
				  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">City :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['city'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                    </td>
                  </tr>
				  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Country :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['countryname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                  </tr>
  				  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Telephone :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['ctelephone'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                  </tr>
				   <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Cell Number :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['cell'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                    </td>
                  </tr>
				   <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Fax Number :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['fax'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                     </td>
                  </tr>   
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th"><strong>Organisational Data</strong></span></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Your Parent Company/Organisation</span></td>
				</tr>
				
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Products/Services :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['parentservices'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                  </td>
                  </tr>
				   <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">No. of Employees :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['parentnumemployees'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                     </td>
                  </tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Your Company/Division</span></td>
				</tr>
				  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Products/Services :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['services'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                  </tr>
				   <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">No. of Employees :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['numemployees'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                     </td>
                  </tr>
				   <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">How many employees are under your supervision? :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['numemployeessupervision'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                     </td>
                  </tr>
				 
				  
				   <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">What is the title position of the person to whom you report? :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['reportperson'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                     </td>
					</tr> 
				   <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Please select your current industry :&nbsp;</td>
                    <td align="left">
				
							<?php echo $this->_tpl_vars['data']['industry']; ?>
 
						
                     </td>
                  </tr>
				   <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Specify Other :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['industryother'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                     </td>
                  </tr>
				  
				   <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">What function best describes your position :&nbsp;</td>
                    <td align="left">
					
						<?php echo $this->_tpl_vars['data']['position']; ?>

				</td>
                  </tr>
				   <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Specify Other :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['positionother'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                     </td>
                  </tr>
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th"><strong>Professional Data</strong></span></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Work Experience</span></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span>Please list your last three positions in reverse chronological order starting with your current one. If all are in the same company, please give the major promotional sequence.</span></td>
				</tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Name of Company :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['company1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                  </td>
                </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Title / Position :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['position1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                  </td>
                </tr>
				
                  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">From :&nbsp;</td>
                    <td align="left">
						<div style="float:left;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['from1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</div></td>
                  </tr>
				 
				  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">To :&nbsp;</td>
                    <td align="left">
						<div style="float:left;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['to1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</div></td>
                  </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Name of Company :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['company2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Title / Position :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['position2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				 
                  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">From :&nbsp;</td>
                    <td align="left">
						<div style="float:left;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['from2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</div></td>
                  </tr>
				  
				  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">To :&nbsp;</td>
                    <td align="left">
						<div style="float:left;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['to2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</div></td>
                  </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Name of Company :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['company3'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Title / Position :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['position3'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				
                  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">From :&nbsp;</td>
                    <td align="left">
						<div style="float:left;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['from3'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</div></td>
                  </tr>
				 
				  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">To :&nbsp;</td>
                    <td align="left">
						<div style="float:left;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['to3'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</div></td>
                  </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Please estimate total number of years of professional experience :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['numyearsexp'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Please describe your current responsibilities including your level in the organisation :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['responsibility'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                  </tr>
				
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Management Level :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['mgtlevel'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                  </td>
                  </tr>				  
				  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Specify Other :&nbsp;</td>
                    <td align="left"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']['mgtlevel_other'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                    </td>
                  </tr>		
				  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Education</span></td>
				</tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">University :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['university'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Year :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['year'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Degree (Highest level attended) :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['degree'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td width="100%" colspan="2" align="left" valign="top" class="fieldtitle">If you have attended other REDC programmes, please list them below.&nbsp;</td>
                </tr>
				
				
				
				
				
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Programme :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['atndotherredcprog1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Date(MM/YYYY) :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['atndotherredcprogdate1'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Programme :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['atndotherredcprog2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Date(MM/YYYY) :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['atndotherredcprogdate2'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				
			
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Objectives</span></td>
				</tr>
				<tr class="row2">
                    <td colspan="2" style="padding-left:5px;" class="fieldtitle">What are your objectives of attending this programme? What do you expect to achieve by the end of this programme. :&nbsp;</td>
				</tr>
				<tr>	
                    <td align="right">&nbsp;</td>
					<td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['objectives'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                  </tr>
				<tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th"><strong>Sponsorship and Invoicing</strong></span></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">I have read and accepted all policies written in the brochure. I understand that upon completion and receipt of invoice, the organisation will become liable for all charges including cancellation and transfer charges, if applicable.</span></td>
				</tr>

				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Name :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Designation :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['designation'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Address :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['address'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                  </tr>
				
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Telephone :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['telephone'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Fax :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['sponsorfax'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Email :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['email'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Website :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['website'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Name and address to which invoice should be sent (if different from above)</span></td>
				</tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Name :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['invoicename'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Designation :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['invoicedesignation'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Address :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['invoiceaddress'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                  </tr>
				
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Telephone :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['invoicetelephone'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Fax :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['invoicefax'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Email :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['invoiceemail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Website :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['invoicewebsite'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr>
					<td colspan="2" style="padding-left:5px;"><span style="font-weight:bold;">Executive Development (Person in charge of management development in your company)</span></td>
				</tr>

				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Name :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['executivename'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Designation :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['executivedesignation'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Address :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['executiveaddress'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                  </tr>
				
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Telephone :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['executivetelephone'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Fax :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['executivefax'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Email :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['executiveemail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				<tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Website :&nbsp;</td>
                    <td align="left">
						<?php echo ((is_array($_tmp=$this->_tpl_vars['data']['executivewebsite'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
                </tr>
				  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Do you wish to be informed about our programmes via email on regular basis? :&nbsp;</td>
                    <td align="left">
						<?php echo $this->_tpl_vars['data']['informemail']; ?>

					</td>
                  </tr>
				  
				  <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Do you wish to avail residence at REC-LUMS during the programme? :&nbsp;</td>
                    <td align="left">
						<?php echo $this->_tpl_vars['data']['availresidence']; ?>

					</td>
                  </tr>
				  
				  <tr>
					<td colspan="2" height="5"></td>
				  </tr>  
				<tr>
					<td colspan="2" style="padding-left:5px;"><span class="th"><strong>Information Source</strong></span></td>
				</tr>
				   <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">How did you learn about us? :&nbsp;</td>
                    <td align="left">
					<?php echo $this->_tpl_vars['data']['learnabout']; ?>

					 </td>
                  </tr>	
				  
				   <tr class="row2">
                    <td align="right" valign="top" class="fieldtitle">Other :&nbsp;</td>
                    <td align="left">
					<?php echo $this->_tpl_vars['data']['learnabout_other']; ?>

					 </td>
                  </tr>		
                                    
                </table>
			
			  </td>
            </tr>
          </table>	
		  <!--<tr>
            <td style="font-family: arial; color: rgb(184,184,184); font-size: 12px; padding-top: 8px">Tel: +92-42-35608333 Fax: +92-42-35722591<br />
            &copy; 2010 Rausing Executive Development Centre</td>
        </tr>-->
    </tbody>
</table>
  <?php endif; ?>