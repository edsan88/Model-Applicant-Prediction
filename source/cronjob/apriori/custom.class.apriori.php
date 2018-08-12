<?php 
class Apriori {
    private $delimiter   = ','; 
    private $minSup      = 0; 
    private $minConf     = 0; 
     
    private $rules       = array(); 
    private $table       = array(); 
    private $allthings   = array();
    private $allsups     = array(); 
    private $keys        = array(); 
    private $freqItmsts  = array();    
    private $phase       = 1;
    
    //maxPhase>=2
    private $maxPhase    = 20; 
    
    private $fiTime      = 0;
    private $arTime      = 0; 
    
    public function setDelimiter($char)
    {
       $this->delimiter = $char;
    }
    
    public function setMinSup($int)
    {
       $this->minSup = $int;
    }
    
    public function setMinConf($int)
    {
       $this->minConf = $int;
    }
    
    public function setMaxScan($int)
    {
       $this->maxPhase = $int;
    }
    
    public function getDelimiter()
    {
       return $this->delimiter;
    }
    
    public function getMinSup()
    {
       return $this->minSup;
    }
    
    public function getMinConf()
    {
       return $this->minConf;
    }
    
    public function getMaxScan()
    {
       return $this->maxPhase;
    }
    
  
    private function makeTable($db)
    { 
       $table   = array();
       $array   = array();
       $counter = 1;
       
       // if(!is_array($db))
          // {
             // $db = file($db);
          // }else{
			  // $db = $db;
		  // }
  
       $num = count($db);  
       for($i=0; $i<$num; $i++) 
          {
			//print_r($db[$i]);
             $tmp  = explode($this->delimiter, $db[$i][0]);
             //print_r($tmp);
			 $num1 = count($tmp);
             $x    = array();
             for($j=0; $j<$num1; $j++) 
                {
                   $x = trim($tmp[$j]);
                   if($x==='')
                      {
                         continue;
                      }
                      
                   if(!isset($this->keys['v->k'][$x]))
                      {
                         $this->keys['v->k'][$x]         = $counter;
                         $this->keys['k->v'][$counter]   = $x;
                         $counter++;
                      } 
               
                   if(!isset($array[$this->keys['v->k'][$x]]))
                      {
                         $array[$this->keys['v->k'][$x]] = 1; 
                         $this->allsups[$this->keys['v->k'][$x]] = 1;                        
                      }
                   else
                      {
                         $array[$this->keys['v->k'][$x]]++; 
                         $this->allsups[$this->keys['v->k'][$x]]++;
                      }
               
                   $table[$i][$this->keys['v->k'][$x]] = 1; 
                } 
          }
 
       $tmp = array();
       foreach($array as $item => $sup) 
          { 
             if($sup>=$this->minSup)
                {
                   
                   $tmp[] = array($item);
                }
          }
  
       $this->allthings[$this->phase] = $tmp;
       $this->table = $table;  
    }

    
    private function scan($arr, $implodeArr = '')
    { 
       $cr = 0;
          
       if($implodeArr)
          { 
             if(isset($this->allsups[$implodeArr]))
                { 
                   return $this->allsups[$implodeArr];
                }
          }
       else
          {
             sort($arr);
             $implodeArr = implode($this->delimiter, $arr);
             if(isset($this->allsups[$implodeArr]))
                { 
                  return $this->allsups[$implodeArr];
                }
          } 
       
       $num  = count($this->table);
       $num1 = count($arr); 
       for($i=0; $i<$num; $i++)
          {
             $bool = true; 
             for($j=0; $j<$num1; $j++)
                {
                   if(!isset($this->table[$i][$arr[$j]]))
                      {
                         $bool = false;
                         break;
                      }
                }
         
             if($bool)
                {
                   $cr++;
                }
          }
          
       $this->allsups[$implodeArr] = $cr;
       
      return $cr;
    }

    
    private function combine($arr1, $arr2)
    { 
       $result = array();
       
       $num  = count($arr1);
       $num1 = count($arr2); 
       for($i=0; $i<$num; $i++)
          {
             if(!isset($result['k'][$arr1[$i]]))
                {
                   $result['v'][] = $arr1[$i];
                   $result['k'][$arr1[$i]] = 1;
                }
          }

       for($i=0; $i<$num1; $i++)
          {
             if(!isset($result['k'][$arr2[$i]]))
                {
                   $result['v'][] = $arr2[$i];
                   $result['k'][$arr2[$i]] = 1;
                }
          }
      
      return $result['v'];
    } 
    
    
    private function realName($arr)
    { 
       $result = ''; 
       
       $num = count($arr);
       for($j=0; $j<$num; $j++)
          { 
             if($j)
               {
                  $result .= $this->delimiter;
               }
                  
             $result .= $this->keys['k->v'][$arr[$j]]; 
          }
      
      return $result;
    }

