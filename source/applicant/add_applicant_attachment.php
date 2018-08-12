<?php
	require('../config.php');
	$filepath = "attachments/applicant/".date('Y-m-d')."/";
	if(VerifyAttachment($link,$_POST['applicant_id'],$_POST['attachment_type_id'],$filepath,$_POST['filename']) == 1){
	
	}else{
		SaveAttachment($link,$_POST['applicant_id'],$_POST['attachment_type_id'],$filepath,$_POST['filename']);
	}
	function VerifyAttachment($link,$applicant_id,$attachment_type_id,$filepath,$filename){
		$sql = "SELECT * FROM retention.applicant_attachment 
				WHERE applicant_attachment.applicant_profile_id = '".$applicant_id."'
				AND applicant_attachment.attachment_type_id = '".$attachment_type_id."'
				AND applicant_attachment.directory = '".$filepath."' 
				AND applicant_attachment.filename = '".$filename."'";
		$data = mysqli_query($link,$sql);
		if(mysqli_num_rows($data)>0){
			return 1;
		}else{
			return 0;
		}
		mysqli_free_result($data);
	}
	function SaveAttachment($link,$applicant_id,$attachment_type_id,$filepath,$filename){
		$sql = "INSERT INTO retention.applicant_attachment 
				VALUES(null,
					'".$applicant_id."',
					'".$attachment_type_id."',
					'".$filepath."',
					'".$filename."')";
		mysqli_query($link,$sql);
		//echo $sql;
	}
?>