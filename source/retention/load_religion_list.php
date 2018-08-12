<?php
require('../config.php');
$sql = "SELECT * FROM retention.religion ORDER BY  religion.name ASC";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$temp[] = array("id"=>$row['religion_id'],
									"religion"=>$row['name']);
	}
	echo json_encode($temp);
}else{

}
mysqli_free_result($data);
mysqli_close($link);
?>