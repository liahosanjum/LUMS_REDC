<?
	class Utility
	{
		var $imagetypes = array("image/jpeg", "image/jpg", "image/pjpeg", "image/gif", "image/x-png");
		var $videotypes = array("video/x-flv", "application/octet-stream");
		
		function Utility()
		{
		
		}
		
		function IsValidImage($filetype)
		{
			$isvalid = false;		
			for($i=0; $i<count($this->imagetypes); $i++)
			{
				if($this->imagetypes[$i] == $filetype)
				{
					$isvalid = true;
					break;
				}
			}
			return $isvalid;
		}
		
		function IsValidVideo($filetype)
		{
			$isvalid = false;		
			for($i=0; $i<count($this->videotypes); $i++)
			{
				if($this->videotypes[$i] == $filetype)
				{
					$isvalid = true;
					break;
				}
			}
			
			return $isvalid;
		}
		
		function CheckImageSize($filepath, $width, $height)
		{
			$isvalid = false;
			
			list($imgwidth, $imgheight) = getimagesize($filepath);	
			if($imgwidth == $width  && $imgheight == $height)
			{
				$isvalid = true;
			}
			return $isvalid;
		}
		
		function GetImageFileExtension($filetype)
		{
			$ext = false;		
			if($filetype == "image/jpeg" || $filetype == "image/jpg" || $filetype == "image/pjpeg")
			{
				$ext = ".jpg";
			}
			else if($filetype == "image/gif")
			{
				$ext = ".gif";
			}
			else if($filetype == "image/x-png")
			{
				$ext = ".png";
			}
			return $ext;
		}
		
		function GetVideoFileExtension($filetype)
		{
			$ext = false;		
			if($filetype == "video/x-flv")
			{
				$ext = ".flv";
			}
			return $ext;
		}
	}
?>