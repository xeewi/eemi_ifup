<?php


if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' &&
	$_POST['userID'] != "") {

	require('model/ajax/set-user-online.php');
	$online = setUserOnline($_POST['userID']);
	
	echo json_encode($online);

} else {
	echo json_encode('not here');
}
