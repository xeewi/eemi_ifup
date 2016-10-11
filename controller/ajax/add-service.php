<?php


if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' &&
	$_POST['ifup_service_address'] != "" &&
	$_POST['ifup_service_message'] != "" &&
	$_POST['ifup_service_filter_id'] != "" &&
	$_POST['ifup_service_if_lat_len'] != "" &&
	$_POST['userID'] != "") {

	$service['ifup_service_address'] = $_POST['ifup_service_address'];
	$service['ifup_service_message'] = $_POST['ifup_service_message'];
	$service['ifup_service_filter_id'] = $_POST['ifup_service_filter_id'];
	$service['ifup_service_if_lat_len'] = $_POST['ifup_service_if_lat_len'];

	require('model/ajax/add-service.php');
	$add = addService($service, $_POST['userID']);
	
	echo json_encode($add);
} else {

	echo json_encode('not here');
}
