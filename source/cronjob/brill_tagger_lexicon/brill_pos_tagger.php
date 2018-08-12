<?php 
class PosTagger {
        private $dict; 
        
        public function __construct($lexicon) {
                $fh = fopen($lexicon, 'r');
                while($line = fgets($fh)) {
                        $tags = explode(' ', $line);
                        $this->dict[strtolower(array_shift($tags))] = $tags;
                }
                fclose($fh);
        }
        
        public function tag($text) {
                preg_match_all("/[\w\d\.]+/", $text, $matches);
                $nouns = array('NN', 'NNS');
                
                $return = array();
                $i = 0;
                foreach($matches[0] as $token) {
                        // default to a common noun
                        $return[$i] = array('token' => $token, 'tag' => 'NN');  
                        
                        // remove trailing full stops
                        if(substr($token, -1) == '.') {
                                $token = preg_replace('/\.+$/', '', $token);
                        }
                        
                        // get from dict if set
                        if(isset($this->dict[strtolower($token)])) {
                                $return[$i]['tag'] = $this->dict[strtolower($token)][0];
                        }       
                        
                        // Converts verbs after 'the' to nouns
                        if($i > 0) {
                                if($return[$i - 1]['tag'] == 'DT' && 
                                        in_array($return[$i]['tag'], 
                                                        array('VBD', 'VBP', 'VB'))) {
                                        $return[$i]['tag'] = 'NN';
                                }
                        }
                        
                        // Convert noun to number if . appears
                        if($return[$i]['tag'][0] == 'N' && strpos($token, '.') !== false) {
                                $return[$i]['tag'] = 'CD';
                        }
                        
                        // Convert noun to past particile if ends with 'ed'
                        if($return[$i]['tag'][0] == 'N' && substr($token, -2) == 'ed') {
                                $return[$i]['tag'] = 'VBN';
                        }
                        
                        // Anything that ends 'ly' is an adverb
                        if(substr($token, -2) == 'ly') {
                                $return[$i]['tag'] = 'RB';
                        }
                        
                        // Common noun to adjective if it ends with al
                        if(in_array($return[$i]['tag'], $nouns) 
                                                && substr($token, -2) == 'al') {
                                $return[$i]['tag'] = 'JJ';
                        }
                        
                        // Noun to verb if the word before is 'would'
                        if($i > 0) {
                                if($return[$i]['tag'] == 'NN' 
                                        && strtolower($return[$i-1]['token']) == 'would') {
                                        $return[$i]['tag'] = 'VB';
                                }
                        }
                        
                        // Convert noun to plural if it ends with an s
                        if($return[$i]['tag'] == 'NN' && substr($token, -1) == 's') {
                                $return[$i]['tag'] = 'NNS';
                        }
                        
                        // Convert common noun to gerund
                        if(in_array($return[$i]['tag'], $nouns) 
                                        && substr($token, -3) == 'ing') {
                                $return[$i]['tag'] = 'VBG';
                        }
                        
                        // If we get noun noun, and the second can be a verb, convert to verb
                        if($i > 0) {
                                if(in_array($return[$i]['tag'], $nouns) 
                                                && in_array($return[$i-1]['tag'], $nouns) 
                                                && isset($this->dict[strtolower($token)])) {
                                        if(in_array('VBN', $this->dict[strtolower($token)])) {
                                                $return[$i]['tag'] = 'VBN';
                                        } else if(in_array('VBZ', 
                                                        $this->dict[strtolower($token)])) {
                                                $return[$i]['tag'] = 'VBZ';
                                        }
                                }
                        }
                        
                        $i++;
                }
                
                return $return;
        }
}
?>
<?php
// little helper function to print the results
function printTag($tags) {
        foreach($tags as $t) {
                echo $t['token'] . "/" . $t['tag'] .  " ";
        }
        echo "\n";
}
function saveTag($tags,$link,$word_frequency_list_id) {
        foreach($tags as $t) {
                //echo $t['token'] . "/" . $t['tag'] .  " ";
			$sql = "UPDATE retention.word_frequency_list SET word_frequency_list.pos_tag = REPLACE(REPLACE(CONCAT(word_frequency_list.pos_tag,'/".mysqli_real_escape_string($link,$t['tag'])."'), '\r', ''), '\n', '') 
					WHERE word_frequency_list.word_frequency_list_id = '".$word_frequency_list_id."'";
			mysqli_query($link,$sql);	
        }
        // echo "\n";
		
}
//$tagger = new PosTagger('lexicon.txt');
//$tags = $tagger->tag('sometimes not of');
//printTag($tags);
?>
<?php
// @samsoir
// $tags = $tagger->tag("Coffee... yes I've said it already today, but it really does keep ones mind fresh and aler [zzzzzzzzZZZZZZZ]");
// printTag($tags);

// @h
// $tags = $tagger->tag("How can I make twitter not think that @h&m is not a mention to / about me! Gah. I have had enough of these Jimmy Choo and wtf ever things.");
// printTag($tags);

// @johannacherry
// $tags = $tagger->tag("i think my brain has checked out for the day..i've been playing with my hair and thinking about toothpaste for about 10 minutes now...");
// printTag($tags);
require('../../config.php');
$tagger = new PosTagger('lexicon.txt');
$sql = "SELECT * FROM retention.word_frequency_list
		WHERE word_frequency_list.user_overall_response_id
		IN(SELECT user_overall_response.user_overall_response_id FROM retention.user_overall_response
		WHERE user_overall_response.consolidation_template_id = '".$_POST['id']."')";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){ 
		$tags = $tagger->tag($row['word']);
		saveTag($tags,$link,$row['word_frequency_list_id']);
	}
}else{
	
}
?>