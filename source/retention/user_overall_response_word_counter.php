<?php
	require('../config.php');
	$sql = "SELECT * FROM retention.user_overall_response
			LEFT JOIN retention.questionnaire ON
			questionnaire.questionnaire_id = user_overall_response.questionnaire_id";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$counter = 0;
		$total = 0;
		$num = 0;
		while($row = mysqli_fetch_array($data)){
			echo "<p>".$row['question']." ---->".str_word_count($row['consolidated_response'])." ---> ".(str_word_count($row['consolidated_response'])/41)."</p>";
			$counter = $counter + str_word_count($row['consolidated_response']);
			$total = $total + (str_word_count($row['consolidated_response'])/41);
			$num ++;
		}
		echo "<hr>".$counter."-->".$total."-->".($total / $num)."</hr>";
	}else{
		
	}
	mysqli_close($link);
?>