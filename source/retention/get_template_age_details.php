<?php
require('../config.php');
$sql = "SELECT * FROM retention.consolidation_template 
		WHERE consolidation_template.consolidation_template_id = '".$_POST['id']."'";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	$row = mysqli_fetch_array($data);
	$age = explode(",",$row['age']);
	$s = "SELECT * FROM retention.age
			WHERE age.age >= '".$age[0]."'
			AND age.age <= '".$age[1]."'";
	$d = mysqli_query($link,$s);
	if(mysqli_num_rows($d)>0){
		while($r = mysqli_fetch_array($d)){
			echo $r['age']."<br>";
		}
	}else{
		
	}
}else{
	
}
mysqli_close($link);
?>