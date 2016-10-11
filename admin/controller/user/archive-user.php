<?php
    if(isset($_SESSION['admin'])){
        if(isset($_POST['ifup_user_id'])){
            include_once('model/user/archive_user.php');
            $archive_user = archive_user($_POST['ifup_user_id']);
            if($archive_user && $archive_user->rowCount() > 0){
                $_SESSION['flash']['success'] = "L'utilisateur est archivé avec succès.";
                header("location: index.php?module=user&action=index");
                exit();
            }
            else{
                $_SESSION['flash']['danger'] = "Nous n'avons pas pu archiver l'utilisateur. Veuillez réessayer !";
                header("location: index.php?module=user&action=index");
                exit();
            }
        }
        else{
            header("location: index.php?module=user&action=index");
            exit();
        }
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header("Location: index.php?module=user-admin&action=login");
        exit();
    }