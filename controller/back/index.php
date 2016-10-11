<?php
require('model/back/select_filters_noimg.php');
$filters = select_filters_noimg();

if ($filters != false) {
	include_once('view/back/index.php');
} else {
	$_SESSION['flash']['warning'] = 'Les filtres ne sont pas bien chargés. Veuillez réessayer.';
	header('Location: ?module=front');
}

