<?php
require('../config.php');
$sql = "SELECT * FROM retention.question_selection_model";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$temp[] = array("id"=>$row['question_selection_model_id'],
						"pos_structure"=>$row['structure'],
						"status"=>$row['status']);
	}
	echo json_encode($temp);
}else{
	
}
mysqli_free_result($data);
mysqli_close($link);
?>