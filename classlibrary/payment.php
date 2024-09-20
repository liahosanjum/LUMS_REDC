<?php 
require("lib.xml.php");
class Payment
{
  function doPayment($request_var)
   {	
		$request_var['ip_address'] = $_SERVER['REMOTE_ADDR'];
		if($request_var['states'] == '')
		{
		   $request_var['states'] = 'No State';
		}
		$endpoint = "https://test.trans01.pacificpaysystems.net/webservices/transaction.asmx";
		$field_strings= "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
		$field_strings .= "<soap:Envelope xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" ";
		$field_strings.= "xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" ";
		$field_strings.= "xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\">";
		$field_strings.= "<soap:Body>";
		$field_strings.= "<AuthorizeCapture xmlns=\"https://trans01.pacificpaysystems.net/webservices/\">";
		$field_strings.= "<obj>";
		$field_strings.= "<BillingAddress>".$request_var['billing_address']."</BillingAddress>";
		$field_strings.= "<BillingCity>".$request_var['billing_city']."</BillingCity>";
		$field_strings.= "<BillingStateProvince>".$request_var['states']."</BillingStateProvince>";
		$field_strings.= "<BillingPostalCode>".$request_var['billing_zip']."</BillingPostalCode>";
		$field_strings.= "<BillingCountry>".$request_var['country']."</BillingCountry>";
		$field_strings.= "<ShippingAddress>".$request_var['billing_address']."</ShippingAddress>";
		$field_strings.= "<ShippingCity>".$request_var['billing_city']."</ShippingCity>";
		$field_strings.= "<ShippingStateProvince>".$request_var['states']."</ShippingStateProvince>";
		$field_strings.= "<ShippingPostalCode>".$request_var['billing_zip']."</ShippingPostalCode>";
		$field_strings.= "<ShippingCountry>".$request_var['country']."</ShippingCountry>";
		$field_strings.= "<CustomerFirstName>".$request_var['first_name']."</CustomerFirstName>";
		$field_strings.= "<CustomerLastName>".$request_var['last_name']."</CustomerLastName>";
		$field_strings.= "<CustomerIP>".$request_var['ip_address']."</CustomerIP>";
		$field_strings.= "<CustomerEmail>".$request_var['email']."</CustomerEmail>";
		$field_strings.= "<CustomerPhone>".$request_var['phone']."</CustomerPhone>";
		$field_strings.= "<CreditCardNumber>".$request_var['card_code']."</CreditCardNumber>";
		$field_strings.= "<ExpirationMonth>".$request_var['validity_Month']."</ExpirationMonth>";
		$field_strings.= "<ExpirationYear>".$request_var['validity_Year']."</ExpirationYear>";
		$field_strings.= "<CreditCardCVVCode>".$request_var['card_cvs']."</CreditCardCVVCode>";
		$field_strings.= "<MerchantID>3000043</MerchantID>";
		$field_strings.= "<TerminalID>4000058</TerminalID>";
		$field_strings.= "<MerchantVerificationCode>k1m2d3eewmi93</MerchantVerificationCode>";
		$field_strings.= "<TransactionAmount>".$request_var['total_price']."</TransactionAmount>";
		$field_strings.= "<Currency>".$request_var['currency']."</Currency>";
		$field_strings.= "</obj>";
		$field_strings.= "</AuthorizeCapture>";
		$field_strings.= "</soap:Body>";
		$field_strings.= "</soap:Envelope>";
		
		$session = curl_init($endpoint); // create acurl session
		
		curl_setopt($session, CURLOPT_POST, true); // POST request type
		curl_setopt($session, CURLOPT_POSTFIELDS, $field_strings); // set the body of the POST
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true); // return values as a string - not to std out
		curl_setopt($session,CURLOPT_SSL_VERIFYPEER,0);
		$headers = array(
		'SOAPAction: https://trans01.pacificpaysystems.net/webservices/AuthorizeCapture',
		'Content-Type: text/xml;charset=utf-8',
		);
		curl_setopt($session, CURLOPT_HTTPHEADER, $headers); //set headers using the above array of headers
		
		$responseXML = curl_exec($session); // send the request
		//echo curl_errno($session);
		//echo curl_error($session);
		curl_close($session);
	    
		$xml = new Xml;
        $out = $xml->parse($responseXML, NULL);
        return $out['soap:Body']['AuthorizeCaptureResponse']['AuthorizeCaptureResult'];
	
  }	
}	
?>