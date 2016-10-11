<?php
    if(isset($_SESSION["admin"])){
        if(isset($_POST["ifup_faq_id"])){
            include_once('model/faq/delete_faq.php');
            $delete_faq = delete_faq($_POST["ifup_faq_id"]);

            if($delete_faq && $delete_faq->rowCount() > 0){
                $_SESSION['flash']['success'] = 'La FAQ a bien été supprimée.';
                header("location: index.php?module=faq&action=index");
                exit();
            }
            else{
                $_SESSION['flash']['danger'] = 'Nous n\'avons pas pu supprimer la FAQ. Veuillez réessayer !';
                header("location: index.php?module=faq&action=index");
                exit();
            }
        }
        else{
            header("location: index.php?module=faq&action=index");
            exit();
        }
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header('Location: index.php?module=user-admin&action=login');
        exit();
    }