<?php
    include_once('model/front/count_news.php');
    $nbrNews = count_news();

    if(isset($_GET["page"])){
        $page = $_GET["page"];
    }else{
        $page = 1;
    }


    include_once('model/front/select_all_news.php');
    $allNews = select_all_news( (($page-1) * NEWS_PER_PAGE), NEWS_PER_PAGE);

    if($allNews){
        include_once('view/front/all-news.php');
    }
    else{
        $_SESSION['flash']['danger'] = "Nous n'avons pas pu afficher les actualités. Veuillez réessayer.";
        header("Location: index.php?module=front&action=index");
        exit();
    }
