<?php 
	include("classlibrary/configuration.php");
	include("classlibrary/db.php");
	include 'function.resize.php';
	
	$dbobj = new db;
	$galleryid = $_REQUEST['catid'];
	$picsArray = null;
	if(is_numeric($galleryid))
	{
		$picsArray = $dbobj->select("select * from redc_vt_pictures where vtgid = $galleryid order by sort_index ASC");
	}
	$settings = array('w'=>730,'h'=>400,'crop'=>true);	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="<?=SITE_URL?>/js/jquery.js"></script>
<script type="text/javascript" src="<?=SITE_URL?>/js/easySlider1.5.js"></script>
<style type="text/css">

/*	body {
		background:#fff url(images/bg_body.gif) repeat-x;
		font:80% Trebuchet MS, Arial, Helvetica, Sans-Serif;
		color:#333;
		line-height:180%;
		margin:0;
		padding:0;
		text-align:center;
	}*/
/*	h1{
		font-size:180%;
		font-weight:normal;
		margin:0;
		padding:20px;
		}
	h2{
		font-size:160%;
		font-weight:normal;
		}	
	h3{
		font-size:140%;
		font-weight:normal;
		}	
*/img{
	border:none;
	width:730px;
	height:400px;

}
	
			
    /* image replacement */
        .graphic, #prevBtn, #nextBtn{
            margin:0;
            padding:0;
            display:block;
            overflow:hidden;
            text-indent:-8000px;
            }
    /* // image replacement */
			

	#container{	
		margin:0 auto;
		position:relative;
		text-align:left;
		width:696px;
		background:#fff;		
		margin-bottom:2em;
		}	
	#header{
		height:80px;
		background:#5DC9E1;
		color:#fff;
		}				
	#content{
		position:relative;
		}			

/* Easy Slider */

	#slider{
			border:solid 1px solid;
	}	
	#slider ul, #slider li{
		margin:0;
		padding:0;
		list-style:none;
		}
	#slider li{ 
		/* 
			define width and height of list item (slide)
			entire slider area will adjust according to the parameters provided here
		*/ 
		width:730px;
		height:400px;
		overflow:hidden; 
		}	
	#prevBtn, #nextBtn{ 
		display:block;
		width:30px;
		height:77px;
		position:absolute;
		left:1px;
		top:71px;
		}	
	#nextBtn{ 
		left:720px;
		}														
	#prevBtn a, #nextBtn a{  
		display:block;
		width:30px;
		height:77px;
		background:url(images/btn_prev.gif) no-repeat 0 0;	
		}	
	#nextBtn a{ 
		background:url(images/btn_next.gif) no-repeat 0 0;	
		}												

/* // Easy Slider */

</style>
<script type="text/javascript">
	$(document).ready(function(){	
		$("#slider").easySlider();
	});	
</script>
</head>
	<body bgcolor="#000000">
		<div id="slider">
			<ul>				
				<?php 
					if($picsArray != null){
						foreach($picsArray as $pic){
				?>
				<li>
					<img src="<?=SITE_URL?>/uploads/virtualtours/<?=$pic['imagefile']?>" alt="<?=$pic['description']?>" /> 
					<!--<img src='<?php //echo resize(SITE_URL."/uploads/virtualtours/".$pic['imagefile'],$settings)?>' alt="<? //=$pic['description']?>" border="0" /> -->
				</li>
				<? } }?>
			</ul>
		</div>
	</body>
</html>