<?php
class BookaTour extends db
{
    var $sql = null;
    var $tpl = null;
	var $pageview = null;
	var $error = null;
	var $tablename_book="travelhub_booked_tours";
	var $tablename="travelhub_tours";
	var $table_user="travelhub_users";
	var $table_content = "page_contents";
	var $table_cancel = "travelhub_cancel_tour";
	var $tablename_email = "site_emailcontent";
	var $table_country="travelhub_countries";

	var $table_site_activities="travelhub_activities";
	var $table_tour_activities="travelhub_tour_activities";

	var $table_state="travelhub_states";
	var $table_city="travelhub_city";
		
	
	
	function isValidForm($formvar)
	{
		// reset error message
		$this->error = null;
		
		if(isset($formvar['terms_condition']))
		  {
		  $this->error ='Please Read the Terms and conditions and check the box';
		  return false;
		  		  }
        		
      return true;
	}
	
	
	
    function BookaTour() {
		if($_SESSION['user_type'] != 'User')
		{
			$_SESSION['tour_id'] = $_POST['tour_id'];
			$_SESSION['quantity'] = $_POST['quantity'];
			$_SESSION['message'] = 'To book a tour you must register/login as a traveler.';
			header("location: login.php");
			exit;
		}
		$this->tpl =& new Smarty;
		$this->db();
    }
	function loadContent($pagename)
	{
   		$query = "select * from ".$this->table_content." where pagename = '".$pagename."'";
		$fetch = $this->select($query);
		if($fetch)
		{
		   $data['pagecontent'] = $fetch[0]['pagecontent'];
		   $data['pagetitle'] = $fetch[0]['pagetitle'];
		}
		return $data;	
	}
	
