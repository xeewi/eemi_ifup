<?php
    if(isset($_SESSION['admin'])){
        include_once('model/service/select_services.php');
        $services = select_services();
        include_once('view/service/index.php');
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header('Location: index.php?module=user-admin&action=login');
        exit();
    }