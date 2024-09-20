<?php

			//**	RGB IMAGE TO GRAYSCALE IMAGE   **//
			
			
		function rgb2Grayscale($src , $newfile)
		{
			$file_src  = $src; // complete path of existing jpeg
			$nfilename = $newfile; // new file name
			$im = imagecreatefromjpeg($file_src);
			$imw = imagesx($im); // get image width
			$imh = imagesy($im); // get image height
			for($i = 0; $i < $imw; $i++)
			{
				for($j = 0; $j < $imh; $j++)
				{
					$rgb = imagecolorat($im , $i , $j); // extract color value from each pixel
					$rr = ($rgb >> 16) & 0xFF; // extract red color value
					$gg = ($rgb >> 8) & 0xFF; // extract green color value
					$bb = $rgb & 0xFF; 		 // extract blue color value
					$g = round(($rr + $gg + $bb) / 3); // get average value of rgb 
					$val = imagecolorallocate($im , $g , $g , $g); // grayscale value
					imagesetpixel($im , $i , $j , $val); // set new graycolor value at each pixel
				}
			}
			
			header("Content-type: image/jpeg"); // set content type image for header 
			imagejpeg($im , $nfilename , 10); // save new grayscale image
		} // end function
		

			//**	WRITE TEXT ON IMAGE   **//		
		
		function imgText()
		{
			$im = imagecreate(100 , 100);
			$bg = imagecolorallocate($im, 0, 0, 0);
			$black = imagecolorallocate($im, 255, 255, 255);
			$string = "Bilal Khan";
			$font_size = 5;
			
			for($i = 0; $i < strlen($string); $i++)
			{
				imagechar($im, $font_size, ($i * imagefontwidth($font_size)), rand(0 , imagefontheight($font_size)), $string, $black);
				$string = substr($string , 1);
			}	
			
			header("Content-type: image/png"); // set content type image for header 
			imagepng($im); // save new grayscale image
		}
		//imgText();
		
		function imgTxt()
		{
			
			//$string = '1 2 3 4 5 6 7 8 9 A B C D E F G';
			$string = 'B I L A L    K H A N';
			$font_size = 5;
			$width=imagefontwidth($font_size)*strlen($string);
			$height=imagefontheight($font_size)*2;
			$img = imagecreate($width,$height);
			$bg = imagecolorallocate($img,225,225,225);
			$black = imagecolorallocate($img,0,0,0);
			$len=strlen($string);
			
			for($i=0;$i<$len;$i++)
			{
				$xpos=$i*imagefontwidth($font_size);
				$ypos=rand(0,imagefontheight($font_size));
				imagechar($img,$font_size,$xpos,$ypos,$string,$black);
				$string = substr($string,1);   
			   
			}
			header("Content-Type: image/gif");
			imagegif($img);
			imagedestroy($img);
		
		}
		//imgTxt();
		
		function imgString()
		{
			// Create a 100*30 image
			$im = imagecreate(100, 30);
			
			// White background and blue text
			$bg = imagecolorallocate($im, 255, 255, 255);
			$textcolor = imagecolorallocate($im, 0, 0, 255);
			
			// Write the string at the top left
			imagestring($im, 5, 0, 0, 'Hello world!', $textcolor);
			
			// Output the image
			header('Content-type: image/png');
			
			imagepng($im);
			imagedestroy($im);
		}
		//imgString();	
		
				
		/**
		HSL/RGB conversion functions
		very useful for a lot of applications
		**/
		
		function RBGtoHSL ( $R, $G, $B )
		{
		
			$var_R = ( $R / 255 );
			$var_G = ( $G / 255 );
			$var_B = ( $B / 255 );
		
			$var_Min = min( $var_R, $var_G, $var_B )
			$var_Max = max( $var_R, $var_G, $var_B )
			$del_Max = $var_Max - $var_Min
		
			$L = ( $var_Max + $var_Min ) / 2;
		
			if ( $del_Max == 0 )
			{
			   $H = 0
			   $S = 0
			}
			else
			{
				if ( $L < 0.5 )
				{
					$S = $del_Max / ( $var_Max + $var_Min );
				}
				else
				{
					$S = $del_Max / ( 2 - $var_Max - $var_Min );
				}
		
				$del_R = ( ( ( $var_Max - $var_R ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;
				$del_G = ( ( ( $var_Max - $var_G ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;
				$del_B = ( ( ( $var_Max - $var_B ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;
		
				if ( $var_R == $var_Max )
				{
					$H = $del_B - $del_G;
				}
				else if ( $var_G == $var_Max )
				{
					$H = ( 1 / 3 ) + $del_R - $del_B;
				}
				else if ( $var_B == $var_Max )
				{
					$H = ( 2 / 3 ) + $del_G - $del_R;
				}
		
				if ( $H < 0 )
				{
					$H += 1;
				}
				if ( $H > 1 )
				{
					$H -= 1
				}
		
			}
		
			return array( $H, $S, $L );
		
		}
		
		function HuetoRGB( $v1, $v2, $vH )
		{
			if ( $vH < 0 )
			{
				$vH += 1;
			}
			if ( $vH > 1 )
			{
				$vH -= 1;
			}
			if ( ( 6 * $vH ) < 1 )
			{
				return ( $v1 + ( $v2 - $v1 ) * 6 * $vH );
			}
			if ( ( 2 * $vH ) < 1 )
			{
				return ( $v2 );
			}
			if ( ( 3 * $vH ) < 2 )
			{
				return ( $v1 + ( $v2 - $v1 ) * ( ( 2 / 3 ) - $vH ) * 6 );
			}
			return ( $v1 )
		}
		
		function HSLtoRGB ( $H, $S, $L )
		{
		
			if ( $S == 0 )
			{
				$R = $L * 255;
				$G = $L * 255;
				$B = $L * 255;
			}
			else
			{
				if ( $L < 0.5 )
				{
					$var_2 = $L * ( 1 + $S );
				}
				else
				{
					$var_2 = ( $L + $S ) - ( $S * $L );
				}
		
				$var_1 = 2 * $L - $var_2;
		
				$R = 255 * HuetoRGB( $var_1, $var_2, $H + ( 1 / 3 ) );
				$G = 255 * HuetoRGB( $var_1, $var_2, $H );
				$B = 255 * HuetoRGB( $var_1, $var_2, $H - ( 1 / 3 ) );
			}
		
			return array( $R, $G, $B );
		
		}	

		function distance ( $R1, $G1, $B1, $R2, $G2, $B2 )
		{
			$result = sqrt ( ( $R1 - $R2 )*( $R1 - $R2 ) + ( $G1 - $G2 )*( $G1 - $G2 ) + ( $B1 - $B2 )*( $B1 - $B2 ) );
			return ( $result );
		}	
?>