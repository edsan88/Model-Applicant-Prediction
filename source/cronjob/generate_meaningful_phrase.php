<?php
	require('../config.php');
	GetUserOverallResponse($link);
	mysqli_close($link);


	function GetUserOverallResponse($link){
		$sql = "SELECT * FROM retention.user_overall_response WHERE user_overall_response.consolidation_template_id = '".$_POST['id']."'";
		$data = mysqli_query($link,$sql);
		if(mysqli_num_rows($data)>0){
			while($row = mysqli_fetch_array($data)){
				$get_ratings = explode(",",$row['ratings_percentage']);
				$value = max($get_ratings);
				$key = array_search($value, $get_ratings);
				//echo "<hr>".$key."<hr>";
				//if($key == 1 || $key == 5){
					
				//}else{
					echo "<b style='width:600px;background-color:#c2c2c2;'>".$row['user_overall_response_id']."</b><br>";
					GetPOSPattern($link,$row['user_overall_response_id']);
				//}
				
			}
		}else{
			
		}
	}
	
	function GetPOSPattern($link,$id){
		$sql = "SELECT * FROM retention.question_selection_model WHERE question_selection_model.parent = 0 ";		
		$data = mysqli_query($link,$sql);
		if(mysqli_num_rows($data)>0){
			while($row = mysqli_fetch_array($data)){
				$pos_tag_holder[] = explode(",",$row['structure']);
				echo "<p>[PARENT] [".$row['structure']."]<b style='background-color:#02FF02;'>".GEtWordFreqByPattern($link,$id,$row['pos_tag'])."</b></p>";
				if(GEtWordFreqByPattern($link,$id,$row['pos_tag']) != ''){
					$get_parent_phrase_rank = explode(" ",GEtWordFreqByPattern($link,$id,$row['pos_tag']));
					//print_r($get_parent_phrase_rank);
					$parent_word_count = 0;
					$parent_total_rank_accumulated = 0;
					$parent_per_word_rank_csv = '';
					for($i=0;$i<count($get_parent_phrase_rank);$i++){
						echo "<p> PARENT PER WORD: ".$get_parent_phrase_rank[$i]." RANK:".GetWorFreqRankByID_Word($link,$id,$get_parent_phrase_rank[$i]);
						$parent_total_rank_accumulated = $parent_total_rank_accumulated + GetWorFreqRankByID_Word($link,$id,$get_parent_phrase_rank[$i]);
						if(GetWorFreqRankByID_Word($link,$id,$get_parent_phrase_rank[$i]) > 0){
							$parent_word_count++;
						}else{
							
						}
						if($parent_per_word_rank_csv == ''){
							$parent_per_word_rank_csv = GetWorFreqRankByID_Word($link,$id,$get_parent_phrase_rank[$i]);
						}else if($parent_per_word_rank_csv != ''){
							$parent_per_word_rank_csv = $parent_per_word_rank_csv.",".GetWorFreqRankByID_Word($link,$id,$get_parent_phrase_rank[$i]);
						}
					}
					echo "<p> Overall Parenk Phrase Rank".($parent_total_rank_accumulated / $parent_word_count)."</p>";
					SaveExtractedPhrase($link,$id,GEtWordFreqByPattern($link,$id,$row['pos_tag']),($parent_total_rank_accumulated / $parent_word_count),$parent_per_word_rank_csv);
				}else{
					echo "<p>[CHILD]".GetWordfreqByChild($link,$id,$row['question_selection_model_id'])."<p>";
				}
				
				
			}
			//print_r($pos_tag_holder);
			// for($i=0;$i<count($pos_tag_holder);$i++){
				// print_r($pos_tag_holder[$i]);
				// for($ii=0;$ii<count($pos_tag_holder[$i]);$ii++){
					// echo "<br>[".$id."]---->".$pos_tag_holder[$i][$ii]." : [".GetTopRankWordFrequency($link,$id,$pos_tag_holder[$i][$ii],0)."]<br>";

				// }
			// }
		}else{
			
		}
	}
	
	function GetTopRankWordFrequency($link,$id,$tag,$rank){
		$sql = "SELECT * FROM retention.extract_pos_word
				WHERE extract_pos_word.user_overall_response_id = '".$id."'
				AND extract_pos_word.pos_tag = '".$tag."'";
		$data = mysqli_query($link,$sql);
		if(mysqli_num_rows($data)>0){
			while($row = mysqli_fetch_array($data)){
				//$row['user_overall_response_id'];
				$temp = explode(",",$row['words']);
			}
			return $temp[$rank];
		}else{
			
		}
	}
	
	function GEtWordFreqByPattern($link,$id,$tag){
		$sql = "SELECT * FROM retention.word_frequency_list
				WHERE word_frequency_list.user_overall_response_id = '".$id."'
				AND word_frequency_list.pos_tag = '".$tag."'";
		$data = mysqli_query($link,$sql);
		if(mysqli_num_rows($data)>0){
			$temp = '';
			while($row = mysqli_fetch_array($data)){
				if($temp == ''){
					$temp = $row['word'];
				}else{
					$temp = $temp.",".$row['word'];
				}
			}
				
			return $temp;
		}else{
			
		}
	}
	
	function GetWordfreqByChild($link,$parent,$id){
		
		$sql = "SELECT * FROM retention.question_selection_model WHERE question_selection_model.parent = '".$id."'";
		$data = mysqli_query($link,$sql);
		if(mysqli_num_rows($data)>0){
			$count = 0;
			$total_tags = 0;
			//$temp = '';
			while($row = mysqli_fetch_array($data)){
				//echo "<p>------->".$row['pos_tag']."</p>";
				echo "<p>[".$parent."] [".$row['pos_tag']."]<b style='background-color:#02FF02;'>".GEtWordFreqByPattern($link,$parent,$row['pos_tag'])."</b></p>";
				if(GEtWordFreqByPattern($link,$parent,$row['pos_tag']) != ''){
					$count ++;
					$temp[] = GEtWordFreqByPattern($link,$parent,$row['pos_tag']);
					
				}else{
					
				}
				$total_tags ++;
			}
			if($total_tags != $count){
				echo "<p>Pattern not fit.</p>";
			}else if($total_tags == $count){
				echo "<p>Pattern fit.</p>";
				$final_word_list = [];
				for($i=0;$i<count($temp);$i++){
					$word_group = explode(",",$temp[$i]);
					if(count($word_group) > 1){
						echo "<p> <<<<<  ".$temp[$i]."</p>";
						for($x=0;$x<count($word_group);$x++){
							//print_r($tempcon);
							$word_rank[$x] = GetWorFreqRankByID_Word($link,$parent,$word_group[$x]);
							echo "<p> Word Group [".$x."]: ".$word_group[$x]." Rank: ".$word_rank[$x]."</p>";
						}
						$value = min($word_rank);
						$key = array_search($value,$word_rank);
						echo "<p>Preferred Word Group:".$word_group[$key]."</p>";
						$final_word_list[$i] = $word_group[$key];
					}else{
						echo "<p> <<<<<  ".$temp[$i]."</p>";
						$final_word_list[$i] = $temp[$i];
					}
					
				}
				echo "<hr>";
				print_r($final_word_list);
				//Temporary placeholder for comma splitting
				$csv_words = "";
				for($a=0;$a<count($final_word_list);$a++){
					$pos_tags_comma[$a] = explode(" ",$final_word_list[$a]);
					//echo "<p>XX".count($pos_tags_comma)."</p>";
					for($b=0;$b<count($pos_tags_comma[$a]);$b++){
						echo "<p>";
							echo $pos_tags_comma[$a][$b];
						echo "</p>";
						if($csv_words == ""){
							$csv_words = $pos_tags_comma[$a][$b];
						}else if($csv_words != ""){
							$csv_words = $csv_words.",".$pos_tags_comma[$a][$b];
						}	
					}
				}
				echo "<hr>";
				print_r($pos_tags_comma);
				echo "<hr>";
				echo $csv_words;
				echo "<hr>";
				$pos_tag_holder = explode(",",$csv_words);
				//print_r($holder);
				$unique_pos_tag = array_values(array_unique($pos_tag_holder));
				print_r($unique_pos_tag);
				$child_word_count = 0;
				$child_total_rank_accumulated = 0;
				$child_per_word_rank_csv = '';
				for($i=0;$i<count($unique_pos_tag);$i++){
					echo "<p> CHILD PER WORD: ".$unique_pos_tag[$i]." RANK:".GetWorFreqRankByID_Word($link,$parent,$unique_pos_tag[$i]);
					$child_total_rank_accumulated = $child_total_rank_accumulated + GetWorFreqRankByID_Word($link,$parent,$unique_pos_tag[$i]);
					if(GetWorFreqRankByID_Word($link,$parent,$unique_pos_tag[$i]) > 0){
						$child_word_count++;
					}else{
						
					}
					if($child_per_word_rank_csv == ''){
						$child_per_word_rank_csv = GetWorFreqRankByID_Word($link,$parent,$unique_pos_tag[$i]);
					}else if($child_per_word_rank_csv != ''){
						$child_per_word_rank_csv = $child_per_word_rank_csv.",".GetWorFreqRankByID_Word($link,$parent,$unique_pos_tag[$i]);
					}
				}
				echo "<p> Overall Child Phrase Rank".($child_total_rank_accumulated / $child_word_count)."</p>";
				echo "<hr>";
				$final_phrase = implode(" ",$unique_pos_tag);
				echo $final_phrase;
				SaveExtractedPhrase($link,$parent,$final_phrase,($child_total_rank_accumulated / $child_word_count),$child_per_word_rank_csv);
				echo "<hr>";
			}
				//GEtWordFreqByPattern($link,$id,$row['pos_tag'])
			//return $row['word'];
		}else{
			
		}
	}
	
	function GetWorFreqRankByID_Word($link,$id,$word){
		$sql = "SELECT * FROM retention.word_frequency_list
				WHERE word_frequency_list.user_overall_response_id = '".$id."'
				AND word_frequency_list.word = '".$word."'";
		$data = mysqli_query($link,$sql);
		if(mysqli_num_rows($data)>0){
			$row = mysqli_fetch_array($data);	
			return $row['rank'];
		}else{
			return 0;
		}
	}
	function SaveExtractedPhrase($link,$id,$phrase,$overall_rank,$rank_per_word_csv){
		$sql = "INSERT INTO retention.extract_pos_word VALUES(null,'".$id."','".$phrase."','".$overall_rank."','".$rank_per_word_csv."',0,0,0)";
		mysqli_query($link,$sql);
	}
?>