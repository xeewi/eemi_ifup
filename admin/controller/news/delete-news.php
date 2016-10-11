<?php
    if(isset($_SESSION["admin"])){
        if(isset($_POST["ifup_news_id"])){
            include_once('model/news/delete_news.php');
            $delete_news = delete_news($_POST["ifup_news_id"]);

            if($delete_news && $delete_news->rowCount() > 0){
                $_SESSION['flash']['success'] = "L'actualité a bien été supprimée.";
                header("location: index.php?module=news&action=index");
                exit();
            }
            else{
                $_SESSION['flash']['danger'] = 'Nous n\'avons pas pu supprimer cette actualité. Veuillez réessayer !';
                header("location: index.php?module=news&action=index");
                exit();
            }
        }
        else{
            header("location: index.php?module=news&action=index");
            exit();
        }
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header('Location: index.php?module=user-admin&action=login');
        exit();
    }