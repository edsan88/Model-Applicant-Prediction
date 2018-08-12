<?php
require('../config.php');
$sql = "SELECT user_overall_response.user_overall_response_id,
		user_overall_response.sentiment_pos,
		user_overall_response.sentiment_neu,
		user_overall_response.sentiment_neg,
		user_overall_response.ratings_percentage,
		questionnaire.keywords,
		questionnaire.ideal_response,
		dimensions.dimension_name
		FROM retention.user_overall_response
		LEFT JOIN retention.questionnaire ON
		questionnaire.questionnaire_id = user_overall_response.questionnaire_id
		LEFT JOIN retention.dimensions ON
		dimensions.dimensions_id =  questionnaire.dimensions_id
		WHERE user_overall_response.consolidation_template_id = '".$_GET['id']."'";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	//$temp_rate = [];
	while($row = mysqli_fetch_array($data)){
		$temp_rate = explode(",",$row['ratings_percentage']);
		//$maxs_index = array_keys($temp_rate, max($temp_rate));
		//echo array_search(max($temp_rate), $temp_rate);
		// if(array_search(max($temp_rate), $temp_rate) == $row['ideal_response']){
			if($row['ideal_response'] == 0){
				$ideal_rating = '-------';
			}else if($row['ideal_response'] == 1){
				$ideal_rating = 'Strongly Disagree';
			}else if($row['ideal_response'] == 2){
				$ideal_rating = 'Neutral';
			}else if($row['ideal_response'] == 3){
				$ideal_rating = 'Somewhat Agree';
			}else if($row['ideal_response'] == 4){
				$ideal_rating = 'Strongly Agree';
			}else if($row['ideal_response'] == 5){
				$ideal_rating = 'N/A';
			}
			if($temp_rate[$row['ideal_response']] == max($temp_rate)){
				$temp[] = array("id"=>$row['user_overall_response_id'],
							"dimension"=>$row['dimension_name'],
							"key_phrase"=>$row['keywords'],
							"ideal_rating"=>$ideal_rating);	
			}
			
			
			//echo $row['user_overall_response_id']."<br>";
		// }else{
			
		// }
		
	}
	echo json_encode($temp);
}else{
	
}
mysqli_free_result($data);
mysqli_close($link);
?>