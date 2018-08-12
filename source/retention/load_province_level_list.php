<?php
require('../config.php');
$sql = "SELECT * FROM retention.refprovince WHERE refprovince.regCode IN (".$_GET['id'].")";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$temp[] = array("id"=>$row['provCode'],
									"province"=>$row['provDesc']);
	}
	echo json_encode($temp);
}else{

}
mysqli_free_result($data);
mysqli_close($link);
?>