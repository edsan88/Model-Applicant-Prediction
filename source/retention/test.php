<?php
 $rating_percentage = '0.00,0.00,2.45,2.45,1.50,0.00';
 $temp = explode(",",$rating_percentage);
 
 $maxs = array_keys($temp, max($temp));
 ////print_r($maxs);
 $ideal = 4; 
 for($x=0;$x<count($maxs);$x++){
	 // if($ideal == $maxs[$x]){
		 echo $maxs[$x]."<hr>";
	 // }else
 }
?>