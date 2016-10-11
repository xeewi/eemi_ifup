<?php
    if(isset($_SESSION['admin'])){
        include_once('model/filter/select_filters.php');
        $filters = select_filters();
        include_once('view/filter/index.php');
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header('Location: index.php?module=user-admin&action=login');
        exit();
    }