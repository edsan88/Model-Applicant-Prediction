<?php
require('../config.php');
$sql = "SELECT * FROM retention.sex";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$temp[] = array("id"=>$row['sex_id'],
									"sex"=>$row['sex']);
	}
	echo json_encode($temp);
}else{

}
mysqli_free_result($data);
mysqli_close($link);
?>