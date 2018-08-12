<?php
set_time_limit(0);
function comb ($n, $elems) {
    if ($n > 0) {
      $tmp_set = array();
      $res = comb($n-1, $elems);
      foreach ($res as $ce) {
          foreach ($elems as $e) {
             array_push($tmp_set, $ce . $e);
          }
       }
       return $tmp_set;
    }
    else {
        return array('');
    }
}
// $elems = array('A','B','C');
// $v = comb(10, $elems);
//print_r($v);

require('../config.php');
// $s = "DELETE FROM retention.applicant_selection_choice";
// mysqli_query($link,$s);
// $sql = "SELECT applicant_questionnaire.*,user_overall_response.user_overall_response_id
		// FROM retention.applicant_questionnaire
		// LEFT JOIN retention.user_overall_response
		// ON user_overall_response.questionnaire_id = applicant_questionnaire.questionnaire_id";
$sql = "SELECT * FROM retention.user_overall_response LIMIT 2,1";		
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		// $s = "SELECT * FROM retention.word_frequency_list
			// WHERE word_frequency_list.user_overall_response_id = 1457
			// AND word_frequency_list.word_num IN(1)
			// AND word_frequency_list.pos_tag IN('/RB','/JJ','/VB','/NN','/VBZ','/NN','/TO','/PRP$','/VBG','/CC')";
		// $s = "SELECT * FROM retention.word_frequency_list
			// WHERE word_frequency_list.user_overall_response_id = '".$row['user_overall_response_id']."'
			// AND word_frequency_list.word_num IN(1)
			// AND word_frequency_list.pos_tag IN('/RB','/JJ','/VB','/NN','/VBZ','/NN','/TO','/PRP$','/VBG','/CC')
			// AND word_frequency_list.frequency >=
			// (SELECT (MAX(word_frequency_list.frequency) * 5/100) as max_word
			// FROM retention.word_frequency_list
			// WHERE word_frequency_list.user_overall_response_id = '".$row['user_overall_response_id']."')";
		$s = "SELECT * FROM retention.word_frequency_list
			WHERE word_frequency_list.user_overall_response_id = '".$row['user_overall_response_id']."'
			AND word_frequency_list.word_num IN(1)
			AND word_frequency_list.pos_tag IN('/JJ','/TO','/VB','/PRP$','/NN','/NNS')";
		$d = mysqli_query($link,$s);
		if(mysqli_num_rows($d)>0){
			$word_stack = array();
			while($r = mysqli_fetch_array($d)){
				array_push($word_stack,$r['word']." ");
			}
		}else{
			
		}
		//print_r($word_stack);
		$v = comb(5, $word_stack);
		for($x = 0;$x<count($v);$x++){
			//echo $v[$x]."<br>";
			$tempo = explode(" ",$v[$x]);
			if(count(array_unique($tempo))<count($tempo)){
				
			}else{
				//echo $v[$x]."<br>";
				VerifyApplicantSelectionChoice($link,$row['user_overall_response_id'],$v[$x]);
			}
			//SaveApplicantSelectionChoice($link,$row['applicant_questionnaire_id'],$v[$x]);
		}
		// if($word_stack[0] == $word_stack[1] || $word_stack[1] == $word_stack[2] || $word_stack[2] == $word_stack[0]){
			// $v = comb(4, $word_stack);
			// for($x = 0;$x<count($v);$x++){
				// echo "Excluded for multiple same word: ".$v[$x]."<br>";
			// }
			// echo "<hr>";
		// }else{
			// $v = comb(3, $word_stack);

			// for($x = 0;$x<count($v);$x++){
				// echo $v[$x]."<br>";
				// SaveApplicantSelectionChoice($link,$row['applicant_questionnaire_id'],$v[$x]);
			// }
			// echo "<hr>";	
		// }
		
	}
	//echo json_encode($temp);
	unset($word_stack);
}else{

}
function SaveApplicantSelectionChoice($link,$user_overall_response_id,$word_combination){
	$sql = "INSERT INTO retention.applicant_selection_choice VALUES(null,'".$user_overall_response_id."','".$word_combination."','',0)";
	mysqli_query($link,$sql);
}
function VerifyApplicantSelectionChoice($link,$user_overall_response_id,$word_combination){
	$sql = "SELECT * FROM retention.applicant_selection_choice 
			WHERE applicant_selection_choice.user_overall_response_id = '".$user_overall_response_id."' 
			AND applicant_selection_choice.word_combination = '".$word_combination."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		
	}else{
		 SaveApplicantSelectionChoice($link,$user_overall_response_id,$word_combination);
	}
}
?>