<?php


if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' &&
	$_POST['ifup_service_id'] != "") {

	require('model/ajax/set-service-finish.php');
	$now = setServiceFinish($_POST['ifup_service_id']);
	
	echo json_encode($now);

} else {
	echo json_encode('not here');
}
