<?php
require('../config.php');
$sql = "SELECT * FROM retention.consolidation_template 
		WHERE consolidation_template.consolidation_template_id = '".$_POST['id']."'";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	$row = mysqli_fetch_array($data);
	$s = "SELECT * FROM retention.sex WHERE sex.sex_id IN(".$row['sex'].")";
	$d = mysqli_query($link,$s);
	if(mysqli_num_rows($d)>0){
		while($r = mysqli_fetch_array($d)){
			echo $r['sex']."<br>";
		}
	}else{
		
	}
}else{
	
}
mysqli_close($link);
?>