<?php
    if(isset($_SESSION['admin'])){
        if(isset($_POST["submit_form_add_faq"])){//verif if form is submitted
            if(!empty($_POST["ifup_faq_question"]) && !empty($_POST["ifup_faq_answer"]) && !empty($_POST["ifup_faq_category_id"])){//verif if form is valid

                include_once('model/faq/insert_faq.php');
                $insert_faq = insert_faq($_POST);

                if($insert_faq){//test insert the project
                    $_SESSION['flash']['success'] = 'L\'ajout de la FAQ a été effectué avec succès !';
                    header("Location:?module=faq&action=index");
                    exit();
                }
                else{
                    $_SESSION['flash']['danger'] = 'L\'ajout a échoué !';
                    header("Location:?module=faq&action=add-faq");
                    exit();
                }
            }
            else{
                $_SESSION['flash']['danger'] = 'Certains champs sont incorrects. Veuillez réessayer';
                header("Location:?module=faq&action=add-faq");
                exit();
            }
        }
        else{
            include_once('model/faq/select_faq_categories.php');
            $faq_cats = select_faq_categories();
            if(!$faq_cats){
                $_SESSION['flash']['warning'] = 'Pour ajouter une FAQ vérifiez que vous avez bien ajouté des catégories de FAQ : <a href="index.php?module=faq&action=add-faq-category">Ajouter une catégorie de FAQ</a>';
                header("Location: index.php?module=home&action=index");
                exit();
            }else{
                include_once('view/faq/add-faq.php');
            }
        }
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header('Location: index.php?module=user-admin&action=login');
        exit();
    }
