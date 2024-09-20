<?
	function CheckAuthorization()
	{
		
		if(!isset($_SESSION['username']))
		{
			$url = $_SERVER['PHP_SELF']  ;
				$url = urlencode($url);
				
				if(isset($_SERVER["QUERY_STRING"]))
				{
					$querystring = $_SERVER["QUERY_STRING"];
					$querystring = urlencode($querystring);
					$returnValue = "returnURL=" . $url . "?". $querystring;						
				}
				else
				{
					$returnValue = "returnURL=" . $url ;						
				}
				
				header("Location:login.php?".$returnValue);
		}
	}			
	CheckAuthorization();

?>