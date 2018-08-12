<?php
require('../config.php');
$sql = "SELECT * FROM retention.consolidation_template";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		if($row['status'] == 0){
			$status = "<img src='img/icon/disabled.gif'>";
		}else if($row['status'] == 1){
			$status = "<img src='img/icon/enabled.gif'>";
		}
		$temp[] = array("id"=>$row['consolidation_template_id'],
						"template_description"=>$row['template_desc'],
						"status"=>$status,
						"date_start"=>date('Y-m-d',strtotime($row['survey_start'])),
						"date_end"=>date('Y-m-d',strtotime($row['survey_end'])));
	}
	echo json_encode($temp);
}else{
	
}
mysqli_free_result($data);
mysqli_close($link);
?>