<?php
    if(isset($_SESSION["admin"])){
        if(isset($_POST["ifup_service_id"])){
            include_once('model/service/delete_service.php');
            $delete_service = delete_service($_POST["ifup_service_id"]);

            if($delete_service && $delete_service->rowCount() > 0){
                $_SESSION['flash']['success'] = "Le service a bien été supprimée.";
                header("location: index.php?module=service&action=index");
                exit();
            }
            else{
                $_SESSION['flash']['danger'] = 'Nous n\'avons pas pu supprimer ce service. Veuillez réessayer !';
                header("location: index.php?module=service&action=index");
                exit();
            }
        }
        else{
            header("location: index.php?module=service&action=index");
            exit();
        }
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header('Location: index.php?module=user-admin&action=login');
        exit();
    }