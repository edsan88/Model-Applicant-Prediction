<?php
require('../config.php');
$sql = "SELECT * FROM retention.marital_status  ORDER BY  marital_status.marital_status ASC";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$temp[] = array("id"=>$row['marital_status_id'],
									"marital_status"=>$row['marital_status']);
	}
	echo json_encode($temp);
}else{

}
mysqli_free_result($data);
mysqli_close($link);
?>