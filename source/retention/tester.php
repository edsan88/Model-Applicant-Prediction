<?php
require('../config.php');
$sql = "SELECT * FROM retention.user_overall_response";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$get_max_value = max($row['sentiment_pos'], $row['sentiment_neu'], $row['sentiment_neg']);
		if($get_max_value == $row['sentiment_pos']){
			echo "POSITIVE<br>";
			SelectWordFrequencyListByUserOverallResponseIDAsPositive($row['user_overall_response_id'],$link);
		}else if($get_max_value == $row['sentiment_neu']){
			echo "NUETRAL<br>";
			SelectWordFrequencyListByUserOverallResponseIDAsNeutral($row['user_overall_response_id'],$link);
		}else if($get_max_value == $row['sentiment_neg']){
			echo "NEGATIVE<br>";
			SelectWordFrequencyListByUserOverallResponseIDAsNegative($row['user_overall_response_id'],$link);
		}
		echo "END<hr style='background-color:#FF0000;'>";
	}

}else{
	
}

function GetQuestionSelectionModel($user_overall_response_id,$word,$pos_tag,$link){
	$sql = "SELECT * FROM retention.question_selection_model";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			if($row['structure'] == $pos_tag){
				echo "<div style='width:100%;background-color:#c2c2c2;'>".$user_overall_response_id."]-------------->".$word."</div><br>";
			}else{
				
			}
		}
		echo "<hr>";
	}else{
		
	}
}
function SelectWordFrequencyListByUserOverallResponseIDAsPositive($id,$link){
	$sql = "SELECT * FROM retention.word_frequency_list
			WHERE word_frequency_list.sentiment_pos > word_frequency_list.sentiment_neu
			AND word_frequency_list.sentiment_pos > word_frequency_list.sentiment_neg
			AND word_frequency_list.user_overall_response_id = '".$id."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			echo "-->".$row['word']."<br>";
			GetQuestionSelectionModel($id,$row['word'],$row['pos_tag'],$link);
		}
	}else{
		
	}
}
function SelectWordFrequencyListByUserOverallResponseIDAsNeutral($id,$link){
	$sql = "SELECT * FROM retention.word_frequency_list
			WHERE word_frequency_list.sentiment_neu > word_frequency_list.sentiment_pos
			AND word_frequency_list.sentiment_neu > word_frequency_list.sentiment_neg
			AND word_frequency_list.user_overall_response_id = '".$id."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			echo "-->".$row['word']."<br>";
			GetQuestionSelectionModel($id,$row['word'],$row['pos_tag'],$link);
		}
	}else{
		
	}
}
function SelectWordFrequencyListByUserOverallResponseIDAsNegative($id,$link){
	$sql = "SELECT * FROM retention.word_frequency_list
			WHERE word_frequency_list.sentiment_neg > word_frequency_list.sentiment_pos
			AND word_frequency_list.sentiment_neg > word_frequency_list.sentiment_neu
			AND word_frequency_list.user_overall_response_id = '".$id."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			echo "-->".$row['word']."<br>";
			GetQuestionSelectionModel($id,$row['word'],$row['pos_tag'],$link);
		}
	}else{
		
	}
}
mysqli_close($link);
?>