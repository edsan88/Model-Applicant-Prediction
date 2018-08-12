<?php
require('../config.php');
// $sql = "SELECT user_overall_response.*,
		// dimensions.dimension_name,
		// questionnaire.question,
		// questionnaire.ideal_response,
		// consolidation_template.template_desc
		// FROM retention.user_overall_response 
		// LEFT JOIN retention.dimensions ON
		// dimensions.dimensions_id = user_overall_response.dimension_id
		// LEFT JOIN retention.questionnaire ON
		// questionnaire.questionnaire_id = user_overall_response.questionnaire_id 
		// LEFT JOIN retention.consolidation_template ON 
		// consolidation_template.consolidation_template_id = user_overall_response.consolidation_template_id 
		// WHERE user_overall_response.dimension_id = '".$_GET['dimension']."'
		// AND user_overall_response.consolidation_template_id = '".$_GET['template']."'
		// ORDER BY user_overall_response.user_overall_response_id ASC";
$sql = "SELECT user_overall_response.*,
		dimensions.dimension_name,
		questionnaire.question,
		questionnaire.ideal_response,
		consolidation_template.template_desc
		FROM retention.user_overall_response 
		LEFT JOIN retention.dimensions ON
		dimensions.dimensions_id = user_overall_response.dimension_id
		LEFT JOIN retention.questionnaire ON
		questionnaire.questionnaire_id = user_overall_response.questionnaire_id 
		LEFT JOIN retention.consolidation_template ON 
		consolidation_template.consolidation_template_id = user_overall_response.consolidation_template_id 
		WHERE user_overall_response.consolidation_template_id = '".$_GET['template']."'
		ORDER BY user_overall_response.user_overall_response_id ASC";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$temp_rate = explode(",",$row['ratings_percentage']);
		//print_r($temp_rate);
		 $maxs = array_keys($temp_rate, max($temp_rate));
		$ideal_status = "";
		for($x = 0;$x<count($temp_rate);$x++){
			
			// if($temp_rate[$x] == max($temp_rate)){
				// echo $temp_rate[$x]."---->".max($temp_rate)."<hr>";
				// if($x == $row['ideal_response']){
					// $ideal_status = "Positive";
				// }else{
					// $ideal_status = "Negative";
				// }
			// }else{
				
			// }
			
			 ////print_r($maxs);
			 //$ideal = 4; 
			 for($y=0;$y<count($maxs);$y++){
				 if($row['ideal_response'] == $maxs[$y]){
					 $ideal_status = "Positive";
				 }else{
					 
				 }
			 }
		}
		if($row['ideal_response'] == 5){
			$response = "N/A";
		}else if($row['ideal_response'] == 4){
			$response = "Strongly Agree";
		}else if($row['ideal_response'] == 3){
			$response = "Somewhat Agree";
		}else if($row['ideal_response'] == 2){
			$response = "Neutral";
		}else if($row['ideal_response'] == 1){
			$response = "Strongly Disagree";
		}else if($row['ideal_response'] == 0){
			$response = "--------";
		}
		//echo "<hr>";
		//if($temp_rate[$row['ideal_response']] > )
		$max_val = max($temp_rate);
		$key_max = array_search($max_val, $temp_rate);
		//echo $key_max;
		$total_takers = GetDescriptiveEquivalent($link,$_GET['template']);
		if($key_max == 1){
			$temp[] = array("id"=>$row['user_overall_response_id'],
							"dimension"=>$row['dimension_name'],
							"question"=>$row['question'],
							"response"=>$row['consolidated_response'],
							"positive"=>number_format($row['sentiment_pos'] * 100,2,'.',','),
							"neutral"=>number_format($row['sentiment_neu'] * 100,2,'.',','),
							"negative"=>number_format($row['sentiment_neg']* 100,2,'.',','),
							"percent_per_rating"=>(($total_takers * $temp_rate[1]) / 100)." / ".$total_takers,
							"strongly_disagree_rating"=>"<b style='color:#FFFFFF;background-color:#990000;padding:5px;'>(".number_format((($total_takers * $temp_rate[1]) / 100),1,'.','')."/".$total_takers.")</b> <b style='color:#FFFFFF;background-color:#0000FF;padding:5px;'>".number_format($temp_rate[1],2,'.',',')."</b>",
							"neutral_rating"=>"<b style='color:#990000;'>(".number_format((($total_takers * $temp_rate[2]) / 100),1,'.','')."/".$total_takers.")</b> ".number_format($temp_rate[2],2,'.',','),
							"somewhat_agree_rating"=>"<b style='color:#990000;'>(".number_format((($total_takers * $temp_rate[3]) / 100),1,'.','')."/".$total_takers.")</b> ".number_format($temp_rate[3],2,'.',','),
							"strongly_agree_rating"=>"<b style='color:#990000;'>(".number_format((($total_takers * $temp_rate[4]) / 100),1,'.','')."/".$total_takers.")</b> ".number_format($temp_rate[4],2,'.',','),
							"na_rating"=>"<b style='color:#990000;'>(".number_format((($total_takers * $temp_rate[5]) / 100),1,'.','')."/".$total_takers.")</b> ".number_format($temp_rate[5],2,'.',','),
							"template"=>$row['template_desc'],
							"ideal_status"=>$ideal_status,
							"ideal_response"=>$response);	
		}else if($key_max == 2){
			$temp[] = array("id"=>$row['user_overall_response_id'],
							"dimension"=>$row['dimension_name'],
							"question"=>$row['question'],
							"response"=>$row['consolidated_response'],
							"positive"=>number_format($row['sentiment_pos'] * 100,2,'.',','),
							"neutral"=>number_format($row['sentiment_neu'] * 100,2,'.',','),
							"negative"=>number_format($row['sentiment_neg']* 100,2,'.',','),
							"percent_per_rating"=>(($total_takers * $temp_rate[2]) / 100)." / ".$total_takers,
							"strongly_disagree_rating"=>"<b style='color:#990000;'>(".number_format((($total_takers * $temp_rate[1]) / 100),1,'.','')."/".$total_takers.")</b> ".number_format($temp_rate[1],2,'.',','),
							"neutral_rating"=>"<b style='color:#FFFFFF;background-color:#990000;padding:5px;'>"."(".number_format((($total_takers * $temp_rate[2]) / 100),1,'.','')."/".$total_takers.")</b> <b style='color:#FFFFFF;background-color:#0000FF;padding:5px;'>".number_format($temp_rate[2],2,'.',',')."</b>",
							"somewhat_agree_rating"=>"<b style='color:#990000;'>(".number_format((($total_takers * $temp_rate[3]) / 100),1,'.','')."/".$total_takers.")</b> ".number_format($temp_rate[3],2,'.',','),
							"strongly_agree_rating"=>"<b style='color:#990000;'>(".number_format((($total_takers * $temp_rate[4]) / 100),1,'.','')."/".$total_takers.")</b> ".number_format($temp_rate[4],2,'.',','),
							"na_rating"=>"<b style='color:#990000;'>(".number_format((($total_takers * $temp_rate[5]) / 100),1,'.','')."/".$total_takers.")</b> ".number_format($temp_rate[5],2,'.',','),
							"template"=>$row['template_desc'],
							"ideal_status"=>$ideal_status,
							"ideal_response"=>$response);
		}else if($key_max == 3){
			$temp[] = array("id"=>$row['user_overall_response_id'],
							"dimension"=>$row['dimension_name'],
							"question"=>$row['question'],
							"response"=>$row['consolidated_response'],
							"positive"=>number_format($row['sentiment_pos'] * 100,2,'.',','),
							"neutral"=>number_format($row['sentiment_neu'] * 100,2,'.',','),
							"negative"=>number_format($row['sentiment_neg']* 100,2,'.',','),
							"percent_per_rating"=>(($total_takers * $temp_rate[3]) / 100)." / ".$total_takers,
							"strongly_disagree_rating"=>"<b style='color:#990000;'>(".number_format((($total_takers * $temp_rate[1]) / 100),1,'.','')."/".$total_takers.")</b> ".number_format($temp_rate[1],2,'.',','),
							"neutral_rating"=>"<b style='color:#990000;'>(".number_format((($total_takers * $temp_rate[2]) / 100),1,'.','')."/".$total_takers.")</b> ".number_format($temp_rate[2],2,'.',','),
							"somewhat_agree_rating"=>"<b style='color:#FFFFFF;background-color:#990000;padding:5px;'>"."(".number_format((($total_takers * $temp_rate[3]) / 100),1,'.','')."/".$total_takers.")</b> <b style='color:#FFFFFF;background-color:#0000FF;padding:5px;'>".number_format($temp_rate[3],2,'.',',')."</b>",
							"strongly_agree_rating"=>"<b style='color:#990000;'>(".number_format((($total_takers * $temp_rate[4]) / 100),1,'.','')."/".$total_takers.")</b> ".number_format($temp_rate[4],2,'.',','),
							"na_rating"=>"<b style='color:#990000;'>(".number_format((($total_takers * $temp_rate[5]) / 100),1,'.','')."/".$total_takers.")</b> ".number_format($temp_rate[5],2,'.',','),
							"template"=>$row['template_desc'],
							"ideal_status"=>$ideal_status,
							"ideal_response"=>$response);
		}else if($key_max == 4){
			$temp[] = array("id"=>$row['user_overall_response_id'],
							"dimension"=>$row['dimension_name'],
							"question"=>$row['question'],
							"response"=>$row['consolidated_response'],
							"positive"=>number_format($row['sentiment_pos'] * 100,2,'.',','),
							"neutral"=>number_format($row['sentiment_neu'] * 100,2,'.',','),
							"negative"=>number_format($row['sentiment_neg']* 100,2,'.',','),
							"percent_per_rating"=>(($total_takers * $temp_rate[4]) / 100)." / ".$total_takers,
							"strongly_disagree_rating"=>"<b style='color:#990000;'>(".number_format((($total_takers * $temp_rate[1]) / 100),1,'.','')."/".$total_takers.")</b> ".number_format($temp_rate[1],2,'.',','),
							"neutral_rating"=>"<b style='color:#990000;'>(".number_format((($total_takers * $temp_rate[2]) / 100),1,'.','')."/".$total_takers.")</b> ".number_format($temp_rate[2],2,'.',','),
							"somewhat_agree_rating"=>"<b style='color:#990000;'>(".number_format((($total_takers * $temp_rate[3]) / 100),1,'.','')."/".$total_takers.")</b> ".number_format($temp_rate[3],2,'.',','),
							"strongly_agree_rating"=>"<b style='color:#FFFFFF;background-color:#990000;padding:5px;'>"."(".number_format((($total_takers * $temp_rate[4]) / 100),1,'.','')."/".$total_takers.")</b> <b style='color:#FFFFFF;background-color:#0000FF;padding:5px;'>".number_format($temp_rate[4],2,'.',',')."</b>",
							"na_rating"=>"<b style='color:#990000;'>(".number_format((($total_takers * $temp_rate[5]) / 100),1,'.','')."/".$total_takers.")</b> ".number_format($temp_rate[5],2,'.',','),
							"template"=>$row['template_desc'],
							"ideal_status"=>$ideal_status,
							"ideal_response"=>$response);
		}
		
	}
	echo json_encode($temp);
}else{

}
mysqli_free_result($data);
function GetDescriptiveEquivalent($link,$id){
	$sql = "SELECT * FROM retention.consolidation_template
			WHERE consolidation_template.consolidation_template_id = '".$id."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$row = mysqli_fetch_array($data);
		$s = "SELECT COUNT(*) as total_participant 
			FROM retention.user_details 
			WHERE user_details.date_taken >= '".$row['survey_start']."' 
			AND user_details.date_taken <= '".$row['survey_end']."'";
		$d = mysqli_query($link,$s);
		if(mysqli_num_rows($d)>0){
			$r =  mysqli_fetch_array($d);
			return $r['total_participant'];
		}else{
			return 0;
		}
	}else{ 
		
	}
}
mysqli_close($link);
?>