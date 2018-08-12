<?php
require('../config.php');
echo Y(771,$link);
function Y($id,$link){
	$sql = "SELECT * FROM jserp_hrdo.employment
			LEFT JOIN jserp_hrdo.statusofemployment ON
			statusofemployment.employmentID = employment.employmentID
			WHERE employment.employeeInfoID = '".$id."'
			ORDER BY employment.employmentID ASC";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$counter = 1;
		while($row = mysqli_fetch_array($data)){
			if($counter == 1){
				$temp[] = $row['fromDate'];
			}
			if($counter == mysqli_num_rows($data)){
				$temp[] = $row['toDate'];
			}
			$counter ++;
		}
		//var_dump($temp);
		//echo $temp[0]."][".$temp[1]."<hr>"; 
		return GetNumMonths($temp[0],$temp[1]);
	}else{

	}	
}

function GetNumMonths($start,$end){
	if($end == '0000-00-00'){
		$end = date('Y-m-d');
	}else{
		
	}
	$d1 = strtotime($start);
	$d2 = strtotime($end);
	$min_date = min($d1, $d2);
	$max_date = max($d1, $d2);
	$i = 0;

	while (($min_date = strtotime("+1 MONTH", $min_date)) <= $max_date) {
		$i++;
	}
	return number_format(($i/12),0,'','');
}
mysqli_close($link);
?>