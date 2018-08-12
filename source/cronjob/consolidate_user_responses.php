<?php
require('../config.php');
$sql = "SELECT * FROM retention.consolidation_template 
		WHERE consolidation_template.status = 0 
		AND consolidation_template.consolidation_template_id = '".$_POST['id']."'";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$age = explode(",",$row['age']);
		$s = "SELECT * FROM retention.user_details
				WHERE user_details.age >= '".$age[0]."'
				AND user_details.age <= '".$age[1]."' 
				AND user_details.sex IN(".$row['sex'].") 
				AND user_details.religion IN(".$row['religion'].") 
				AND user_details.marital_status IN(".$row['marital_status'].") 
				AND user_details.educ_level IN(".$row['educ_level'].") 
				AND user_details.region IN(".$row['region'].") 
				AND user_details.province IN(".$row['province'].") 
				AND user_details.city IN(".$row['city'].") AND user_details.brgy IN(".$row['brgy'].") 
				AND user_details.date_taken >= '".$row['survey_start']."' 
				AND user_details.date_taken <= '".$row['survey_end']."'";
		//echo $s;
		$d = mysqli_query($link,$s);
		if(mysqli_num_rows($d)>0){
			while($r=mysqli_fetch_array($d)){
				$temp[] = "'".$r['user_id']."'";
			}
			$user_ids = implode(',',$temp);
			//echo $user_ids."<hr>";
			//echo json_encode($temp);
			GetQuestionnaire($link,$user_ids,$row['consolidation_template_id']);
		}else{

		}	
	}
	
}else{

}

function GetQuestionnaire($link,$user_ids,$consolidation_template_id){
	$sql = "SELECT * FROM retention.questionnaire";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			GetUserResponses($row['dimensions_id'],$row['questionnaire_id'],$link,$user_ids,$consolidation_template_id);
		}
	}else{

	}	
}

function GetUserResponses($dimension_id,$questionnaire_id,$link,$user_ids,$consolidation_template_id){
	$sql = "SELECT * FROM retention.user_response
	WHERE user_response.dimension_id = '".$dimension_id."'
	AND user_response.questionnaire_id = '".$questionnaire_id."' 
	AND user_response.user_id IN(".$user_ids.")";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			VerifyOverallResponse($row['dimension_id'],$row['questionnaire_id']," ".$row['response'],$link,$consolidation_template_id);
			SetTemplateAsProcessed($consolidation_template_id,$link);
		}
	}else{

	}
}
function VerifyOverallResponse($dimension_id,$questionnaire_id,$response,$link,$consolidation_template_id){
	$sql = "SELECT * FROM retention.user_overall_response
			WHERE user_overall_response.dimension_id = '".$dimension_id."'
			AND user_overall_response.questionnaire_id = '".$questionnaire_id."' 
			AND user_overall_response.consolidation_template_id = '".$consolidation_template_id."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		UpdateOverallResponse($dimension_id,$questionnaire_id,$response,$link,$consolidation_template_id);
	}else{
		InsertOverallResponse($dimension_id,$questionnaire_id,$response,$link,$consolidation_template_id);
	}
}
function UpdateOverallResponse($dimension_id,$questionnaire_id,$content,$link,$consolidation_template_id){
	$sql = "UPDATE retention.user_overall_response 
			SET user_overall_response.consolidated_response = CONCAT(user_overall_response.consolidated_response,'".mysqli_real_escape_string($link,$content)."') 
			WHERE user_overall_response.dimension_id = '".$dimension_id."' 
			AND user_overall_response.questionnaire_id = '".$questionnaire_id."' 
			AND user_overall_response.consolidation_template_id = '".$consolidation_template_id."'";
	mysqli_query($link,$sql);
}
function InsertOverallResponse($dimension_id,$questionnaire_id,$content,$link,$consolidation_template_id){
	$sql = "INSERT INTO retention.user_overall_response 
			VALUES(null,'".$dimension_id."','".$questionnaire_id."','".mysqli_real_escape_string($link,$content)."',0,0,0,'".$consolidation_template_id."','')";
	mysqli_query($link,$sql);
}

function SetTemplateAsProcessed($consolidation_template_id,$link){
	$sql = "UPDATE retention.consolidation_template SET consolidation_template.status = 1 
			WHERE consolidation_template.consolidation_template_id = '".$consolidation_template_id."'";
	mysqli_query($link,$sql);
}
mysqli_close($link);
?>