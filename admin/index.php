<?php
	include_once('../config/config.inc.php');
	//start session : security of session (against the vol)
	include_once("../core/core.php");
	if(!secu_session_start(SESSION_ADMIN_NAME)){
		include_once("view/404.php");
	}

	//include_once('../model/db-local.php');
    include_once('../model/db.php');

	if(!isset($_SESSION["admin"])){
        if(!isset($_GET['module']))
        {
            $module = 'user-admin';
        }else{
            $module = $_GET['module'];
        }

        if(!isset($_GET['action']))
        {
            $action = 'login';
        }else{
            $action = $_GET['action'];
        }
	}
	else{
		if(!isset($_GET['module']))
		{
			$module = 'home';
		}else{
			$module = $_GET['module'];
		}

		if(!isset($_GET['action']))
		{
			$action = 'index';
		}else{
			$action = $_GET['action'];
		}
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