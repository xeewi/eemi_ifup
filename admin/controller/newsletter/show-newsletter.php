<?php
    if(isset($_SESSION['admin'])){
        if(isset($_GET["newsletter"])){
            include_once('model/newsletter/select_newsletter.php');
            $newsletter = select_newsletter($_GET["newsletter"]);

            if(!$newsletter){
                $_SESSION['flash']['warning'] = "Nous n'avons pas pu charger la newsletter.";
                header('Location: index.php?module=newsletter&action=index');
                exit();
            }
            else{
                include_once('view/newsletter/show-newsletter.php');
            }
        }
        else{
            header('Location: index.php?module=newsletter&action=index');
            exit();
        }
    }
    else {
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header('Location: index.php?module=user-admin&action=login');
        exit();
    }