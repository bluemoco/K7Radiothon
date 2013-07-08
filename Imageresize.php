<?php 
class SimpleImage {
 
   var $image;
   var $image_type;
 
   function load($filename) {
 
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
 
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
 
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
 
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=100, $permissions=null) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
 
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image);
      }
   }
   function getWidth() {
 
      return imagesx($this->image);
   }
   function getHeight() {
 
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
 
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
 
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
 
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
 
   function resizewithoutscale($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }      
	 
	 
  function resize($box_w, $box_h, $r = 255, $g = 255, $b = 255){
	 
		$background = ImageCreateTrueColor($box_w, $box_h);
		$color = imagecolorallocate($background, $r, $g, $b);
		imagefill($background, 0, 0, $color);
		
		$w = imagesx($this->image);
		$h = imagesy($this->image);
		$ratio=$w/$h;
		$target_ratio=$box_w/$box_h;
		if ($ratio>$target_ratio){
			$new_w=$box_w;
			$new_h=round($box_w/$ratio);
			$x_offset=0;
			$y_offset=(($box_h-$new_h)/2);
		}else {
			$new_h=$box_h;
			$new_w=round($box_h*$ratio);
			$x_offset =(($box_w-$new_w)/2);
			$y_offset=0;
		}
		$new_image = imagecreatetruecolor($box_w, $box_h);
		imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $new_w, $new_h, $this->getWidth(), $this->getHeight());
		imagecopymerge($background,$new_image,$x_offset,$y_offset,0,0,$new_w,$new_h,100);
		  
    $this->image = $background;
	}
 
}
?>