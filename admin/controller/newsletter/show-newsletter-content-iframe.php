<?php
    if(isset($_GET["newsletter"])){
        include_once('model/newsletter/select_newsletter.php');
        $newsletter = select_newsletter($_GET["newsletter"]);
        if(!$newsletter){
            echo 'Nous avons pas pu afficher le contenu de la newsletter. Veuillez réessayer.';
        }else{
            include_once('view/newsletter/show-newsletter-content-iframe.php');
        }
    }else{
        echo 'Nous avons pas pu afficher le contenu de la newsletter. Veuillez réessayer.';
    }
