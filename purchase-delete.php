<?php
	include "config.php";
	$pid=$_GET['pid'];
	$mid=$_GET['mid'];
				
	$sql="DELETE FROM purchase where p_id='$pid'  and med_id='$mid'";

	if ($conn->query($sql))
	header("location:purchase-view.php");
	else
	echo "error";
?>