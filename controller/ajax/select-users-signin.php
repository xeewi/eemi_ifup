<?php


if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	require('model/ajax/select-users-signin.php');
	$users = selectUsersSignin($_POST['filterID']);

	if ($users == false) {
		$err = "Error no users";
		echo json_encode($err);
	} else {
		$count = count($users);
		echo json_encode($count);
	}

}
