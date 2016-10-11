<?php
    if(isset($_SESSION['admin'])){
        if(isset($_POST['ifup_filter_id'])){
            include_once('model/filter/archive_filter.php');
            $archive_filter = archive_filter($_POST['ifup_filter_id']);
            if($archive_filter && $archive_filter->rowCount() > 0){
                $_SESSION['flash']['success'] = 'Le filtre est supprimé avec succès.';
                header("location: index.php?module=filter&action=index");
                exit();
            }
            else{
                $_SESSION['flash']['danger'] = 'Nous n\'avons pas pu supprimer le filtre. Veuillez réessayer !';
                header("location: index.php?module=filter&action=index");
                exit();
            }
        }
        else{
            header("location: index.php?module=filter&action=index");
            exit();
        }
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header("Location: index.php?module=user-admin&action=login");
        exit();
    }