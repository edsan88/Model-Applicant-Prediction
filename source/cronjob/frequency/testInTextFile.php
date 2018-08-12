<?php
	set_time_limit(0);
	include('frequentTermsAnalyzer.php');
	require('../../config.php');
	$sql = "SELECT * FROM retention.user_overall_response";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			//$generalTextFile  = file_get_contents('../text_response/'.$row['dimension_id'].'-'.$row['questionnaire_id'].'.txt');
			$generalTextFile  = file_get_contents('data/retention.txt');
			//$generalTextFile .= file_get_contents('data/wikipedia_social_media.txt');
			//$generalTextFile .= file_get_contents('data/wikipedia_personal_finance.txt');
			//$generalTextFile .= file_get_contents('data/wikipedia_barbicue.txt');
			//$generalTextFile .= file_get_contents('data/test.txt');
			$candidates = explode(' ', vacuumCleaner($generalTextFile));
			$analyzer   = new frequentTermsAnalyzer($candidates);
			$excludedWords = $analyzer->getFrequentWords();
			// print_r($excludedWords);

			$dataFile  = '../text_response/'.$row['dimension_id'].'-'.$row['questionnaire_id'].'.txt';
			$particularTextFile = file_get_contents($dataFile);
			$candidates = explode(' ', vacuumCleaner($particularTextFile));
			$analyzer   = new frequentTermsAnalyzer($candidates, $excludedWords);
			$compoundWords = $analyzer->getCompoundTerms();
			print "Processing data file: ". $dataFile ."\n";
			print_r($compoundWords);
			foreach($compoundWords as $x => $x_value) {
				echo "Key=" . $x . ", Value=" . $x_value;
				InsertWordFrequenncyValues($row['user_overall_response_id'],$x,$x_value,$link);
			}
			
			echo "<hr>";
			
		}
	}else{

	}
	function vacuumCleaner($str){
		$str = strtolower($str);
		$str = preg_replace('/[^a-z ]/', '', $str);
		return preg_replace('/\s+/', ' ', $str);
	}
	function InsertWordFrequenncyValues($user_overall_response_id,$compundwords,$weight,$link){
		$sql = "INSERT INTO retention.word_frequency 
				VALUES(null,
						'".$user_overall_response_id."',
						'".mysqli_real_escape_string($link,$compundwords)."',
						'".$weight."')";
						echo $sql."<br>";
		mysqli_query($link,$sql);
	}
?>