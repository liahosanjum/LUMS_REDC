<?php

require_once('classlibrary/publicconfigsmarty.php');
include("classlibrary/sendemail.php");


require_once($GENERAL['FRONT_DIR_LIB'].'/apply.lib.php');


//mail("bilal@netrasofttech.com" , "testing" , "this is testing email") or die("not sent"); 

$controller =& new Apply;

/*
if(!isset($_SESSION['alumniuser']))
{
 	header("Location:alumni_login.php");	
}
*/


/*
if(isset($_POST) && $_POST != null )
{
	echo "<pre>";
	var_export($_POST);
	echo "</pre>";
	exit;
}
*/

if(isset($_REQUEST['exitfooter']) && $_REQUEST['exitfooter'] != "")
{
	$_REQUEST['action'] = "exit";
}

$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';
$_start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '0';

switch($_action) {

	case 'create':
		$controller->pageview="create";	
		$controller->steps="contact";	
		
		if(isset($_POST['state']) && $_POST['state'] == 'submit')
		{
			if($controller->isValidCreateForm($_POST))
			{
				if($controller->addEntry($_POST))
				{
					$controller->sendEmail($_POST , 1 , MAILSERVER);
					$controller->redirect();
					// set session variable and redirect to applyonline page
				}
			}		
		}
		
		$controller->displayGird($_REQUEST);
	break;


/***********************************************/
	case 'submit':
		
		$controller->pageview="display";	
		/*
		$controller->steps="contact";	
		*/
		if($controller->isValidForm($_POST))
		{
			
			if($controller->addEntry($_POST))
			{
				$controller->steps=$_POST['next_steps'];		
				//$controller->sendEmail($_POST , 1 , MAILSERVER);
				//$controller->redirect();
				// set session variable and redirect to applyonline page
			}
			$controller->displayGird($controller->editEntry());
		}
		else
		{
			$controller->steps=$_POST['steps'];	
			$controller->displayGird($_POST);
		}		
		
		
	break;

	 case 'incomplete':
    	$controller->pageview="incomplete";
		$controller->displayGird($controller->loadIncompleteData($_REQUEST));
	 break;   

/************************************************/


    case 'exit':

		$count = $controller->countUserIncompleteApplication();
    	if($controller->oepaid == "")
		{
			if($count)
			{
				if($count > 1)
				{
					$controller->deleteIncompleteApp();
				}
				
			}
		}
		else
		{
			
			$controller->countUserIncompleteWithoutCurrent();
			if($controller->countUserIncompleteWithoutCurrent())
			{
				$controller->deleteIncompleteAppWithoutCurrent();
			}	
								
		}
		$controller->sess_exp_redirect();
	 break;   


/***********************************************/

	case 'submitfinal':
		
		$controller->pageview="display";	
		if($controller->isValidForm($_POST))
		{	
			if($controller->addEntry($_POST))
			{
				
				$controller->updateAppstatusToComplete();
				$controller->steps=$_POST['next_steps'];		
				$controller->sendEmail($_POST , 2 , MAILSERVER);
			}
			$controller->displayGird($array = array());
		}
		else
		{
			$controller->steps=$_POST['steps'];	
			$controller->displayGird($_POST);
		}	
	break;


/***********************************************/

    case 'back':
							
		if(isset($_POST['prev_steps']) && $_POST['prev_steps'] != "")
		{
			$controller->steps=$_POST['prev_steps'];
		}
		else
		{
			$controller->steps="personal";		
		}
		$controller->pageview="display";
		$controller->displayGird($controller->editEntry());
						
	break;   


/***********************************************/

    case 'view':
    default:

    	
		
		
		if($controller->oepaid == "")
		{
			
					/****/
					
					$count = $controller->countUserIncompleteApplication();
					
					if($count)
					{
						if($count > 1)
						{
							$controller->deleteIncompleteApp();
						}
						
					}
		
					
					/***/
			
			
			
					if($controller->alreadyapplied())
					{
						$controller->steps="incomplete";		
						$controller->pageview="display";
						$controller->displayGird($array = array());
					}
					else
					{
						$prevSavedData = $controller->getAllData();
						
							if($prevSavedData != null)
							{
								if($prevSavedData[0]['information'] != "")
								{
									$controller->steps="information";			
								}
								else if($prevSavedData[0]['sponsorship'] != "")
								{
									$controller->steps="sponsorship";			
								}
								else if($prevSavedData[0]['professional'] != "")
								{
									$controller->steps="professional";			
								}
								else if($prevSavedData[0]['organizational'] != "")
								{
									$controller->steps="organizational";			
								}	
								else if($prevSavedData[0]['contact'] != "")
								{
									$controller->steps="contact";			
								}
								else
									$controller->steps="personal";						
								
							}
							else
							{
								$controller->steps="personal";		
							}
						$controller->pageview="display";
						$controller->displayGird($array = array());
					}
					
					
		}
		else
		{
					
					
					/**************************************/
						//$controller->countUserIncompleteWithoutCurrent();
						if($controller->countUserIncompleteWithoutCurrent() >  0)
						{
							$controller->deleteIncompleteAppWithoutCurrent();
						}	
					/**************************************/
				
				
						
						if(isset($_POST['next_steps']) && $_POST['next_steps'] != "")
						{
							$controller->steps=$_POST['next_steps'];
							
						}
						else
						{
							
							$prevSavedData = $controller->getAllData();
							
							
							if($prevSavedData != null)
							{
								
								if($prevSavedData[0]['information'] != "")
								{
									$controller->steps="information";			
								}
								else if($prevSavedData[0]['sponsorship'] != "")
								{
									$controller->steps="sponsorship";			
								}
								else if($prevSavedData[0]['professional'] != "")
								{
									$controller->steps="professional";			
								}
								else if($prevSavedData[0]['organizational'] != "")
								{
									$controller->steps="organizational";			
								}	
								else if($prevSavedData[0]['contact'] != "")
								{
									$controller->steps="contact";			
								}
								else
									$controller->steps="personal";						
								
							}
							else
							{
								
								$controller->steps="personal";		
							}
						}
						
						$controller->pageview="display";
						
						$controller->displayGird($controller->editEntry());
						
		}
	 break;   


}

?>