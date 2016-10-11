<?php
    if(isset($_SESSION['user'])){
        unset($_SESSION['user']);

        $_SESSION['flash']['success'] = 'vous êtes bien déconnecté !';
        header("location: index.php?module=front&action=index");
        exit();
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header("location: index.php?module=front&amp;action=index");
        exit();
    }