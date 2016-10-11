<?php


if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' &&
	$_POST['userID'] != "") {

	require('model/ajax/set-user-iffer.php');
	$iffer = setUserIffer($_POST['userID']);
	
	echo json_encode($iffer);

} else {
	echo json_encode('not here');
}
