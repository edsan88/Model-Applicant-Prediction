<?php
require('../config.php');
$sql = "SELECT * FROM retention.consolidation_template
		WHERE consolidation_template.consolidation_template_id = '".$_GET['id']."'";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	$row = mysqli_fetch_array($data);
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
			AND user_details.date_taken >= '".$_GET['start']."' 
			AND user_details.date_taken <= '".$_GET['end']."'";
	//echo $s;
	$d = mysqli_query($link,$s);
	if(mysqli_num_rows($d)>0){
		while($r=mysqli_fetch_array($d)){
			$temp[] =  array("id"=>$r['user_details_id'],
							"user_id"=>$r['user_id']);
		}
		echo json_encode($temp);
	}else{

	}
}else{

}
mysqli_close($link);
?>