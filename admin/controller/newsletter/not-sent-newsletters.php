<?php
    if(isset($_SESSION['admin'])){
        include_once('model/newsletter/count_contacts.php');
        $nbr_contacts = count_contacts();

        include_once('model/newsletter/select_not_sent_newsletters.php');
        $newsletters = select_not_sent_newsletters();

        include_once('view/newsletter/not-sent-newsletters.php');
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header('Location: index.php?module=user-admin&action=login');
        exit();
    }