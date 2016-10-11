<?php
    if(isset($_SESSION['admin'])){
        if(isset($_GET["user"])){
            include_once('model/user/select_current_user.php');
            $user = select_current_user($_GET["user"]);

            if(!$user){
                $_SESSION['flash']['warning'] = "Nous n'avons pas pu charger les informations de l'utilisateur.";
                header('Location: index.php?module=user&action=index');
                exit();
            }
            else{
                include_once('model/user/select_user_filters.php');
                $user_filters = select_user_filters($_GET["user"]);

                include_once('model/user/select_user_districts.php');
                $user_districts = select_user_districts($_GET["user"]);

                include_once('model/user/select_user_if_services.php');
                $user_if_services = select_user_if_services($_GET["user"]);

                include_once('model/user/select_user_up_services.php');
                $user_up_services = select_user_up_services($_GET["user"]);

                include_once('view/user/show-user.php');
            }
        }
        else{
            header('Location: index.php?module=user&action=index');
            exit();
        }
    }
    else {
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header('Location: index.php?module=user-admin&action=login');
        exit();
    }