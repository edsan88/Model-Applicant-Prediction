<?php
require('../config.php');
$sql = "SELECT * FROM retention.word_frequency_list
		WHERE word_frequency_list.user_overall_response_id = '".$_GET['id']."'";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		if($row['word_num'] == 1){
			$num_words = "1 Word";
		}else if($row['word_num'] == 2){
			$num_words = "2 Words";
		}else if($row['word_num'] == 3){
			$num_words = "3 Words";
		}else if($row['word_num'] == 4){
			$num_words = "4 Words";
		}else if($row['word_num'] == 5){
			$num_words = "5 Words";
		}
		$temp[] = array("id"=>$row['word_frequency_list_id'],
						"num_words"=>$num_words,
						"rank"=>$row['rank'],
						"words"=>$row['word'],
						"frequency"=>$row['frequency'],
						"pos_tag"=>$row['pos_tag']);
	}
	echo json_encode($temp);
}else{
	
}
mysqli_free_result($data);
mysqli_close($link);
?>