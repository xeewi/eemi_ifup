<?php
    if(isset($_SESSION['admin'])){
        include_once('model/faq/select_faqs.php');
        $faqs = select_faqs();
        include_once('view/faq/index.php');
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header('Location: index.php?module=user-admin&action=login');
        exit();
    }