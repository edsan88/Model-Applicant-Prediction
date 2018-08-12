<?php 
	$temp[0] = array('id'=>1,'name'=>'Sex');
	$temp[1] = array('id'=>2,'name'=>'Civil Status');
	//$temp[2] = array('id'=>3,'name'=>'Religion');
	$temp[2] = array('id'=>3,'name'=>'City');
	$temp[3] = array('id'=>4,'name'=>'Province');
	$temp[4] = array('id'=>5,'name'=>'Citizenship');
	//$temp[6] = array('id'=>7,'name'=>'Blood Type');
	$temp[5] = array('id'=>6,'name'=>'Total Years Work');
	$temp[6] = array('id'=>7,'name'=>'Department');
	$temp[7] = array('id'=>8,'name'=>'Work History');
	$temp[8] = array('id'=>9,'name'=>'Educational Attainment');
	$temp[9] = array('id'=>10,'name'=>'Age');
	echo json_encode($temp);
?>