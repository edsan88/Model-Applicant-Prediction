<?php
require('../config.php');
	$sql = "SELECT * FROM retention.custom_itemset
			WHERE custom_itemset.custom_ruleset_id = '".$_GET['id']."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			$temp[] = array("id"=>$row['itemset_id'],
							"itemset"=>$row['itemset'],
							"count"=>$row['count'],
							"position"=>$row['position']);
		}
		echo json_encode($temp);
	}else{
		
	}
	mysqli_close($link);
?>