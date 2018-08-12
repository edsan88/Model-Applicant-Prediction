<?php
require('../config.php');
$sql = "SELECT extract_pos_word.*,
		user_overall_response.questionnaire_id,
		user_overall_response.sentiment_pos as overall_positive,
		user_overall_response.sentiment_neu as overall_neutral,
		user_overall_response.sentiment_neg as overall_negative,
		user_overall_response.consolidation_template_id,
		user_overall_response.ratings_percentage
		FROM retention.extract_pos_word
		LEFT JOIN retention.user_overall_response ON
		user_overall_response.user_overall_response_id = extract_pos_word.user_overall_response_id
		WHERE extract_pos_word.user_overall_response_id = '".$_GET['id']."' 
		ORDER BY extract_pos_word.overall_rank ASC";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		if($row['overall_positive'] > $row['overall_neutral'] && $row['overall_positive'] > $row['overall_negative']){
			if($row['sentiment_pos'] > $row['sentiment_neu'] && $row['sentiment_pos'] > $row['sentiment_neg']){
				$likelihood = "Very likely";
			}else if($row['sentiment_pos'] == $row['sentiment_neu'] && $row['sentiment_pos'] == $row['sentiment_neg']){
				$likelihood = "Less likely";
			}else{
				$likelihood = "Not likely";
			}
		}else if($row['overall_neutral'] > $row['overall_positive'] && $row['overall_neutral'] > $row['overall_negative']){
			if($row['sentiment_neu'] > $row['sentiment_pos'] && $row['sentiment_neu'] > $row['sentiment_neg']){
				$likelihood = "Very likely";
			}else if($row['sentiment_neu'] == $row['sentiment_pos'] && $row['sentiment_neu'] == $row['sentiment_neg']){
				$likelihood = "Less likely";
			}else{
				$likelihood = "Not likely";
			}
		}else if($row['overall_negative'] > $row['overall_neutral'] && $row['overall_negative'] > $row['overall_positive']){
			if($row['sentiment_neg'] > $row['sentiment_pos'] && $row['sentiment_neg'] > $row['sentiment_neu']){
				$likelihood = "Very likely";
			}else if($row['sentiment_neg'] == $row['sentiment_pos'] && $row['sentiment_neg'] == $row['sentiment_neu']){
				$likelihood = "Less likely";
			}else{
				$likelihood = "Not likely";
			}
		}
		$temp[] = array("id"=>$row['extract_pos_word'],
						"phrase"=>$row['phrase'],
						"phrase_rank"=>$row['overall_rank'],
						"positive"=>$row['sentiment_pos'],
						"neutral"=>$row['sentiment_neu'],
						"negative"=>$row['sentiment_neg'],
						"sentiment_likelihood"=>$likelihood);
	}
	echo json_encode($temp);
}else{
	$temp[] = array("id"=>0,
						"phrase"=>'No Pattern found',
						"phrase_rank"=>0,
						"positive"=>0,
						"neutral"=>0,
						"negative"=>0);
	echo json_encode($temp);
}
mysqli_free_result($data);
mysqli_close($link);
?>