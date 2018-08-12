<?php
require('../config.php');
$sql = "SELECT user_response.*,
		dimensions.dimension_name,
		questionnaire.question
		FROM retention.user_response
		LEFT JOIN retention.dimensions ON
		dimensions.dimensions_id = user_response.dimension_id
		LEFT JOIN retention.questionnaire ON
		questionnaire.questionnaire_id = user_response.questionnaire_id
		WHERE user_response.user_id = '".$_GET['user_id']."' 
		ORDER BY questionnaire.questionnaire_id ASC";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		if($row['ratings'] == 0){
			$ratings = "-----";
		}else if($row['ratings'] == 1){
			$ratings = "Strongly Disagree";
		}else if($row['ratings'] == 2){
			$ratings = "Neutral";
		}else if($row['ratings'] == 3){
			$ratings = "Somewhat Agree";
		}else if($row['ratings'] == 4){
			$ratings = "Strongly Agree";
		}else if($row['ratings'] == 5){
			$ratings = "N/A";
		}
		$temp[] = array("id"=>$row['user_response_id'],
						"dimension"=>$row['dimension_name'],
						"question"=>$row['question'],
						"response"=>$row['response'],
						"rating"=>$ratings);
	}
	echo json_encode($temp);
}else{
	echo "[{\"user_id\":\"\"}]";
}
mysqli_free_result($data);
mysqli_close($link);
?>