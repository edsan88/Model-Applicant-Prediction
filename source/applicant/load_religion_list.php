<?php
require('../config.php');
$sql = "SELECT * FROM jserp_hrdo.religion";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$temp[] = array("id"=>strtoupper($row['religionName']),
						"val"=>strtoupper($row['religionName']));
	}
	echo json_encode($temp);
}else{
	
}
mysqli_close($link);
?>