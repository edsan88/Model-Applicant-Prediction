<?php
require('../config.php');
if($_GET['id'] == 1){
	$sql = "SELECT * FROM retention.sex";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			$temp[] = array("id"=>strtoupper($row['sex']),
							"name"=>strtoupper($row['sex']));
		}
		echo json_encode($temp);
	}else{
		
	}
}else if($_GET['id'] == 2){
	$sql = "SELECT * FROM jserp_hrdo.civilstatus";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			$temp[] = array("id"=>strtoupper($row['civilStatusName']),
							"name"=>strtoupper($row['civilStatusName']));
		}
		echo json_encode($temp);
	}else{
		
	}
}else if($_GET['id'] == 3){
	$sql = "SELECT * FROM retention.refcitymun";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			$temp[] = array("id"=>strtoupper($row['citymunDesc']),
							"name"=>strtoupper($row['citymunDesc']));
		}
		echo json_encode($temp);
	}else{
		
	}
}else if($_GET['id'] == 4){
	$sql = "SELECT * FROM retention.refprovince";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			$temp[] = array("id"=>strtoupper($row['provDesc']),
							"name"=>strtoupper($row['provDesc']));
		}
		echo json_encode($temp);
	}else{
		
	}
}else if($_GET['id'] == 5){
	$sql = "SELECT * FROM jserp_hrdo.citizenship";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			$temp[] = array("id"=>strtoupper($row['citizenship']),
							"name"=>strtoupper($row['citizenship']));
		}
		echo json_encode($temp);
	}else{
		
	}
}else if($_GET['id'] == 6){
	$temp[0] = array('id'=>0,'name'=>"Less than 1 Year");
	$temp[1] = array('id'=>1,'name'=>"1 Year");
	$temp[2] = array('id'=>2,'name'=>"2 Years");
	$temp[3] = array('id'=>3,'name'=>"3 Years");
	$temp[4] = array('id'=>4,'name'=>"4 Years");
	$temp[5] = array('id'=>5,'name'=>"5 Years");
	$temp[6] = array('id'=>6,'name'=>"6 Years");
	$temp[7] = array('id'=>7,'name'=>"7 Years");
	$temp[8] = array('id'=>8,'name'=>"8 Years");
	$temp[9] = array('id'=>9,'name'=>"9 Years");
	$temp[10] = array('id'=>10,'name'=>"10 Years");
	$temp[11] = array('id'=>11,'name'=>"11 Years");
	$temp[12] = array('id'=>12,'name'=>"12 Years");
	$temp[13] = array('id'=>13,'name'=>"13 Years");
	$temp[14] = array('id'=>14,'name'=>"14 Years");
	$temp[15] = array('id'=>15,'name'=>"15 Years");
	$temp[16] = array('id'=>16,'name'=>"16 Years");
	$temp[17] = array('id'=>17,'name'=>"17 Years");
	$temp[18] = array('id'=>18,'name'=>"18 Years");
	$temp[19] = array('id'=>19,'name'=>"19 Years");
	$temp[20] = array('id'=>20,'name'=>"20 Years");
	$temp[21] = array('id'=>21,'name'=>"21 Years");
	$temp[22] = array('id'=>22,'name'=>"22 Years");
	$temp[23] = array('id'=>23,'name'=>"23 Years");
	$temp[24] = array('id'=>24,'name'=>"24 Years");
	$temp[25] = array('id'=>25,'name'=>"25 Years");
	$temp[26] = array('id'=>26,'name'=>"26 Years");
	$temp[27] = array('id'=>27,'name'=>"27 Years");
	$temp[28] = array('id'=>28,'name'=>"28 Years");
	$temp[29] = array('id'=>29,'name'=>"29 Years");
	$temp[30] = array('id'=>30,'name'=>"30 Years");
	echo json_encode($temp);
}else if($_GET['id'] == 7){
	$sql = "SELECT * FROM jserp_accounting.sadepartment";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			$temp[] = array("id"=>strtoupper($row['saDeptName']),
							"name"=>strtoupper($row['saDeptName']));
		}
		echo json_encode($temp);
	}else{
		
	}
}else if($_GET['id'] == 8){
	$temp[0] = array('id'=>0,'name'=>"Less than 1 Year");
	$temp[1] = array('id'=>1,'name'=>"1 Year");
	$temp[2] = array('id'=>2,'name'=>"2 Years");
	$temp[3] = array('id'=>3,'name'=>"3 Years");
	$temp[4] = array('id'=>4,'name'=>"4 Years");
	$temp[5] = array('id'=>5,'name'=>"5 Years");
	$temp[6] = array('id'=>6,'name'=>"6 Years");
	$temp[7] = array('id'=>7,'name'=>"7 Years");
	$temp[8] = array('id'=>8,'name'=>"8 Years");
	$temp[9] = array('id'=>9,'name'=>"9 Years");
	$temp[10] = array('id'=>10,'name'=>"10 Years");
	$temp[11] = array('id'=>11,'name'=>"11 Years");
	$temp[12] = array('id'=>12,'name'=>"12 Years");
	$temp[13] = array('id'=>13,'name'=>"13 Years");
	$temp[14] = array('id'=>14,'name'=>"14 Years");
	$temp[15] = array('id'=>15,'name'=>"15 Years");
	$temp[16] = array('id'=>16,'name'=>"16 Years");
	$temp[17] = array('id'=>17,'name'=>"17 Years");
	$temp[18] = array('id'=>18,'name'=>"18 Years");
	$temp[19] = array('id'=>19,'name'=>"19 Years");
	$temp[20] = array('id'=>20,'name'=>"20 Years");
	$temp[21] = array('id'=>21,'name'=>"21 Years");
	$temp[22] = array('id'=>22,'name'=>"22 Years");
	$temp[23] = array('id'=>23,'name'=>"23 Years");
	$temp[24] = array('id'=>24,'name'=>"24 Years");
	$temp[25] = array('id'=>25,'name'=>"25 Years");
	$temp[26] = array('id'=>26,'name'=>"26 Years");
	$temp[27] = array('id'=>27,'name'=>"27 Years");
	$temp[28] = array('id'=>28,'name'=>"28 Years");
	$temp[29] = array('id'=>29,'name'=>"29 Years");
	$temp[30] = array('id'=>30,'name'=>"30 Years");
	echo json_encode($temp);
}else if($_GET['id'] == 9){
	
}  
mysqli_close($link);
?>