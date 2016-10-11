<?php
    if(isset($_POST['ifup_user_password']) && isset($_POST['ifup_user_email'])){
        if(!empty($_POST["ifup_user_password"]) && !empty($_POST["ifup_user_email"]) && filter_var($_POST['ifup_user_email'], FILTER_VALIDATE_EMAIL) == true){

            $_POST['ifup_user_password'] = md5($_POST['ifup_user_password']);

            include_once('model/user/select_user.php');
            $select_user = select_user($_POST["ifup_user_email"], $_POST['ifup_user_password']);
            if($select_user){
                $_SESSION["user"] = $select_user;

                include_once('model/user/select_user_filters.php');
                $select_user_filters = select_user_filters($_SESSION['user']['ifup_user_id']);

                include_once('model/user/select_user_districts.php');
                $select_user_districts = select_user_districts($_SESSION['user']['ifup_user_id']);

                $_SESSION["user"]['ifup_user_filters'] = $select_user_filters;
                $_SESSION["user"]['ifup_user_districts'] = $select_user_districts;

                $_SESSION['flash']['success'] = 'Bienvenue '. $_SESSION['user']['ifup_user_firstname'] . ' ' . $_SESSION['user']['ifup_user_lastname'] . ' !';
                header('Location: ?module=back&action=index');
                exit();
            }
            else{
                $_SESSION['flash']['danger'] = 'La connexion a échoué';
                header("Location:?module=front&action=index");
                exit();
            }
        }
        else{
            $_SESSION['flash']['danger'] = 'Certains champs sont incorrects. Veuillez réeassayer';
            header("Location: index.php?module=front&action=index");
            exit();
        }
    }
    else{
        include_once("view/404.php");
    }