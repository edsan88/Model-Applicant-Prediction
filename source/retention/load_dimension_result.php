<?php
require('../config.php');
$sql = "SELECT * FROM retention.dimensions
		ORDER BY dimensions.relevance DESC";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	$total = 0;
	$counter = 0;
	while($row = mysqli_fetch_array($data)){
		if($counter == 0){
			if($row['dimension_name'] == 'Job Satisfaction'){
				$temp[] = array("id"=>$row['dimensions_id'],
							"dimension"=>$row['dimension_name'],
							"percentage"=>number_format($row['relevance'],2,'.',','),
							"response_percentage"=>number_format(CountPositiveResponseByDimension($link,$row['dimensions_id'],$_GET['template']),2,'.',','),
							"support_response_percentage"=>number_format((100 - CountPositiveResponseByDimension($link,$row['dimensions_id'],$_GET['template'])),2,'.',','),
							"total"=>number_format(($row['relevance'] * (CountPositiveResponseByDimension($link,$row['dimensions_id'],$_GET['template'])/100)),2,'.',','));	
			}else{
				$temp[] = array("id"=>$row['dimensions_id'],
							"dimension"=>$row['dimension_name'],
							"percentage"=>number_format($row['relevance'],2,'.',','),
							"response_percentage"=>number_format(CountPositiveResponseByDimension($link,$row['dimensions_id'],$_GET['template']),2,'.',','),
							"support_response_percentage"=>"",
							"total"=>number_format(($row['relevance'] * (CountPositiveResponseByDimension($link,$row['dimensions_id'],$_GET['template'])/100)),2,'.',','));	

			}
			
		}else{
			if($row['dimension_name'] == 'Job Satisfaction'){
				$temp[] = array("id"=>$row['dimensions_id'],
							"dimension"=>$row['dimension_name'],
							"percentage"=>number_format($row['relevance'],2,'.',','),
							"response_percentage"=>number_format(CountPositiveResponseByDimension($link,$row['dimensions_id'],$_GET['template']),2,'.',','),
							"support_response_percentage"=>number_format((100 - CountPositiveResponseByDimension($link,$row['dimensions_id'],$_GET['template'])),2,'.',','),
							"total"=>number_format(($row['relevance'] * (CountPositiveResponseByDimension($link,$row['dimensions_id'],$_GET['template'])/100)),2,'.',','));	
			}else{
				$temp[] = array("id"=>$row['dimensions_id'],
							"dimension"=>$row['dimension_name'],
							"percentage"=>number_format($row['relevance'],2,'.',','),
							"response_percentage"=>number_format(CountPositiveResponseByDimension($link,$row['dimensions_id'],$_GET['template']),2,'.',','),
							"support_response_percentage"=>"",
							"total"=>number_format(($row['relevance'] * (CountPositiveResponseByDimension($link,$row['dimensions_id'],$_GET['template'])/100)),2,'.',','));	

			}
			
		}
		
		$total = $total + ($row['relevance'] * (CountPositiveResponseByDimension($link,$row['dimensions_id'],$_GET['template'])/100));
		$counter++;
	}
		$temp[] = array("id"=>"","dimension"=>"","percentage"=>'<b>Total</b> 100.00',"response_percentage"=>"","total"=>"<b>Retention:</b>".number_format($total,2,'.',','));
		//$temp[] = array("id"=>"","dimension"=>"","percentage"=>'',"response_percentage"=>"","total"=>"<b style='color:#FF0000;'>Turn Over:</b>".number_format((100-$total),2,'.',','));
	echo json_encode($temp);
}else{
	
}
function CountPositiveResponseByDimension($link,$dimension_id,$template_id){
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
			WHERE user_overall_response.consolidation_template_id = '".$template_id."' AND user_overall_response.dimension_id = '".$dimension_id."'
			ORDER BY user_overall_response.user_overall_response_id ASC";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$total_ = 0;
		$total_positive = 0;
		while($row = mysqli_fetch_array($data)){
			$temp_rate = explode(",",$row['ratings_percentage']);
			//print_r($temp_rate);
			 $maxs = array_keys($temp_rate, max($temp_rate));
			$ideal_status = "";
			for($x = 0;$x<count($temp_rate);$x++){
				 for($y=0;$y<count($maxs);$y++){
					 if($row['ideal_response'] == $maxs[$y]){
						 $ideal_status = "Positive";
					 }else{
						 
					 }
				 }
			}
			// $temp[] = array("id"=>$row['user_overall_response_id'],
							// "dimension"=>$row['dimension_name'],
							// "question"=>$row['question'],
							// "response"=>$row['consolidated_response'],
							// "positive"=>number_format($row['sentiment_pos'] * 100,2,'.',','),
							// "neutral"=>number_format($row['sentiment_neu'] * 100,2,'.',','),
							// "negative"=>number_format($row['sentiment_neg']* 100,2,'.',','),
							// "strongly_disagree_rating"=>number_format($temp_rate[1],2,'.',','),
							// "neutral_rating"=>number_format($temp_rate[2],2,'.',','),
							// "somewhat_agree_rating"=>number_format($temp_rate[3],2,'.',','),
							// "strongly_agree_rating"=>number_format($temp_rate[4],2,'.',','),
							// "na_rating"=>number_format($temp_rate[5],2,'.',','),
							// "template"=>$row['template_desc'],
							// "ideal_status"=>$ideal_status,
							// "ideal_response"=>$response);
			if($ideal_status == 'Positive'){
				$total_positive++;
			}
			$total_++;
		}
		//echo json_encode($temp);
		return (($total_positive / $total_) * 100);
	}else{
		return 0;
	}
}
mysqli_close($link);
?>