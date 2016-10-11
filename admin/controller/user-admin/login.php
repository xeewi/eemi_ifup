<?php
    if(isset($_POST['ifup_user_admin_password']) && isset($_POST['ifup_user_admin_email'])){
        if(!empty($_POST["ifup_user_admin_password"]) && !empty($_POST["ifup_user_admin_email"]) && filter_var($_POST['ifup_user_admin_email'], FILTER_VALIDATE_EMAIL) == true){

            $_POST['ifup_user_admin_password'] = md5($_POST['ifup_user_admin_password']);

            include_once('model/user-admin/select_user_admin.php');
            $select_user_admin = select_user_admin($_POST["ifup_user_admin_email"], $_POST['ifup_user_admin_password']);
            if($select_user_admin){
                $_SESSION["admin"] = $select_user_admin;

                $_SESSION['flash']['success'] = 'Bienvenue '. $_SESSION['admin']['ifup_user_admin_firstname'] . ' ' . $_SESSION['admin']['ifup_user_admin_lastname'] . ' !';
                header('Location: index.php?module=home&action=index');
                exit();
            }
            else{
                $_SESSION['flash']['danger'] = 'La connexion a échoué';
                header("Location:index.php?module=user-admin&action=login");
                exit();
            }
        }
        else{
            $_SESSION['flash']['danger'] = 'Certains champs sont incorrects. Veuillez réessayer';
            header("Location:index.php?module=user-admin&action=login");
            exit();
        }
    }
    else{
        include_once("view/user-admin/login.php");
    }