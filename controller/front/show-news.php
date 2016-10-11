<?php
    if(isset($_GET['news-id'])){
        include_once('model/front/select_current_news.php');
        $currentNews = select_current_news($_GET['news-id']);

        if($currentNews){
            include_once('view/front/show-news.php');
        }
        else{
            if(!isset($_GET["page"])){
                $_GET["page"] = 1;
            }
            $_SESSION['flash']['danger'] = "Nous n'avons pas pu afficher l'article. Veuillez réessayer.";
            header("Location: index.php?module=front&action=all-news&page=". $_GET["page"]);
            exit();
        }
    }
    else{
        header("Location:?module=front&action=all-news");
        exit();
    }