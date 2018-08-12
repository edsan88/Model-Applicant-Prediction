<?php
require('../config.php');
$sql = "SELECT * FROM retention.user_account
		WHERE user_account.user_account_id = '".mysqli_real_escape_string($link,$_POST['id'])."'
		AND user_account.password = '".md5(mysqli_real_escape_string($link,$_POST['pass']))."'
		OR user_account.username = '".mysqli_real_escape_string($link,$_POST['id'])."'
		AND user_account.password = '".md5(mysqli_real_escape_string($link,$_POST['pass']))."'";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$temp[] = array("user_id"=>$row['user_account_id']);
	}
	echo json_encode($temp);
}else{
	echo "[{\"user_id\":\"\"}]";
}
mysqli_free_result($data);
mysqli_close($link);
?>