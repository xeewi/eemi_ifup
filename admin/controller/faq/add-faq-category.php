<?php
    if(isset($_SESSION['admin'])){
        if(isset($_POST["submit_form_add_faq_category"])){//verif if form is submitted
            if(!empty($_POST["ifup_faq_category_title"])){//verif if form is valid

                include_once('model/faq/insert_faq_category.php');
                $insert_faq_category = insert_faq_category($_POST);

                if($insert_faq_category && $insert_faq_category->rowCount() > 0){//test insert the project
                    $_SESSION['flash']['success'] = 'L\'ajout de la catégorie de FAQ a été effectué avec succès !';
                    header("Location: index.php?module=faq&action=faq-categories");
                    exit();
                }
                else{
                    $_SESSION['flash']['danger'] = 'L\'ajout a échoué !';
                    header("Location: index.php?module=faq&action=add-faq-category");
                    exit();
                }
            }
            else{
                $_SESSION['flash']['danger'] = 'Veuillez donner un nom à la catégorie. Veuillez réessayer.';
                header("Location: index.php?module=faq&action=add-faq-category");
                exit();
            }
        }
        else{
            include_once('view/faq/add-faq-category.php');
        }
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header('Location: index.php?module=user-admin&action=login');
        exit();
    }