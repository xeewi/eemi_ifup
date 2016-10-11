<?php

function getUserConnect(){
	if (isset($_SESSION['user'])) {
		return $_SESSION['user'];
	} else {
		return false;
	}
}