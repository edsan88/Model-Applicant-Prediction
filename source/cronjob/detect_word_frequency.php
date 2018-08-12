<?php
	require('../config.php');
	$sql = "SELECT * FROM retention.user_overall_response
			WHERE user_overall_response.status = 0";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			$words = $row['consolidated_response'];
			print_r( array_count_values(str_word_count($words, 1)) );
			echo "<hr>";
		}
	}else{
		
	}
	mysqli_close($link);
?>