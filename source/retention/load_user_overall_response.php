<?php
require('../config.php');
$sql = "SELECT user_overall_response.*,
		dimensions.dimension_name,
		questionnaire.question
		FROM retention.user_overall_response 
		LEFT JOIN retention.dimensions ON
		dimensions.dimensions_id = user_overall_response.dimension_id
		LEFT JOIN retention.questionnaire ON
		questionnaire.questionnaire_id = user_overall_response.questionnaire_id
		WHERE user_overall_response.consolidation_template_id = '".$_GET['id']."'";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$temp[] = array("id"=>$row['user_overall_response_id'],
						"dimension"=>$row['dimension_name'],
						"question"=>$row['question'],
						"response"=>$row['consolidated_response']);
	}
	echo json_encode($temp);
}else{

}
mysqli_free_result($data);
mysqli_close($link);
?>