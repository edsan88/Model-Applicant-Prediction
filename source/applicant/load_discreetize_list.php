<?php
	$temp[0] = array("id"=>0,"val"=>"SELECT ALL");
	$divisor = 100/$_GET['val'];
	for($x=0;$x<$_GET['val'];$x++){
		$temp[$x+1] = array("id"=>$x+1,"val"=>($x * $divisor)."-".(($x * $divisor)+$divisor));
	}
	echo json_encode($temp);
 //if($_GET['val'] ==)
?>