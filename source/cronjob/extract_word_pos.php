<?php
require('../config.php');
$sql = "SELECT * FROM retention.question_selection_model";		
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	$temp = '';
	while($row = mysqli_fetch_array($data)){
		if($temp == ''){
			$temp = $row['structure'];
		}else{
			$temp = $temp.",".$row['structure'];
		}
	}
	//echo $temp;
	$pos_tag_holder = explode(",",$temp);
	//print_r($holder);
	$unique_pos_tag = array_values(array_unique($pos_tag_holder));
	//print_r($unique_pos_tag);
	for($i=0;$i<count($unique_pos_tag);$i++){
		echo "<br>".$unique_pos_tag[$i]."<hr>";
		GetUserOverallResponse($link,$unique_pos_tag[$i]);
	}
}else{
	
}
mysqli_close($link);

//FUNCTION
function GetUserOverallResponse($link,$tag){
	$sql = "SELECT * FROM retention.user_overall_response";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			//$row['user_overall_response_id'];
			GetWordFrequencyByID_Tag($link,$row['user_overall_response_id'],$tag);
		}
	}else{
		
	}
}

function GetWordFrequencyByID_Tag($link,$id,$tag){
	$sql = "SELECT * FROM retention.word_frequency_list
			WHERE word_frequency_list.word_num = 1
			AND word_frequency_list.user_overall_response_id = '".$id."'
			AND word_frequency_list.pos_tag = '".$tag."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$temp = '';
		while($row = mysqli_fetch_array($data)){
			//$row['user_overall_response_id'];
			if($temp == ''){
				$temp = $row['word'];
			}else{
				$temp = $temp.",".$row['word'];
			}
		}
		echo "<br>-------->[".$id."]".$temp."[".$tag."]</hr>";
		VerifyExtractedWords($link,$id,$temp,$tag);
	}else{
		
	}
}

function VerifyExtractedWords($link,$id,$temp,$tag){
	$sql = "SELECT * FROM retention.extract_pos_word
			WHERE extract_pos_word.user_overall_response_id = '".$id."'
			AND extract_pos_word.pos_tag = '".$tag."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$row = mysqli_fetch_array($data);
		if($row['words'] == $temp){
			
		}else{
			$s = "UPDATE retention.extract_pos_word SET extract_pos_word.words = '".$temp."' 
				WHERE extract_pos_word.user_overall_response_id = '".$id."'
				AND extract_pos_word.pos_tag = '".$tag."'";
			mysqli_query($link,$s);
		}
	}else{
		$s = "INSERT INTO retention.extract_pos_word VALUES(null,'".$id."','".$temp."','".$tag."')";
		mysqli_query($link,$s);
	}
}
?>