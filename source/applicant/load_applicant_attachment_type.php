<?php
require('../config.php');
$sql = "SELECT attachment_type.attachment_name,applicant_attachment.* FROM retention.applicant_attachment
		LEFT JOIN retention.attachment_type ON
		attachment_type.attachment_type_id = applicant_attachment.attachment_type_id
		WHERE applicant_attachment.applicant_profile_id = '".$_GET['applicant_profile_id']."'";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$temp[] = array("id"=>strtoupper($row['applicant_attachment_id']),
						"attachment_type"=>strtoupper($row['attachment_name']),
						"directory"=>$row['directory'],
						"filename"=>$row['filename']);
	}
	echo json_encode($temp);
}else{
	
}
mysqli_close($link);
?>