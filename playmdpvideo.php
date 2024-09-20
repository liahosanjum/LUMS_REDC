<?php 
	include("classlibrary/configuration.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="<?=SITE_URL?>/jscript/jquery.js"></script>
<script type="text/javascript" src="<?=SITE_URL?>/jscript/easySlider1.5.js"></script>
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
	width:450px;
	height:360px;

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
		width:450px;
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
			width:450px !important;
			height:350px !important;
	}	
	#slider ul, #slider li{
		margin:0;
		padding:0;
		list-style:none;
		}
	#slider li{ 
		width:450px !important;
		height:350px !important;
		overflow:hidden; 
		}	
	#prevBtn, #nextBtn{ 
		display:block;
		width:0px;
		height:0px;
		position:absolute;
		left:0px;
		top:0px;
		}	
	#nextBtn{ 
		left:0px;
		}														
	#prevBtn a, #nextBtn a{  
		display:block;
		width:0px;
		height:0px;
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
		<div id="slider" align="center">
			<ul>				
				
					
					<li>
						 <embed src="jarisplayer.swf"
						 flashvars="file=uploads/mdp.flv&alphalogo=80"
						 allowFullScreen="true"
						 width="450" 
						 height="350" 
						 name="fullscreen" 
						 align="middle" 
						 type="application/x-shockwave-flash" 
						 pluginspage="http://www.macromedia.com/go/getflashplayer" />
					</li>
				
			    
			</ul>
		</div>
	</body>
</html>