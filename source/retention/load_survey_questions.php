<div class="page-header" style='margin:20px;'>
  <h1>Employee Perception Towards Organization</h1>
  <p>This test is divided into 12 dimensions of retention and should be answered based on your personal judgement,opinion and your perception towards the company. Kindly respond and answer all questions as indicated below.</p>
	<p>As stated on notice, the system will log you anonymously to safeguard you and will only collect answers/responses to all given questions/survey for machine learning processes. Thank you so much for your participation</p>
  </div>
<?php
require('../config.php');
$sql = "SELECT * FROM retention.dimensions";
// $sql = "SELECT * FROM core_system.user_account
		// WHERE user_account.user_account_id = '".mysqli_real_escape_string($link,$_POST['id'])."'
		// AND user_account.password = '".sha1(mysqli_real_escape_string($link,$_POST['pass']))."'
		// OR user_account.username = '".mysqli_real_escape_string($link,$_aPOST['id'])."'
		// AND user_account.password = '".sha1(mysqli_real_escape_string($link,$_POST['pass']))."'";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	$counter = 1;
	while($row = mysqli_fetch_array($data)){
		echo "<div class='container' style='width:100% !important'>";
			echo "<div class='row'>";
				echo "<div class='col-xm-12 col-sm-12 col-md-12 col-lg-12'>";
					echo "<div class='panel panel-info'>";
						echo "<div class='panel-heading'><b>".ConverToRoman($counter).".  ".$row['dimension_name']."</b></div>";
						echo "<div class='panel-body'><b>Description: </b><i>".$row['description']."</i>";
							echo "<p></p>";
							GetPerDimensionQuestions($row['dimensions_id'],$link);
						echo "</div>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		echo "</div>";
		$counter ++;
	}
	echo "<div class='container' style='width:100% !important'>";
		echo "<div class='row'>";
			echo "<div class='col-xm-12 col-sm-12 col-md-12 col-lg-12'>";
				echo "<center><button id='SubmitDimensionSurveyAnswersBtn' type='button' class='btn btn-primary' onclick=javascript:SubmitSurvey();>Submit</button></center>";
			echo "</div>";
		echo "</div>";
	echo "</div>";
}else{
	//echo "[{\"user_id\":\"\"}]";
}
mysqli_free_result($data);
mysqli_close($link);

function GetPerDimensionQuestions($dimension_id,$link){
	$sql = "SELECT * FROM retention.questionnaire WHERE questionnaire.dimensions_id = '".$dimension_id."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$counter = 1;
		while($row = mysqli_fetch_array($data)){
			echo "<div class='container' style='width:100% !important'>";
				echo "<div class='row'>";
					echo "<div class='col-xm-12 col-sm-12 col-md-12 col-lg-12'>";
						echo "<div class='panel panel-default'>";
							echo "<div class='panel-heading'><b>".$counter.") Question: ".$row['question']."</b></div>";
							echo "<div class='panel-body'>";
								echo "<div class='row'>";
									echo "<div class='col-xm-4 col-sm-4 col-md-4 col-lg-4'>";
										// echo "<b>Rate:</b>";
										// echo "<div class='radio'>";
											// echo "<label><input type='radio' name='optradio".$counter."'>Strongly Disagree</label>";
										// echo "</div>";
										// echo "<div class='radio'>";
											// echo "<label><input type='radio' name='optradio".$counter."'>Neutral</label>";
										// echo "</div>";
										// echo "<div class='radio'>";
											// echo "<label><input type='radio' name='optradio".$counter."'>Somewhat Agree</label>";
										// echo "</div>";
										// echo "<div class='radio'>";
											// echo "<label><input type='radio' name='optradio".$counter."'>Strongly Agree</label>";
										// echo "</div>";
										// echo "<div class='radio'>";
											// echo "<label><input type='radio' name='optradio".$counter."'>N/A</label>";
										// echo "</div>";
									echo "<div class='form-group'>";
										echo "<label for='".$dimension_id."'>Select list:</label>";
										echo "<select class='form-control' id='".$dimension_id."' name='".$row['questionnaire_id']."'>";
										echo "<option value=0>-----</option>";
										echo "<option value=1>Strongly Disagree</option>";
										echo "<option value=2>Neutral</option>";
										echo "<option value=3>Somewhat Agree</option>";
										echo "<option value=4>Strongly Agree</option>";
										echo "<option value=5>N/A</option>";
										echo "</select>";
									echo "</div>";
									echo "</div>";
									echo "<div class='col-xm-8 col-sm-8 col-md-8 col-lg-8'>";
										echo "<div class='form-group'>";
											echo "<label for='comment'>Please write down your reason(s) below:</label>";
											echo "<textarea class='form-control' rows='5' cols=3 id='comment".$dimension_id."-".$row['questionnaire_id']."'></textarea>";
										echo "</div>";
									echo "</div>";
								echo "</div>";
							echo "</div>";
						echo "</div>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
			$counter ++;
		}
	}else{
		//echo "[{\"user_id\":\"\"}]";
	}
}

function ConverToRoman($num){ 
    $n = intval($num); 
    $res = ''; 

    //array of roman numbers
    $romanNumber_Array = array( 
        'M'  => 1000, 
        'CM' => 900, 
        'D'  => 500, 
        'CD' => 400, 
        'C'  => 100, 
        'XC' => 90, 
        'L'  => 50, 
        'XL' => 40, 
        'X'  => 10, 
        'IX' => 9, 
        'V'  => 5, 
        'IV' => 4, 
        'I'  => 1); 

    foreach ($romanNumber_Array as $roman => $number){ 
        //divide to get  matches
        $matches = intval($n / $number); 

        //assign the roman char * $matches
        $res .= str_repeat($roman, $matches); 

        //substract from the number
        $n = $n % $number; 
    } 

    // return the result
    return $res; 
} 
?>