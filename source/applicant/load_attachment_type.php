<?php
require('../config.php');
$sql = "SELECT * FROM retention.attachment_type";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$temp[] = array("id"=>strtoupper($row['attachment_type_id']),
						"attachment_type"=>strtoupper($row['attachment_name']));
	}
	echo json_encode($temp);
}else{
	
}
mysqli_close($link);
?>