    //1-2=>2-3 : false
    //1-2=>5-6 : true
    private function checkRule($a, $b)
    { 
       $a_num = count($a); 
       $b_num = count($b); 
       for($i=0; $i<$a_num; $i++) 
          { 
             for($j=0; $j<$b_num; $j++) 
                {
                   if($a[$i]==$b[$j])
                      {
                         return false;
                      }
                }
          }

      return true;
    } 

    private function confidence($sup_a, $sup_ab)
    {
        return round(($sup_ab / $sup_a) * 100, 2);
    }
  
    private function subsets($items) 
    {  
       $result  = array(); 
       $num     = count($items); 
       $members = pow(2, $num); 
       for($i=0; $i<$members; $i++) 
          { 
             $b   = sprintf("%0".$num."b", $i); 
             $tmp = array();  
             for($j=0; $j<$num; $j++) 
                { 
                   if($b[$j]=='1') 
                      {  
                         $tmp[] = $items[$j];   
                      }
                } 
      
             if($tmp)
                { 
                   sort($tmp);
                   $result[] = $tmp; 
                }  
          } 
   
      return $result; 
    }
    
   
    private function freqItemsets($db)
    { 
       $this->fiTime = $this->startTimer();  
       $this->makeTable($db);   
       while(1)
          {
             if($this->phase>=$this->maxPhase)
                {
                   break;
                }
                
             $num = count($this->allthings[$this->phase]);
             $cr  = 0;
             for($i=0; $i<$num; $i++)  
                {    
                   for($j=$i; $j<$num; $j++) 
                      {  
                         if($i==$j)
                            {
                               continue;
                            }
                     
                         $item = $this->combine($this->allthings[$this->phase][$i], $this->allthings[$this->phase][$j]); 
                         sort($item);  
                         $implodeArr = implode($this->delimiter, $item);
                         if(!isset($this->freqItmsts[$implodeArr]))
                            {
                               $sup = $this->scan($item, $implodeArr);
                               if($sup>=$this->minSup)
                                  {
                                     $this->allthings[$this->phase+1][] = $item;
                                     $this->freqItmsts[$implodeArr] = 1;
                                     $cr++;
                                  }
                            } 
                      }
                }
       
             if($cr<=1)
                {
                   break;
                }
      
             $this->phase++;  
          } 
           

       foreach($this->freqItmsts as $k => $v)
          {
             $arr = explode($this->delimiter, $k);
             $num = count($arr); 
             if($num>=3)
                { 
                   $subsets = $this->subsets($arr);  
                   $num1    = count($subsets); 
                   for($i=0; $i<$num1; $i++)
                      {
                         if(count($subsets[$i])<$num)
                            {
                               unset($this->freqItmsts[implode($this->delimiter, $subsets[$i])]);   
                            } 
                         else
                            {
                               break;
                            }
                      }
                } 
          }
     
       $this->fiTime = $this->stopTimer($this->fiTime); 
    }
    

