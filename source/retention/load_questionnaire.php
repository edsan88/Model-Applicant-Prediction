<?php
require('../config.php');
$sql = "SELECT * FROM retention.test";
// $sql = "SELECT * FROM core_system.user_account
		// WHERE user_account.user_account_id = '".mysqli_real_escape_string($link,$_POST['id'])."'
		// AND user_account.password = '".sha1(mysqli_real_escape_string($link,$_POST['pass']))."'
		// OR user_account.username = '".mysqli_real_escape_string($link,$_aPOST['id'])."'
		// AND user_account.password = '".sha1(mysqli_real_escape_string($link,$_POST['pass']))."'";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$temp[] = array("id"=>$row['test_id'],
									"questionnaire"=>$row['test_name'],
									"info"=>$row['info']);
	}
	echo json_encode($temp);
}else{
	echo "[{\"user_id\":\"\"}]";
}
mysqli_free_result($data);
mysqli_close($link);
?>