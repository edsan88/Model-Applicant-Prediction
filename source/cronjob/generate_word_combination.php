<?php
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
$s = "DELETE FROM retention.applicant_selection_choice";
mysqli_query($link,$s);
$sql = "SELECT applicant_questionnaire.*,user_overall_response.user_overall_response_id
		FROM retention.applicant_questionnaire
		LEFT JOIN retention.user_overall_response
		ON user_overall_response.questionnaire_id = applicant_questionnaire.questionnaire_id";
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
			AND word_frequency_list.pos_tag IN('/RB','/JJ','/VB','/NN','/VBZ','/NN','/TO','/PRP$','/VBG','/CC')";
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
			SaveApplicantSelectionChoice($link,$row['applicant_questionnaire_id'],$v[$x]);
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
function SaveApplicantSelectionChoice($link,$applicant_questionnaire_id,$word_combination){
	$sql = "INSERT INTO retention.applicant_selection_choice VALUES(null,'".$applicant_questionnaire_id."','".$word_combination."','',0)";
	mysqli_query($link,$sql);
}
?>