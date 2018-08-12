<?php
require('../config.php');
$sql = "SELECT questionnaire.questionnaire_id,
		questionnaire.question,
		dimensions.dimension_name
		FROM retention.questionnaire
		LEFT JOIN retention.dimensions ON
		dimensions.dimensions_id = questionnaire.dimensions_id";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$temp[] = array("id"=>$row['questionnaire_id'],
						"dimension"=>$row['dimension_name'],
						"question"=>$row['question']);
	}
	echo json_encode($temp);
}else{
	
}
mysqli_free_result($data);
mysqli_close($link);
?>