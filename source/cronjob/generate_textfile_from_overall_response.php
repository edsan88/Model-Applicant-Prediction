<?php
require('../config.php');
$sql = "SELECT * FROM retention.user_overall_response";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		//echo $row['consolidated_response'];
		if (file_exists('text_response/'.$row['dimension_id'].'-'.$row['questionnaire_id'].'.txt')) {
			$myfile = fopen('text_response/'.$row['dimension_id'].'-'.$row['questionnaire_id'].'.txt', "w") or die("Unable to open file!");
			$txt = $row['consolidated_response'];
			fwrite($myfile, $txt);
			fclose($myfile);
		} else {
			$myfile = fopen('text_response/'.$row['dimension_id'].'-'.$row['questionnaire_id'].'.txt', "w") or die("Unable to open file!");
			$txt = $row['consolidated_response'];
			fwrite($myfile, $txt);
			fclose($myfile);
		}
	}
	//echo json_encode($temp);
}else{

}
mysqli_free_result($data);
mysqli_close($link);
?>