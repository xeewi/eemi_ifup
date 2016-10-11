<?php
    if(isset($_SESSION['user'])){
        include_once('model/user/archive_user.php');
        $archive_user = archive_user($_SESSION["user"]["ifup_user_id"]);
        if($archive_user && $archive_user->rowCount() > 0){
            unset($_SESSION['user']);

            $_SESSION['flash']['success'] = 'Votre compte a bien été supprimé <i class="fa fa-frown-o"></i> ! À bientôt';
            header("location: index.php?module=front&action=index");
            exit();
        }
        else{
            $_SESSION['flash']['danger'] = 'Nous n\'avons pas pu supprimer votre compte. Veuillez réessayer !';
            header("location: index.php?module=back&action=profile");
            exit();
        }
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header("Location: index.php?module=front&action=index");
        exit();
    }