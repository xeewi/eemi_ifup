<?php
if(isset($_SESSION['user'])){
    if(isset($_POST['submit_form_settings'])){
        // UPDATE FILTERS :
            include_once("model/user/delete_user_filters.php");
            $delete_user_filters = delete_user_filters($_SESSION['user']['ifup_user_id']);
            if($delete_user_filters){
                if(isset($_POST["ifup_user_filters"]) && !empty($_POST["ifup_user_filters"])){
                    include_once("model/user/insert_user_filters.php");
                    $insert_user_filters = insert_user_filters($_SESSION['user']['ifup_user_id'], $_POST["ifup_user_filters"]);
                    if($insert_user_filters){
                        include_once('model/user/select_user_filters.php');
                        $select_user_filters = select_user_filters($_SESSION['user']['ifup_user_id']);

                        $_SESSION['user']['ifup_user_filters'] = $select_user_filters;

                        $_SESSION['flash']['success'] .= "Succès de l'ajout de vos filtres.<br/>";
                    }
                    else{
                        $_SESSION['flash']['danger'] .= "Echec de l'ajout de vos filtres.<br/>";
                    }
                }
                else{
                    $_SESSION['user']['ifup_user_filters'] = NULL;

                    $_SESSION['flash']['success'] .= "Succès de la suppression de vos filtres.<br/>";
                }
            }
            else{
                $_SESSION['flash']['danger'] .= "Echec de l'ajout de vos filtres.<br/>";
            }


        // UPDATE DISTRICTS :
            include_once("model/user/delete_user_districts.php");
            $delete_user_districts = delete_user_districts($_SESSION['user']['ifup_user_id']);
            if($delete_user_districts){
                if(isset($_POST["ifup_user_districts"]) && !empty($_POST["ifup_user_districts"])) {
                    include_once("model/user/insert_user_districts.php");
                    $insert_user_districts = insert_user_districts($_SESSION['user']['ifup_user_id'], $_POST["ifup_user_districts"]);
                    if ($insert_user_districts) {
                        include_once('model/user/select_user_districts.php');
                        $select_user_districts = select_user_districts($_SESSION['user']['ifup_user_id']);

                        $_SESSION['user']['ifup_user_districts'] = $select_user_districts;

                        $_SESSION['flash']['success'] .= "Succès de l'ajout de vos arrondissements.<br/>";
                    } else {
                        $_SESSION['flash']['danger'] .= "Echec de l'ajout de vos arrondissements.<br/>";
                    }
                }
                else{
                    $_SESSION['user']['ifup_user_districts'] = NULL;

                    $_SESSION['flash']['success'] .= "Succès de la suppression de vos arrondissements.<br/>";
                }
            }
            else{
                $_SESSION['flash']['danger'] .= "Echec de l'ajout de vos arrondissements.<br/>";
            }


        header("Location: index.php?module=back&action=settings");
        exit();
    }
    else{
        include_once("model/back/count_districts.php");
        $nbrDistricts = count_districts();

        include_once("model/back/select_districts.php");
        $districts = select_districts();

        include_once("model/back/select_filters.php");
        $filters = select_filters();

        if($districts == true && $filters == true){
            include_once('view/back/settings.php');
        }
        else{
            $_SESSION['flash']['danger'] = "Vos informations de compte n'ont pas été bien chargées. Veuillez réessayer.";
            header("Location: index.php?module=back&action=index");
            exit();
        }
    }
}
else{
    $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
    header("Location: index.php?module=front&action=index");
    exit();
}