    public function process($db)
    {
       $checked = $result = array();     
       
       $this->freqItemsets($db);
       $this->arTime = $this->startTimer();
		//print_r($this->freqItemsets($db));
       foreach($this->freqItmsts as $k => $v)
          { 
             $arr     = explode($this->delimiter, $k); 
             $subsets = $this->subsets($arr);    
             $num     = count($subsets); 
             for($i=0; $i<$num; $i++)
                {
                   for($j=0; $j<$num; $j++)
                      {
                         if($this->checkRule($subsets[$i], $subsets[$j]))
                            {
                               $n1 = $this->realName($subsets[$i]);
                               $n2 = $this->realName($subsets[$j]);
                                     
                               $scan = $this->scan($this->combine($subsets[$i], $subsets[$j]));
                               $c1   = $this->confidence($this->scan($subsets[$i]), $scan);
                               $c2   = $this->confidence($this->scan($subsets[$j]), $scan); 
                              
                               if($c1>=$this->minConf)
                                  {
                                     $result[$n1][$n2] = $c1; 
                                  }
                                 
                               if($c2>=$this->minConf)
                                  { 
                                     $result[$n2][$n1] = $c2; 
                                  } 
                                             
                               $checked[$n1.$this->delimiter.$n2] = 1;
                               $checked[$n2.$this->delimiter.$n1] = 1; 
                            }
                      }
                } 
          }
      
       $this->arTime = $this->stopTimer($this->arTime); 
 
      return $this->rules = $result;
    }
    
    public function printFreqItemsets($position_name,$custom_ruleset_id,$link)
    {
       echo 'Time: '.$this->fiTime.' second(s)<br />===============================================================================<br />';
         
       foreach($this->freqItmsts as $k => $v)
          {
             $tmp  = '';
             $tmp1 = '';
             $k    = explode($this->delimiter, $k);
             $num  = count($k);
             for($i=0; $i<$num; $i++)
                {  
                   if($i)
                      {
                         $tmp  .= $this->delimiter.$this->realName($k[$i]);
                         $tmp1 .= $this->delimiter.$k[$i];
                      }
                   else
                      {
                         $tmp  = $this->realName($k[$i]);
                         $tmp1 = $k[$i];
                      } 
                }
             
             echo '{'.$tmp.'} = '.$this->allsups[$tmp1].'<br />';
			$this->SaveItemSet($this->minSup,$this->minConf,$position_name,$tmp,$this->allsups[$tmp1],$custom_ruleset_id,$link);	
          }
    }   
    
    public function saveFreqItemsets($filename)
    {
       $content = '';
                
       foreach($this->freqItmsts as $k => $v)
          {
             $tmp  = '';
             $tmp1 = '';
             $k    = explode($this->delimiter, $k);
             $num  = count($k);
             for($i=0; $i<$num; $i++)
                {  
                   if($i)
                      {
                         $tmp  .= $this->delimiter.$this->realName($k[$i]);
                         $tmp1 .= $this->delimiter.$k[$i];
                      }
                   else
                      {
                         $tmp  = $this->realName($k[$i]);
                         $tmp1 = $k[$i];
                      } 
                }
             
             $content .= '{'.$tmp.'} = '.$this->allsups[$tmp1]."\n"; 
          }
          
        file_put_contents($filename, $content);
    }
    
    public function getFreqItemsets()
    {
       $result = array();
       
       foreach($this->freqItmsts as $k => $v)
          {
             $tmp        = array();
             $tmp['sup'] = $this->allsups[$k];
             $k          = explode($this->delimiter, $k);
             $num        = count($k);
             for($i=0; $i<$num; $i++)
                {  
                   $tmp[] = $this->realName($k[$i]); 
                }
             
             $result[] = $tmp; 
          }
       
      return $result;
    } 
    
