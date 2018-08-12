<?php
require('../config.php');
$sql = "SELECT * FROM retention.applicant_prediction
		WHERE applicant_prediction.support = '".$_GET['support']."'
		AND applicant_prediction.confidence = '".$_GET['confidence']."'
		AND applicant_prediction.applicant_id = '".$_GET['applicant']."'";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	echo "<p><b>RESULTS</b></p>";
	while($row = mysqli_fetch_array($data)){
		echo "<p><b>".strtoupper(str_replace("ACTUAL WORK YEARS","Yrs",$row['prediction_value']))."</b>: 100%</p>";
		// $x = json_decode($row['prediction_value']);
		// echo "<p><b>RESULTS</b></p>";
		// foreach($x  as $key =>$value){
			//$echo $key."-->".$value."<hr>";
			// $temp[] = array("years"=>$key,
							// "val"=>$value);
			// echo "<p><b>".strtoupper(str_replace("ACTUAL WORK YEARS","Yrs",$key))."</b>: ".$value."</p>";
			
		// }
	}
	//echo json_encode(end($temp));
}else{
	
}
mysqli_close($link);
?>