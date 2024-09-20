<?PHP
// inlclude the class-file
require_once( '../classlibrary/class.ConfigMagik.php');

// create new ConfigMagik-Object
$Config = new ConfigMagik( '../example.ini', true, true);
$Config->PROTECTED_MODE   = true;
$Config->SYNCHRONIZE      = false;


$role = ($_SESSION['usertype'] == 'A') ? "main_admin" : (($_SESSION['usertype'] == 'M') ? 'marketing_admin' : (($_SESSION['usertype'] == 'C') ? 'conference_admin' : null ));


	if($role && $role != 'main_admin')
	{
		$limits = $Config->get( 'Role', $role);
		$limits = explode("," , $limits);	
		$pgtmp  = explode("admin/" , $_SERVER['PHP_SELF']);
		$pg = explode(".php" , $pgtmp[1]);
		$pgname = $pg[0];
		if(!in_array($pgname , $limits))
		{
			echo "<script language='javascript'>";
			echo "window.location.href = 'welcome.php'";	
			echo "</script>";
		}
	}
	
?>