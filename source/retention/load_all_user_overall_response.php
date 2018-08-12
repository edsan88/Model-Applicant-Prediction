<?php
require('../config.php');
$sql = "SELECT user_overall_response.*,
		dimensions.dimension_name,
		questionnaire.question,
		consolidation_template.template_desc
		FROM retention.user_overall_response 
		LEFT JOIN retention.dimensions ON
		dimensions.dimensions_id = user_overall_response.dimension_id
		LEFT JOIN retention.questionnaire ON
		questionnaire.questionnaire_id = user_overall_response.questionnaire_id 
		LEFT JOIN retention.consolidation_template ON 
		consolidation_template.consolidation_template_id = user_overall_response.consolidation_template_id 
		ORDER BY user_overall_response.user_overall_response_id ASC";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$temp_rate = explode(",",$row['ratings_percentage']);
		$temp[] = array("id"=>$row['user_overall_response_id'],
						"dimension"=>$row['dimension_name'],
						"question"=>$row['question'],
						"response"=>$row['consolidated_response'],
						"positive"=>number_format($row['sentiment_pos'] * 100,2,'.',','),
						"neutral"=>number_format($row['sentiment_neu'] * 100,2,'.',','),
						"negative"=>number_format($row['sentiment_neg']* 100,2,'.',','),
						"strongly_disagree_rating"=>number_format($temp_rate[1],2,'.',','),
						"neutral_rating"=>number_format($temp_rate[2],2,'.',','),
						"somewhat_agree_rating"=>number_format($temp_rate[3],2,'.',','),
						"strongly_agree_rating"=>number_format($temp_rate[4],2,'.',','),
						"na_rating"=>number_format($temp_rate[5],2,'.',','),
						"template"=>$row['template_desc']);
	}
	echo json_encode($temp);
}else{

}
mysqli_free_result($data);
mysqli_close($link);
?>