    public function printAssociationRules($position_name,$custom_ruleset_id,$link)
    {
       echo 'Time: '.$this->arTime.' second(s)<br />===============================================================================<br />';
        
       foreach($this->rules as $a => $arr)
          {
             foreach($arr as $b => $conf)
                { 
                   if(strpos($a, 'ACTUAL WORK YEARS') !== false){
						echo "<b style='color:#FF0000;'>$this->minSup , $this->minConf , $position_name :".$a."=>".$b. "=".$conf."%</b><br />";  
						$this->SaveAssociationRulesInDB($this->minSup,$this->minConf,$position_name,$custom_ruleset_id,$a,$b,$conf,1,$link);
				   }else{
						echo "$this->minSup , $this->minConf , $position_name : $a => $b = $conf%<br />";  
						$this->SaveAssociationRulesInDB($this->minSup,$this->minConf,$position_name,$custom_ruleset_id,$a,$b,$conf,0,$link);
				   }
				   //$this->SaveAssociationRulesInDB($this->minSup,$this->minConf,$position_name,$custom_ruleset_id,$a,$b,$conf,1,$link);
                }
          }
    }
	public function SaveAssociationRulesInDB($minsup,$mincon,$position_name,$custom_ruleset_id,$rule1,$rule2,$rule_confidence,$status,$link){
		$s = "SELECT * FROM retention.custom_employee_association_rules 
			WHERE custom_employee_association_rules.support = '".$minsup."' 
			AND custom_employee_association_rules.confidence = '".$mincon."' 
			AND custom_employee_association_rules.position_name = '".$position_name."' 
			AND custom_employee_association_rules.rule1 = '".$rule1."' 
			AND custom_employee_association_rules.rule2 = '".$rule2."' 
			AND custom_employee_association_rules.rule_confidence = '".$rule_confidence."' 
			AND custom_employee_association_rules.status = '".$status."' 
			AND custom_employee_association_rules.custom_ruleset_id = '".$custom_ruleset_id."'";
		$d = mysqli_query($link,$s);
		if(mysqli_num_rows($d)>0){
			//$sql = "UPDATE retention.employee_association_rules";
		}else{
			$sql = "INSERT INTO retention.custom_employee_association_rules 
					VALUES(null,'".$minsup."','".$mincon."','".$position_name."','".$rule1."','".$rule2."','".$rule_confidence."','".$status."','".$custom_ruleset_id."')";
			mysqli_query($link,$sql);		
		}
	}
	public function SaveItemSet($minsup,$mincon,$position_name,$itemset,$count,$custom_ruleset_id,$link){
		$s = "SELECT * FROM retention.custom_itemset 
			WHERE custom_itemset.support = '".$minsup."'
			AND custom_itemset.confidence = '".$mincon."' 
			AND custom_itemset.position = '".$position_name."' 
			AND custom_itemset.itemset = '".$itemset."' 
			AND custom_itemset.count = '".$count."' 
			AND custom_itemset.custom_ruleset_id = '".$custom_ruleset_id."'";
		$d = mysqli_query($link,$s);
		if(mysqli_num_rows($d)>0){
			//$sql = "UPDATE retention.employee_association_rules";
		}else{
			$sql = "INSERT INTO retention.custom_itemset 
					VALUES(null,'".$minsup."','".$mincon."','".$position_name."','".$itemset."','".$count."','".$custom_ruleset_id."')";
			mysqli_query($link,$sql);		
		}
	}
    public function saveAssociationRules($filename)
    {
        $content = '';
                
       foreach($this->rules as $a => $arr)
          {
             foreach($arr as $b => $conf)
                { 
                   $content .= "$a => $b = $conf%\n"; 
                }
          } 
          
        file_put_contents($filename, $content);
    }
    
    public function getAssociationRules()
    {
        return $this->rules;
    } 
    
    private function startTimer()
    {
       list($usec, $sec) = explode(" ", microtime());
       return ((float)$usec + (float)$sec);
    }
    
    private function stopTimer($start, $round=2)
    {
       $endtime = $this->startTimer()-$start;
       $round   = pow(10, $round);
       return round($endtime*$round)/$round;
    }
}  
?>
