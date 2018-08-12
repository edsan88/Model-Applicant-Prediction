<?php
error_reporting(0);
require('../../../config.php'); 
function DeleteWordFrequency($id,$link){
	$s = "DELETE FROM retention.word_frequency_list WHERE word_frequency_list.user_overall_response_id = '".$id."'";
	mysqli_query($link,$s);	
}


$sql = "SELECT * FROM retention.user_overall_response
		WHERE user_overall_response.consolidation_template_id = '".$_POST['id']."'";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		DeleteWordFrequency($row['user_overall_response_id'],$link);
		//$words = $row['consolidated_response'];
		
		//Title of Analysis
		$doctitle = '';

		//What analysis are we doing
		// (int # of words to analyze per phrase) => (string label for that phrase)
		$analysis = array(
			1=>"Single-Word Analysis",
			2=>"Two-Word Phrase Analysis",
			3=>"Three-Word Phrase Analysis",
			4=>"Four-Word Phrase Analysis",
			5=>"Five-Word Phrase Analysis"
			);
			
		//How many result per analysis
		$limit = 50;

		//grab file contents
		$content = $row['consolidated_response'];

		//if the file doesn't exist, error out
		if ( !$content )
			die( 'Please place your source text in "input.txt" in the same directory as this file' );

		//strip out bad charecters, just the words, ma'am
		$content = preg_replace( "/(,|\"|\.|\?|:|!|;| - )/", " ", $content );
		$content = preg_replace( "/\n/", " ", $content );
		$content = preg_replace( "/\s\s+/", " ", $content );

		//split content on words
		$content = explode(" ",$content);
		$words = Array();
		//init array
		$overall = array();

		//loop through each analysis group and run our test
		foreach ($analysis as $id=>$title) {
			$stats = build_stats($content,$id);
			$overall = array_merge($overall,$stats);
			print_stats($stats,$title,$row['user_overall_response_id'],$link);
		}

		//sort and print overall stats
		//array_multisort($overall, SORT_DESC);
		//print_stats($overall,"Overall");
		echo "<hr>";
	}
}else{
	
}
mysqli_close($link);


/**
 * Parses text and builds array of phrase statistics
 *
 * @param string $input source text
 * @param int $num number of words in phrase to look for
 * @rerturn array array of phrases and counts
 */
function SaveWordFrequency($user_overall_response_id,$link,$rank,$word,$frequency,$word_num){
	$sql = "INSERT INTO retention.word_frequency_list 
			VALUES(null,'".$user_overall_response_id."','".$word."','".$rank."','".$frequency."','".$word_num."','',0,0,0)";
	mysqli_query($link,$sql);		
	// $sql ="SELECT * FROM retention.word_frequency_list WHERE word_frequency_list.user_overall_response_id = '".$user_overall_response_id."'";
	// $data = mysqli_query($link,$sql);
	// if(mysqli_num_rows($data)>0){
		// $s = "DELETE FROM retention.word_frequency_list WHERE word_frequency_list.user_overall_response_id = '".$user_overall_response_id."'";
		// mysqli_query($link,$s);
	// }else{
		// $s = "INSERT INTO";
	// }
}
function build_stats($input,$num) {

	//init array
	$results = array();
	
	//loop through words
	foreach ($input as $key=>$word) {
		$phrase = '';
		
		//look for every n-word pattern and tally counts in array
		for ($i=0;$i<$num;$i++) {
			if ($i!=0) $phrase .= ' ';
			$phrase .= strtolower( $input[$key+$i] );
		}
		if ( !isset( $results[$phrase] ) )
			$results[$phrase] = 1;
		else
			$results[$phrase]++;
	}
	if ($num == 1) {
		//clean boring words
		//$a = explode(" ","the of and to a in that it is was i for on you he be with as by at have are this not but had his they from she which or we an there her were one do been all their has would will what if can when so my");
		$a = explode(" ","the of and a in that it is was i for on you he be with as by at have are this not but had his they from she which or we an there her were one do been all their has would will what if can when so my");
		foreach ($a as $banned) unset($results[$banned]);
	}
	
	//sort, clean, return
	array_multisort($results, SORT_DESC);
	unset($results[""]);
	return $results;
}

/**
 * Formats output
 *  
 * @param array $stats results from build_stats
 * @param string $name name of this test group
 *
 */
function print_stats($stats,$name,$user_overall_response_id,$link) { 
	global $limit;
	?>
	<div class='analysis'>
		<h2 id='<?php echo strtolower(str_replace(' ','-',$name)); ?>'><?php echo $name; ?></h2>
		<table border=1>
			<tr>
				<th>Rank</th>
				<th>Term(s)</th>
				<th>Frequency</th>
			</tr>
		<?php
		$i=1;
		foreach ($stats as $term => $count) {
			if ($count == 1) continue;
			if ($i > $limit) break;
			echo "
			<tr>
				<td>$i</td>
				<td>$term</td>
				<td>$count</td>
			</tr>";
			if($name == 'Single-Word Analysis'){
				$word_num = 1;
			}else if($name == 'Two-Word Phrase Analysis'){
				$word_num = 2;
			}else if($name == 'Three-Word Phrase Analysis'){
				$word_num = 3;
			}else if($name == 'Four-Word Phrase Analysis'){
				$word_num = 4;
			}else if($name == 'Five-Word Phrase Analysis'){
				$word_num = 5;
			}
			SaveWordFrequency($user_overall_response_id,$link,$i,$term,$count,$word_num);
			$i++;
		}
		?>
		</table>
	</div>
<?php } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   // "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title><?php echo $doctitle; ?> Frequency Analysis</title>
		<style>
			.toc {top:0px;right:0px;position:fixed; padding: 10px 20px 10px 20px; height:100%; border-left:1px solid black; background: #ddd; width:20%;}
			.analysis {float:left; width:40%; text-align: center; padding:10px;}
			.analysis table {margin-left:auto; margin-right:auto}
			.container {width: 80%}
			h1,h2,h2 {text-align:center}
		</style>
	</head>
	<body>
		<div class='toc'>
		<h3><?php echo $doctitle; ?> Frequency Analysis</h3>
			<ul>
			<?php
				foreach ($analysis as $id=>$title) { ?>
					<li><a href='#<?php echo strtolower(str_replace(' ','-',$title)); ?>'><?php echo $title; ?></a></li>
				<?php }
			?>
					<li><a href='#overall'>Overall</a></li>
			</ul>
		</div>
		<div class='container'>
			<h1><?php echo $doctitle; ?> Frequency Analysis</h1>
<?php



?>
		</div>
	</body>
</html>