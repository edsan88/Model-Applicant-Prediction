<?php
require('../config.php');
	$sql = "SELECT * FROM retention.employee_association_rules
			WHERE employee_association_rules.support = '".$_GET['support']."'
			AND employee_association_rules.confidence = '".$_GET['confidence']."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			if($row['status'] == 1){
				$status = "<img src='img/icon/enabled.gif'> Selected";
			}else{
				$status = "<img src='img/icon/disabled.gif'> Excluded";
			}
			$temp[] = array("id"=>$row['employee_association_rules'],
							"position"=>$row['position_name'],
							"support"=>$row['support'],
							"confidence"=>$row['confidence'],
							"assoc_rules"=>$row['rule1']." =>".$row['rule2'],
							"percentage"=>$row['rule_confidence']/100,
							"status"=>$status);
		}
		echo json_encode($temp);
	}else{
		
	}
	mysqli_close($link);
?>