<?php
    if(isset($_SESSION['admin'])){
        if(isset($_GET["faq-cat"])) {
            if (isset($_POST["submit_form_update_faq_category"])) {//verif if form is submitted
                if (!empty($_POST["ifup_faq_category_title"])) {//verif if form is valid

                    include_once('model/faq/update_faq_category.php');
                    $update_faq_category = update_faq_category($_GET['faq-cat'], $_POST);

                    if ($update_faq_category) {//test insert the project
                        $_SESSION['flash']['success'] = 'La modification de la catégorie a été effectué avec succès !';
                        header("Location: index.php?module=faq&action=faq-categories");
                        exit();
                    } else {
                        $_SESSION['flash']['danger'] = 'La modification a échoué !';
                        header("Location: index.php?module=faq&action=update-faq-category&faq-cat=" . $_GET["faq-cat"]);
                        exit();
                    }
                }
                else {
                    $_SESSION['flash']['danger'] = 'Veuillez renseigner le nom de la catégorie pour continuer.';
                    header("Location: index.php?module=faq&action=update-faq-category&faq-cat=" . $_GET["faq-cat"]);
                    exit();
                }
            }
            else {
                include_once('model/faq/select_faq_category.php');
                $faq_cat = select_faq_category($_GET['faq-cat']);

                if(!$faq_cat){
                    $_SESSION['flash']['warning'] = "La page ne s'est pas chargée correctement. Nous n'avons pas pu récupérer les informations de la catégorie";
                    header("Location:?module=faq&action=index");
                    exit();
                }
                else {
                    include_once('view/faq/update-faq-category.php');
                }
            }
        }
        else{
            header("Location: index.php?module=faq&action=faq-categories");
            exit();
        }
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header('Location: index.php?module=user-admin&action=login');
        exit();
    }
