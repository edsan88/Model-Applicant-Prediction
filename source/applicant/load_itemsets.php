<?php
require('../config.php');
	$sql = "SELECT * FROM retention.itemset
			WHERE itemset.support = '".$_GET['support']."'
			AND itemset.confidence = '".$_GET['confidence']."'";
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