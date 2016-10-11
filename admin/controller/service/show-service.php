<?php
    if(isset($_SESSION['admin'])){
        if(isset($_GET["service"])){
            include_once('model/service/select_service.php');
            $service = select_service($_GET["service"]);

            if(!$service){
                $_SESSION['flash']['warning'] = "Nous n'avons pas pu charger les informations de ce service.";
                header('Location: index.php?module=service&action=index');
                exit();
            }
            else{
                include_once('model/service/select_user_iffer.php');
                $user_iffer = select_user_iffer($_GET["service"]);

                include_once('model/service/select_user_upper.php');
                $user_upper = select_user_upper($_GET["service"]);

                include_once('view/service/show-service.php');
            }
        }
        else{
            header('Location: index.php?module=service&action=index');
            exit();
        }
    }
    else {
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header('Location: index.php?module=user-admin&action=login');
        exit();
    }