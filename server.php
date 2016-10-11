<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


require('lib/SplClassLoader.php');

$classLoader = new SplClassLoader('WebSocket', 'lib');
$classLoader->register();

use \WebSocket\Server;

$server = new Server('dev.etudiant-eemi.com', 8000, false);

// server settings:
$server->setMaxClients(100);
$server->setCheckOrigin(true);
$server->setAllowedOrigin('localhost');
$server->setAllowedOrigin('dev.etudiant-eemi.com');
$server->setAllowedOrigin('gautierg.etudiant-eemi.com');
$server->setMaxConnectionsPerIp(100);
$server->setMaxRequestsPerMinute(2000);

// Hint: Status application should not be removed as it displays usefull server informations:
$server->registerApplication('status', \WebSocket\Application\StatusApplication::getInstance());
$server->registerApplication('ifup', \WebSocket\Application\IfUpApp::getInstance());

$server->run();
