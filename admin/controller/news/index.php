<?php
    if(isset($_SESSION['admin'])){
        include_once('model/news/select_all_news.php');
        $allNews = select_all_news();
        include_once('view/news/index.php');
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header('Location: index.php?module=user-admin&action=login');
        exit();
    }