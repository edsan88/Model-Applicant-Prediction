<?php
require('../config.php');
$sql = "DELETE FROM retention.dimensions WHERE dimensions.dimensions_id = '".$_POST['id']."'";
$data = mysqli_query($link,$sql);
mysqli_close($link);
?>