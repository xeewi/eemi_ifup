<?php
    if(isset($_GET["token"]) && !isset($_POST["form_settings_submit"])){
        include_once("model/user/select_user_by_token.php");
        $user = select_user_by_token($_GET["token"]);
        if($user){

            $_SESSION['flash']['warning'] = null;

            $_SESSION["user"] = $user;

            include_once("model/back/select_districts.php");
            include_once("model/back/select_filters.php");
            $districts = select_districts();
            $filters = select_filters();

            if(!$districts){
                $_SESSION['flash']['warning'] .= "Les arrondissements n'ont pas été chargés correctement. Vous pouvez continuer ou réessayer.
                Si le problème persiste, vous pouvez toujours configurer vos informations dans votre espace.<br/>";
            }

            if(!$filters){
                $_SESSION['flash']['warning'] .= "Les filtres de service n'ont pas été chargés correctement. Vous pouvez continuer ou réessayer.
                Si le problème persiste, vous pouvez toujours configurer vos informations dans votre espace.<br/>";
            }

            include_once('view/user/first-settings.php');
        }
        else{
            $_SESSION['flash']['danger'] = "Votre token de confirmation n'est pas valide.";
            header("Location: index.php?module=front&action=index");
            exit();
        }
    }
    elseif(isset($_POST["form_settings_submit"]) && isset($_GET["token"])){
        // INSERT firstname,lastname,num,address

        $_SESSION['flash']['warning'] = null;
        $_SESSION['flash']['success'] = null;
        $_SESSION['flash']['danger'] = null;// pour concatener tous les warnings, danger, success

        if(isset($_POST['ifup_user_firstname']) && isset($_POST['ifup_user_lastname']) && isset($_POST['ifup_user_phone']) && isset($_POST['ifup_user_birthday']) && isset($_POST['ifup_user_time_rate'])){
            include_once("model/user/insert_user_information.php");
            $insert_user_information = insert_user_information($_SESSION["user"]["ifup_user_id"], $_POST);
            if($insert_user_information){
                // INSERT IMG :
                if(isset($_FILES['ifup_image_file']) && $_FILES['ifup_image_file']['error'] == 0){
                    $allowed_exts = ["png", "jpeg", "jpg"];
                    $content_dir = "assets/upload/";
                    $file = 'ifup_image_file';
                    //upload the img on the server
                    $upload_file = xp_upload_file($file, $allowed_exts, $content_dir, $max_size = 1000000, $width = 300, $height = 300);//return the path of the file ex : assets/upload/dehfize.jpg
                    if($upload_file)
                    {
                        //insert the img in the db and link it to the user
                        include_once("model/user/insert_user_img.php");
                        $insert_img = insert_user_img($_SESSION["user"]["ifup_user_id"], $upload_file, "votre image de profil", "votre image de profil");
                        if(!$insert_img){
                            //unlink($upload_file);// delete the image uploaded
                            $_SESSION['flash']['warning'] .= "Echec de l'ajout de votre image. Vous pouvez toujours l'ajouter dans le menu \"mon profil\"<br/>";
                        }
                    }
                    else{
                        $_SESSION['flash']['warning'] .= "Echec de l'ajout de votre image. Vous pouvez toujours l'ajouter dans le menu \"mon profil\"<br/>";
                    }
                }

                // INSERT FILTERS :
                if(isset($_POST["ifup_user_filters"]) && !empty($_POST["ifup_user_filters"])){
                    include_once("model/user/insert_user_filters.php");
                    $insert_user_filters = insert_user_filters($_SESSION['user']['ifup_user_id'], $_POST["ifup_user_filters"]);
                    if(!$insert_user_filters){
                        $_SESSION['flash']['warning'] .= "Echec de l'ajout de vos filtres. Vous pouvez toujours les ajouter dans le menu \"mes filtres\"<br/>";
                    }
                }

                // INSERT DISTRICTS :
                if(isset($_POST["ifup_user_districts"]) && !empty($_POST["ifup_user_districts"])){
                   /* if(count($_POST["ifup_user_districts"]) == 1){
                        $_POST["ifup_user_districts"] = array($_POST["ifup_user_districts"]);
                    }*/
                    include_once("model/user/insert_user_districts.php");
                    $insert_user_districts = insert_user_districts($_SESSION['user']['ifup_user_id'], $_POST["ifup_user_districts"]);
                    if(!$insert_user_districts){
                        $_SESSION['flash']['warning'] .= "Echec de l'ajout de vos arrondissements. Vous pouvez toujours les ajouter dans le menu \"mon profil\"<br/>";
                    }
                }

                // CONFIRM THE USER ACCOUNT :
                include_once("model/user/update_user_token.php");
                $update_user_token = update_user_token($_SESSION["user"]["ifup_user_id"]);
                if($update_user_token){
                    include_once("model/user/select_user.php");
                    $user = select_user($_SESSION["user"]["ifup_user_email"], $_SESSION["user"]["ifup_user_password"]);
                    if($user) {
                        $_SESSION["user"] = $user;

                        include_once('model/user/select_user_filters.php');
                        $select_user_filters = select_user_filters($_SESSION['user']['ifup_user_id']);

                        include_once('model/user/select_user_districts.php');
                        $select_user_districts = select_user_districts($_SESSION['user']['ifup_user_id']);

                        $_SESSION["user"]['ifup_user_filters'] = $select_user_filters;
                        $_SESSION["user"]['ifup_user_districts'] = $select_user_districts;

                        $_SESSION['flash']['success'] = "Vos données ont bien été sauvegardées.";
                        header("Location: index.php?module=back&action=index");
                        exit();
                    }
                    else{
                        $_SESSION['flash']['success'] = "Vos données ont bien été sauvegardées. Vous pouvez maintenant vous connecter.";
                        header("Location: index.php?module=front&action=index");
                        exit();
                    }
                }
                else{
                    $_SESSION['flash']['danger'] = "Echec de la confirmation de votre compte. Veuillez nous contacter pour déverrouiller votre compte.";
                    header("Location: index.php?module=front&action=index");
                    exit();
                }
            }
            else{
                $_SESSION['flash']['danger'] = "Vos données n'ont pas été sauvegardées.";
                header("Location: index.php?module=user&action=first-settings&token=". $_GET["token"]);
                exit();
            }
        }
        else{
            $_SESSION['flash']['danger'] = "Certains champs sont incorrects. Veuillez réessayer.";
            header("Location: index.php?module=user&action=first-settings&token=". $_GET["token"]);
            exit();
        }
    }
    else{
        $_SESSION['flash']['danger'] = "Vous ne pouvez pas accéder à cette partie du site";
        header("Location: index.php?module=front&action=index");
        exit();
    }
