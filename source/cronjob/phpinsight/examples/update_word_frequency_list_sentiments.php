<?php
require('../../../config.php');
require_once __DIR__ . '/../autoload.php';
if (PHP_SAPI != 'cli') {
	echo "<pre>";
}
$sql = "SELECT * FROM retention.user_overall_response WHERE user_overall_response.consolidation_template_id = '".$_POST['id']."'";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		//$row['user_overall_response_id'];
		SelectWordFrequencyByUserResponseID($row['user_overall_response_id'],$link);
	}
}else{
	
}
function SelectWordFrequencyByUserResponseID($user_overall_response_id,$link){
	$sql = "SELECT * FROM retention.word_frequency_list 
			WHERE word_frequency_list.user_overall_response_id = '".$user_overall_response_id."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$counter = 1;
		while($row = mysqli_fetch_array($data)){
			//$row['word_frequency_list_id'];
			$strings = array($counter=>$row['word']);
			//require_once __DIR__ . '/../autoload.php';
			$sentiment = new \PHPInsight\Sentiment();
			foreach ($strings as $string) {

				// calculations:
				$scores = $sentiment->score($string);
				$class = $sentiment->categorise($string);

				// output:
				echo "String: $string\n";
				echo "Dominant: $class, scores: ";
				print_r($scores);
				echo "\n";
				foreach($scores as $x => $x_value) {
					//echo "Key=" . $x . ", Value=" . $x_value;
					//InsertWordFrequenncyValues($row['user_overall_response_id'],$x,$x_value,$link);
					UpdateWordFrequencyListSentiments($row['word_frequency_list_id'],$x,$x_value,$link);
				}
			}
			$counter ++;
		}
	}else{
		
	}
}

function UpdateWordFrequencyListSentiments($id,$field,$field_value,$link){
	if($field == 'pos'){
		$sql = "UPDATE retention.word_frequency_list 
			SET word_frequency_list.sentiment_pos = '".$field_value."' 
			WHERE word_frequency_list.word_frequency_list_id = '".$id."'";
	}else if($field == 'neu'){
		$sql = "UPDATE retention.word_frequency_list 
			SET word_frequency_list.sentiment_neu = '".$field_value."' 
			WHERE word_frequency_list.word_frequency_list_id = '".$id."'";
	}else if($field == 'neg'){
		$sql = "UPDATE retention.word_frequency_list 
			SET word_frequency_list.sentiment_neg = '".$field_value."' 
			WHERE word_frequency_list.word_frequency_list_id = '".$id."'";
	}		
	mysqli_query($link,$sql);
}
// $strings = array(
	// 1 => 'I personally, viewed this as neutral because sometimes during our work we are forced to work more than the expected hours needed to render especially on busy schedule.I personally, viewed this as neutral because sometimes during our work we are forced to work more than the expected hours needed to render especially on busy schedule.I personally, viewed this as neutral because sometimes during our work we are forced to work more than the expected hours needed to render especially on busy schedule.I personally, viewed this as neutral because sometimes during our work we are forced to work more than the expected hours needed to render especially on busy schedule.qewrverwervwebrwerwrerbwerwberwe sdjsjfksdjfksjd fksj dlkfjs ldfj lsdkfjsl dkjfsldjfslkj fslkdjfks jsl kdfj lsjf  j ksldjfksdjf slkdjf lskjdflk sjdflkjsd kjs dkfjwieruwie urwio eutw oietu woietu ioweu toiwett',
	// 2 => "sometimes its easy , sometimes its not. it depends to the number of workload. It is believe that a person cannot focus on different things at one thime.Yes, because they allow me to do things with less supervisionbecause the support of our superiorYes, it's very easy when you have already know what you doing. Mostly, the trainer will teach his/her trainee effectively.Honestly, I cant find it easy because this is my first job and I don't have any experience but it helps me as an individual to learn new things and discover skills that I think I may not know since, my position is more on decision making.i undergo several training,which help me in my work her in the company and even outside.im new to this position so its not yet easy to apply my trainings.Yes it is asy to apply my trainings",
	// 3 => 'His skills are mediocre',
	// 4 => 'He is very talented',
	// 5 => 'She is seemingly very agressive',
	// 6 => 'Marie was enthusiastic about the upcoming trip. Her brother was also passionate about her leaving - he would finally have the house for himself.',
	// 7 => 'To be or not to be?',
	// 8 => 'qw eiqpw eiq owie pqi wpoeiq pwiep qiw qw eiqpw eiq owie pqi wpoeiq pwiep qiw qw eiqpw eiq owie pqi wpoeiq pwiep qiw qw eiqpw eiq owie pqi wpoeiq pwiep qiw werwe rwe rw e '
// );
mysqli_close($link);
?>





