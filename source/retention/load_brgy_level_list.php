<?php
require('../config.php');
$sql = "SELECT * FROM retention.refbrgy WHERE refbrgy.citymunCode IN (".$_GET['id'].")";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$temp[] = array("id"=>$row['brgyCode'],
									"brgy"=>$row['brgyDesc']);
	}
	echo json_encode($temp);
}else{

}
mysqli_free_result($data);
mysqli_close($link);
?>