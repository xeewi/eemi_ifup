<?php
    if(isset($_SESSION['admin'])){
        include_once('model/user/select_users.php');
        $users = select_users();
        include_once('view/user/index.php');
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header('Location: index.php?module=user-admin&action=login');
        exit();
    }