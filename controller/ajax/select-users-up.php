<?php


if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	require('model/ajax/get-user-connect.php');
	$user = getUserConnect();

	if ($user == false) {
		$err = "X_BDx2";
		echo json_encode($err);
	} else {
		echo json_encode($user);
	}

}