	function getConfigValue()
	{
	  $_query = "select * from travelhub_global_config";
	  $fetch=$this->select($_query);
		if($fetch)
		{
			$data=$fetch[0];
		}	
    	return $data;	   
	}
	function addBookingDetail($payment_method = '')
	{	   
	   if(isset($_SESSION['tour_id']) && $_SESSION['tour_id'] != "")
	   {
		 	$record['tour_id']=$this->mySQLSafe($_SESSION['tour_id']);
			$record['seats']=$this->mySQLSafe($_SESSION['quantity']);
			$record['traveller_id']=$this->mySQLSafe($_SESSION['user_id']);
			$record['total_price']=$this->mySQLSafe($_SESSION['total_price']);
			$record['amount_paid']=$this->mySQLSafe($_SESSION['advance_payment']);
			$record['percentage_applied']=$this->mySQLSafe($_SESSION['percentage_applied']);
			$record['booked_date']="now()";
			$record['status']="'Active'";
			if(isset($_SESSION['is_cancel_protected']) && $_SESSION['is_cancel_protected'])
			{
			  $record['is_cancel_protected']=$this->mySQLSafe($_SESSION['is_cancel_protected']);
			  $cancel_protection = $_SESSION['protection_amount']; //// used for email
			}
			else
			{
			  $cancel_protection = 0;  //// used for email
			}
			$record['protection_amount']=$this->mySQLSafe($_SESSION['protection_amount']);
			
			if($this->insert($this->tablename_book,$record) > 0 ) 
			{
				$used_payment = 0; ///// used for email
				$book_id = $this->insertid();
				$record_tour['seats_reserved']="seats_reserved+".$_SESSION['quantity'];
				$where = "tour_id = '".$_SESSION['tour_id']."'";
				if($this->update($this->tablename,$record_tour,$where))
				{
					if($payment_method == '' || isset($_SESSION['some_payment']))
					{
				       if(isset($_SESSION['some_payment']))
					   {
					      $record_cancel['amount']=$this->mySQLSafe($_SESSION['some_payment']);
						  $used_payment = $_SESSION['some_payment'];
					   }
					   else
					   {
					      $record_cancel['amount']=$this->mySQLSafe($_SESSION['advance_payment']);
						  $used_payment = $_SESSION['advance_payment'];
					   }  
					   $record_cancel['traveller_id']=$this->mySQLSafe($_SESSION['user_id']);
					   $record_cancel['is_used']="'Yes'";
					   $record_cancel['booked_id']="'".$book_id."'";
					   $record_cancel['tour_id']=$this->mySQLSafe($_SESSION['tour_id']);
					   $record_cancel['dated']="now()";
				       $this->insert($this->table_cancel,$record_cancel);
					}
				}
				
				$tour_detail = $this->getTourInfo($_SESSION['tour_id']);
				$start_date = explode("-",$tour_detail['tour_start_date']);
				$end_date = explode("-",$tour_detail['tour_end_date']);
				$start_date = date("d-m-Y",mktime(0,0,0,$start_date[1],$start_date[2],$start_date[0]));
				$end_date = date("d-m-Y",mktime(0,0,0,$end_date[1],$end_date[2],$end_date[0]));
				
				////// send mail to traveler///////////
				$query = "select * from ".$this->tablename_email." where emailname = 'Traveler Booking Tour Confirmation'";
				$fetch = $this->select($query);
				if($fetch){
					
					$from_mail = $fetch[0]['fromemail'];
					$subject = $fetch[0]['subject'];
					$content = $fetch[0]['content'];
				}
		        $content = str_replace('$$booking_id$$', $book_id, $content);
				$content = str_replace('$$tour_name$$', $tour_detail['tour_name'], $content);
				$content = str_replace('$$tour_company_name$$', $tour_detail['company_name'], $content);
				$content = str_replace('$$tour_duration$$', $tour_detail['tour_duration'], $content);
				$content = str_replace('$$tour_date$$', $start_date, $content);
				$content = str_replace('$$tour_country$$', $tour_detail['country_name'], $content);
				$content = str_replace('$$tour_state$$', $tour_detail['state_name'], $content);
				$content = str_replace('$$tour_city$$', $tour_detail['city_name'], $content);
				$content = str_replace('$$seats$$', $_SESSION['quantity'], $content);
				$content = str_replace('$$book_date$$', date("d-m-Y"), $content);
				$content = str_replace('$$total_tour_price$$', $_SESSION['total_price'], $content);
				$content = str_replace('$$deposit$$', $_SESSION['percentage_applied'], $content);
				$content = str_replace('$$deposit_amount_paid$$', $_SESSION['advance_payment']-$cancel_protection, $content);
				$content = str_replace('$$cancel_price$$', $cancel_protection, $content);
				$content = str_replace('$$amount_paid$$', $_SESSION['advance_payment'], $content);
				$content = str_replace('$$amount_to_be_paid$$', $_SESSION['total_price']-$_SESSION['advance_payment'], $content);
				$content = str_replace('$$mth_credit_used$$', $used_payment, $content);
		     
				$m= new Mail; 
				$m->From( $from_mail );
				$m->To( $_SESSION['email_address'] );
				$m->Subject( $subject );
				$m->Body( $content );
				$send_mail = $m->Send();
				
				////////// send mail to operator
				$query_opertaor = "select email_address from ".$this->table_user." where user_id ='".$toru_detail['operator_id']."' ";
				$fetch_operataor = $this->select($query_opertaor);
				if($fetch_operataor){
					
					$operator_mail = $fetch_operataor[0]['email_address'];
				}
				
				$query = "select * from ".$this->tablename_email." where emailname = 'Operator Booking Tour Confirmation'";
				$fetch = $this->select($query);
				if($fetch){
					
					$from_mail = $fetch[0]['fromemail'];
					$subject = $fetch[0]['subject'];
					$content = $fetch[0]['content'];
				}
		        $content = str_replace('$$booking_id$$', $book_id, $content);
		        $content = str_replace('$$tour_name$$', $tour_detail['tour_name'], $content);
				$content = str_replace('$$destination$$', $tour_detail['city_name'], $content);
				$content = str_replace('$$tour_date$$', $start_date." to ".$end_date, $content);
				$content = str_replace('$$tour_price$$', $tour_detail['tour_price'], $content);
				$content = str_replace('$$seats$$', $_SESSION['quantity'], $content);
				$content = str_replace('$$total_tour_price$$', $_SESSION['total_price'], $content);
				$content = str_replace('$$traveler_name$$', $_SESSION['first_name']." ".$_SESSION['last_name'], $content);
				$content = str_replace('$$traveler_email$$', $_SESSION['email_address'], $content);
			
		        $m= new Mail; 
				$m->From( $from_mail );
				$m->To( $operator_mail );
				$m->Subject( $subject );
				$m->Body( $content );
				$send_mail = $m->Send();
				
				unset($_SESSION['tour_id']);
				unset($_SESSION['quantity']);
				unset($_SESSION['total_price']);
				unset($_SESSION['advance_payment']);
				unset($_SESSION['percentage_applied']);
				unset($_SESSION['is_cancel_protected']);
				unset($_SESSION['protection_amount']);
				unset($_SESSION['some_payment']);					
				$_SESSION['message'] = "Your booking details have been sent to your email.";
				?>
				<script language="javascript" type="text/javascript">
				   window.location.href = "bookingdetail.php?booking_id=<?=$book_id?>&booking=yes";
				</script>
				<?
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
		    header("Location: index.php");
			exit;
		}	
	}
	
	function getTourInfo($tour_id)
	{
	    $where = " where t.tour_id = '".$tour_id."'";
        $_query = "select t.*,date_add(t.tour_start_date, INTERVAL t.tour_duration-1 DAY) tour_end_date,date_sub(concat(t.tour_start_date,' ',t.tour_time),INTERVAL 72 HOUR) remaining_days,u.company_name,c.name as country_name,s.state_name,cit.city_name from " . $this->tablename." t INNER JOIN ".$this->table_user." u ON (t.operator_id = u.user_id)  INNER JOIN ".$this->table_country." c ON (t.tour_country_id = c.country_id)  LEFT OUTER JOIN ".$this->table_state." s ON (t.tour_state_id = s.state_id) LEFT OUTER JOIN ".$this->table_city." cit ON (t.tour_city_id = cit.city_id) ". $where;
		
		$fetch=$this->select($_query);
		if($fetch)
		{
			$data=$fetch[0];
			
			echo $tour_id;
			$query = "Select t.*,a.activity_name from " .$this->table_tour_activities. " t, ".$this->table_site_activities." a where t.activity_id=a.id and t.tour_id = " . $tour_id;
            $fetch_act = $this->select($query);
//			$fetch[0]['activities'] = $fetch_act;
			$this->tpl->assign('activities', $fetch_act);
			
		}
		
		else
		{
			header("Location: tours.php");
			exit;
			$data=null;
		}
		
	 return $data;   
	}
	function calcCredit(){
			$_query = "select sum(amount), is_used from ".$this->table_cancel." where traveller_id=".$_SESSION['user_id']." group by is_used";
			$fetch=$this->select($_query);
			if($fetch!=false){
				$data = $fetch;
			}
			if($data[0]['is_used']=='Yes'){
				$credit = $data['1']['sum(amount)'] - $data['0']['sum(amount)'];
			} else {
				$credit = $data['0']['sum(amount)'] - $data['1']['sum(amount)'];
			}
	
	
			$credit = $credit<0 ? 0 : $credit ;
			return $credit;
	}
    function displayPage($data = array()) {

		global $GENERAL;
		
		$this->tpl->assign('pageview',$this->pageview);
		$this->tpl->assign('GENERAL', $GENERAL);
		$this->tpl->assign('data', $data);
		$this->tpl->assign('config', $this->getConfigValue());
		$this->tpl->assign('credit', $this->calcCredit());
        $this->tpl->display('bookatour.tpl');
    }
}
?>