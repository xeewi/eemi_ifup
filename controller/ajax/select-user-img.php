<?php

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	require('model/ajax/select-user-img.php');
	$img = selectUserImg($_POST['imageID']);

	if ($img == false) {
		$err = "X_BDx3";
		echo json_encode($err);
	} else {
		echo json_encode($img);
	}

}
