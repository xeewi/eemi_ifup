<?php
	try
	{
		$bdd = new PDO('mysql:host=dev.etudiant-eemi.com;dbname=gautierg;charset=utf8',
						'gautierg',
						'149073',
						array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e)
	{
		die('Erreur :'.$e->getMessage());
	}
