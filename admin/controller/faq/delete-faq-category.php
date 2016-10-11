<?php
    if(isset($_SESSION["admin"])){
        if(isset($_POST["ifup_faq_category_id"])){
            include_once('model/faq/delete_faq_category.php');
            $delete_faq_category = delete_faq_category($_POST["ifup_faq_category_id"]);

            if($delete_faq_category && $delete_faq_category->rowCount() > 0){
                $_SESSION['flash']['success'] = 'La catégorie de faq a bien été supprimée ainsi que toutes les faqs qu\'elle contenait.';
                header("location: index.php?module=faq&action=faq-categories");
                exit();
            }
            else{
                $_SESSION['flash']['danger'] = 'Nous n\'avons pas pu supprimer la catégorie. Veuillez réessayer !';
                header("location: index.php?module=faq&action=faq-categories");
                exit();
            }
        }
        else{
            header("location: index.php?module=faq&action=faq-categories");
            exit();
        }
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header('Location: index.php?module=user-admin&action=login');
        exit();
    }