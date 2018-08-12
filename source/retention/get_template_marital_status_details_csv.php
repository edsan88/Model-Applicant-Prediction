<?php
require('../config.php');
$sql = "SELECT * FROM retention.consolidation_template 
		WHERE consolidation_template.consolidation_template_id = '".$_POST['id']."'";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	$row = mysqli_fetch_array($data);
	$s = "SELECT * FROM retention.marital_status WHERE marital_status.marital_status_id IN(".$row['marital_status'].")";
	$d = mysqli_query($link,$s);
	if(mysqli_num_rows($d)>0){
		while($r = mysqli_fetch_array($d)){
			echo $r['marital_status'].",";
		}
	}else{
		
	}
}else{
	
}
mysqli_close($link);
?>