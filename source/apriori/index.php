<?php
require('../config.php');
$build = new Apriori;
//print_r($build->ScanDB($link));
$build->CountItemSet($build->ScanDB($link),$link);
Class Apriori{
	public $support = 3;
	function ScanDB($link){
		$sql = "SELECT * FROM retention.employee_profile";
		$data = mysqli_query($link,$sql);
		if(mysqli_num_rows($data)>0){
			while($row = mysqli_fetch_array($data)){
				$temp[] = array("sex"=>$row['sex'],
								"civilstatus"=>$row['civilstatus'],
								"religion"=>$row['religion'],
								"city"=>$row['city'],
								"province"=>$row['province'],
								"citizenship"=>$row['citizenship'],
								"bloodtype"=>$row['bloodtype'],
								"total_years_work"=>$row['total_years_work'],
								"position"=>$row['position'],
								"department"=>$row['department'],
								"work_history"=>$row['work_history'],
								"degree"=>$row['degree']);
			}
			return $temp;
		}else{

		}
	}
	function CountItemSet($db_scan_array,$link){
		$array_temp = array();
		for($x=0;$x<count($db_scan_array);$x++){
			echo "Counter:".($x+1)."<br>";
			//print_r(array_keys($db_scan_array[$x]))."<hr>";
			$keys = array_keys($db_scan_array[$x]);
			for($y=0;$y<count($keys);$y++){
				//echo $keys[$y]."<br>";
				echo  $db_scan_array[$x][$keys[$y]]."<br>";
				$array_temp[] = $db_scan_array[$x][$keys[$y]];
			}
			echo "<hr>";
		}
		$value_count = array_count_values($array_temp);
		foreach($value_count as $key=>$value){
		  echo "<p>".$key. "------>".$value."</p>";
		}
	}
}
?>