<?php
function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
if($_POST['id'] != ''){
$temp[] = array("user_id"=>$_POST['id'],
							"age"=>$_POST['age'],
							"sex"=>$_POST['sex'],
							"religion"=>$_POST['religion'],
							"marital_status"=>$_POST['marital_status'],
							"educ_level"=>$_POST['educ_level'],
							"region"=>$_POST['region'],
							"province"=>$_POST['province'],
							"city"=>$_POST['city'],
							"brgy"=>$_POST['brgy']);	
}else{
$temp[] = array("user_id"=>generateRandomString(9),
							"age"=>$_POST['age'],
							"sex"=>$_POST['sex'],
							"religion"=>$_POST['religion'],
							"marital_status"=>$_POST['marital_status'],
							"educ_level"=>$_POST['educ_level'],
							"region"=>$_POST['region'],
							"province"=>$_POST['province'],
							"city"=>$_POST['city'],
							"brgy"=>$_POST['brgy']);	
}

echo json_encode($temp);
?>