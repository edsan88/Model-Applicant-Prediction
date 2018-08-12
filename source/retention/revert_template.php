<?php
require('../config.php');
$sql = "UPDATE retention.consolidation_template SET consolidation_template.status = 0 
		WHERE consolidation_template.consolidation_template_id = '".$_POST['id']."'";
mysqli_query($link,$sql);
$s = "DELETE FROM retention.user_overall_response
		WHERE user_overall_response.consolidation_template_id = '".$_POST['id']."'";
mysqli_query($link,$s);
mysqli_close($link);
?>