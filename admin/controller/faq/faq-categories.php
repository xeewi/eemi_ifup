<?php
    if(isset($_SESSION['admin'])){
        include_once('model/faq/select_faq_categories.php');
        $faq_cats = select_faq_categories();
        include_once('view/faq/faq-categories.php');
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header('Location: index.php?module=user-admin&action=login');
        exit();
    }