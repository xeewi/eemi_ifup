<?php
	include_once('config/config.inc.php');
	//start session : security of session (against the vol)
	include_once("core/core.php");
	if(!secu_session_start(SESSION_NAME)){
		include_once("view/404.php");
	}

	include_once('model/db-local.php');
	//include_once('model/db.php');

	if (!isset($_GET['module'])) {
		$module = 'front';
	} else if ($_GET['module'] == "back"){
		if (isset($_SESSION['user'])) {
			$module = 'back';
		} else {
			$module = 'front';
		}
	} else {
		$module = $_GET['module'];
	}

	if (!isset($_GET['action'])) {
		$action = 'index';
	} else {
		$action = $_GET['action'];
	}

    $url = 'controller/'. $module . '/'. $action . '.php';

	if(file_exists($url))
	{
		include_once($url);
	}
	else
	{
		include_once('view/404.php');
	}
