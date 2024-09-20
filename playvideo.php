<?php 
	include("classlibrary/configuration.php");
	include("classlibrary/db.php");
	$dbobj = new db;
	$picsArray = null;

		$videoArray = $dbobj->select("select * from redc_oep_podcast where enabled='Y'");
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="javascript" type="text/javascript">
var countImages = '<?php echo count($videoArray);?>';
</script>
<script type="text/javascript" src="<?=SITE_URL?>/js/jquery.js"></script>
<script type="text/javascript" src="<?=SITE_URL?>/js/easySlider1.5-2.js"></script>
<style type="text/css">
.selected
{
	padding: 2px;
	border: 1px solid #ffffff;
}

.simple
{
	border: none;
}

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
		width:350px;
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
					margin-left: 60px;
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
		width:350px;
		height:120px;
		overflow:hidden; 

		}	
	#prevBtn, #nextBtn{ 
		display:block;
		width:30px;
		height:77px;
		position:absolute;
		margin-top: 15px;
		left:1px;
		top:71px;
		}	
	#nextBtn{ 
		left:420px;
		}	
		
	#prevBtn{ 
		margin-left:30px;
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
		
		
		.lnkVideo
		{
			text-decoration:none;
			color:#FFFFFF;
			text-align:center;
			font-family:verdana;
			font-size:11px;
		}
		/* // Easy Slider */
</style>
<script type="text/javascript">
	$(document).ready(function(){	
		$("#slider").easySlider();

		if(countImages <= 3)
		{
			$("#nextBtn").hide();
		}
	});	
	
	function showVideo(video, img)
	{
		path = "file=uploads/podcasts/" + video + "&alphalogo=80";
		
		divFLV = '<embed src="jarisplayer.swf"' + 
						 'flashvars="' + path + '"' + 
						 'allowFullScreen="true"' +
						 'width="450" ' +
						 'height="350" ' +
						 'name="fullscreen" ' +
						 'align="middle" ' +
						 'type="application/x-shockwave-flash" ' +
						 'pluginspage="http://www.macromedia.com/go/getflashplayer" />';
						 
		document.getElementById('divVideo').innerHTML = divFLV;
		
		$('img').attr('class', 'simple');
		$('#' + img).attr('class', 'selected');
	}
</script>
</head>
	<body bgcolor="#000000">
		<div align="center" id="divVideo">
			<embed src="jarisplayer.swf"
						 flashvars="file=uploads/podcasts/<?=$videoArray[0]['pvideo']?>&alphalogo=80"
						 allowFullScreen="true"
						 width="450" 
						 height="350" 
						 name="fullscreen" 
						 align="middle" 
						 type="application/x-shockwave-flash" 
						 pluginspage="http://www.macromedia.com/go/getflashplayer" />
		</div>
		<br />
		<div style="clear:both" id="slider">
			<ul>
			<li>
			
			<?php
			$class = "";
			$first = "";
			for($i=0; $i<count($videoArray); $i++)
			{
				if($i > 0 && $i % 3 == 0)
				{
					echo "</li><li>";
				}
				if(($_GET['id'] == null || $_GET['id'] == "") && $i == 0)
				{
					$first = "selected";
				}
				else
				{
					$first = "";
					if($_GET['id'] == $videoArray[$i]['podcastid'])
					{
						$class="selected";
					}
					else
					{
						$class="simple";
					}
				}
			?>
				<div style="float:left; margin-right:10px; "><a title="<?=$videoArray[$i]['title']?>" href="javascript:showVideo('<?=$videoArray[$i]['pvideo']?>', 'img<?=$videoArray[$i]['podcastid']?>');" class="lnkVideo" ><img title="<?=$videoArray[$i]['title']?>" id="img<?=$videoArray[$i]['podcastid']?>" class="<?=$class?> <?=$first?>" src="uploads/podcasts/<?=$videoArray[$i]['pimage']?>" width="100" height="100" alt="<?=$videoArray[$i]['title']?>" /></a></div>
			<?php
			}
			?>
			</li>
	    	</ul>
		</div>
	</body>
</html>