<?php
	  /***********
	  * Name :  createthumb
	  * Param:  orignal file full file, thumb file name, thumb width, thumb height.
	  * Purpose : 
	  ************/ 
	 function createthumb($name,$filename,$new_w,$new_h)
       {
			if (preg_match("/\\.jpg$/",strtolower($name))){$src_img=imagecreatefromjpeg($name);}
			if (preg_match("/\\.jpeg$/",strtolower($name))){$src_img=imagecreatefromjpeg($name);}
			if (preg_match("/\\.png$/",strtolower($name))){$src_img=imagecreatefrompng($name);}
			if (preg_match("/\\.gif$/",strtolower($name))){$src_img=imagecreatefromgif($name);}
			
			$old_x=imageSX($src_img);
			$old_y=imageSY($src_img);
			
						if ($old_x > $old_y) 
						{
							$rat = $old_y/$old_x*100;
							$thumb_w=min($new_w,$old_x);
							$thumb_h = floor($thumb_w * $rat / 100);
						}
						else
						{
							$rat = $old_x/$old_y*100;
							$thumb_h=min($new_h,$old_y);
							$thumb_w = floor($thumb_h * $rat / 100);
							
						}
		
						
			$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
			
			
			imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
			if (preg_match("/\\.png$/",strtolower($name)))
			{
				imagepng($dst_img,$filename); 
			} else if (preg_match("/\\.jpg$/",strtolower($name)) || preg_match("/\\.jpeg$/",strtolower($name)) ) {
				imagejpeg($dst_img,$filename); 
			}else if (preg_match("/\\.gif$/",strtolower($name))) {
				imagegif($dst_img,$filename); 
			}
			imagedestroy($dst_img); 
			imagedestroy($src_img); 
	   }//end function
?>