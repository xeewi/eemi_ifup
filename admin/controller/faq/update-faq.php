<?php
    if(isset($_SESSION['admin'])){
        if(isset($_GET["faq"])) {
            if (isset($_POST["submit_form_update_faq"])) {//verif if form is submitted
                if (!empty($_POST["ifup_faq_question"]) && !empty($_POST["ifup_faq_answer"]) && !empty($_POST["ifup_faq_category_id"])) {//verif if form is valid

                    include_once('model/faq/update_faq.php');
                    $update_faq = update_faq($_GET['faq'], $_POST);

                    if ($update_faq) {//test insert the project
                        $_SESSION['flash']['success'] = 'La modification de la FAQ a été effectué avec succès !';
                        header("Location:?module=faq&action=index");
                        exit();
                    } else {
                        $_SESSION['flash']['danger'] = 'La modification a échoué !';
                        header("Location:?module=faq&action=update-faq&faq=" . $_GET["faq"]);
                        exit();
                    }
                } else {
                    $_SESSION['flash']['danger'] = 'Certains champs sont incorrects. Veuillez réessayer';
                    header("Location:?module=faq&action=update-faq&faq=" . $_GET["faq"]);
                    exit();
                }
            } else {
                include_once('model/faq/select_faq_categories.php');
                $faq_cats = select_faq_categories();

                include_once('model/faq/select_faq.php');
                $faq = select_faq($_GET['faq']);

                if (!$faq_cats) {
                    $_SESSION['flash']['warning'] = 'La page ne s\est pas chargée correctement. Si l\'erreur persiste, vérifiez que vous avez bien ajouté des catégories pour les FAQs';
                    header("Location:?module=faq&action=index");
                    exit();
                }elseif(!$faq){
                    $_SESSION['flash']['warning'] = "La page ne s'est pas chargée correctement. Nous n'avons pas pu récupérer les informations de la FAQ";
                    header("Location:?module=faq&action=index");
                    exit();
                }
                else {
                    include_once('view/faq/update-faq.php');
                }
            }
        }
        else{
            header("Location:?module=faq&action=index");
            exit();
        }
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header('Location: index.php?module=user-admin&action=login');
        exit();
    }
