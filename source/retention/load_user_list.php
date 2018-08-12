<?php
require('../config.php');
$sql = "SELECT * FROM retention.user_details";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$temp[] = array("id"=>$row['user_details_id'],
						"user_id"=>$row['user_id']);
	}
	echo json_encode($temp);
}else{

}
mysqli_free_result($data);
mysqli_close($link);
?>