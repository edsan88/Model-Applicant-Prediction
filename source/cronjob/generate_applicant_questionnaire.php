<?php
require('../config.php');
$sql = "SELECT * FROM retention.questionnaire";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		//echo $row['consolidated_response'];
		$phrase  = $row['question'];
		$orig_word = array("I "," I ", " i ","i ", " Me "," me "," me", " my "," My ","My "," am ");
		$replacement_word   = array("You ", " You ", " you ","you ", " You ", " you "," you"," your "," Your ","Your "," are ");

		$newphrase = str_replace($orig_word, $replacement_word, $phrase);
		SaveApplicantQuestionnaire($row['questionnaire_id'],$newphrase,$link);
	}
	//echo json_encode($temp);
}else{

}
function SaveApplicantQuestionnaire($questionnaire_id,$newphrase,$link){
	$sql = "SELECT * FROM retention.applicant_questionnaire 
			WHERE applicant_questionnaire.questionnaire_id = '".$questionnaire_id."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$s = "UPDATE retention.applicant_questionnaire 
			SET applicant_questionnaire.question = '".mysqli_real_escape_string($link,$newphrase)."'
			WHERE applicant_questionnaire.questionnaire_id = '".$questionnaire_id."'";
		mysqli_query($link,$s);
	}else{
		$s = "INSERT INTO retention.applicant_questionnaire 
			VALUES(null,'".$questionnaire_id."','".mysqli_real_escape_string($link,$newphrase)."')";
		mysqli_query($link,$s);
	}
}
mysqli_close($link);
?>