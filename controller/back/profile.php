<?php
if(isset($_SESSION['user'])){
    if(isset($_POST["submit_form_profile"])){

        // INSERT IMG :
        if(isset($_FILES['ifup_image_file']) && $_FILES["ifup_image_file"]['error'] == 0){
            $allowed_exts = ["png", "jpeg", "jpg"];
            $content_dir = "assets/upload/";
            $file = 'ifup_image_file';
            //upload the img on the server
            $upload_file = xp_upload_file($file, $allowed_exts, $content_dir, $max_size = 1000000, $width = 300, $height = 300);//return the path of the file ex : assets/upload/dehfize.jpg

            if($upload_file) {
                /*==============================================================
                ---------- IF ifup_user_img_id != NULL !!!!!!!!!----------------
                ==============================================================*/
                if($_SESSION['user']['ifup_user_image_id'] != null){
                    include_once("model/user/update_user_img.php");
                    $update_user_img = update_user_img($upload_file, $_SESSION["user"]["ifup_user_image_id"]);
                    if($update_user_img && $update_user_img->rowCount()> 0){

                        unlink($_SESSION["user"]["ifup_image_file"]);// delete the old img;

                        $_SESSION["user"]["ifup_image_file"] = $upload_file;

                        $_SESSION['flash']['success'] .= "Image de profil mise à jour !<hr/>";
                    }
                    else{
                        unlink($upload_file);// delete the image uploaded

                        $_SESSION['flash']['danger'] .= "Echec de l'ajout de votre nouvelle image de profil. Veuillez réessayer.<br/>";
                    }
                }
                else{
                    //insert the img in the db and link it to the user (insert img + update user_img_id)
                    include_once("model/user/insert_user_img.php");
                    $insert_img = insert_user_img($_SESSION["user"]["ifup_user_id"], $upload_file, "votre image de profil", "votre image de profil");
                    if($insert_img){
                        include_once('model/user/select_user_img.php');
                        $select_user_img = select_user_img($_SESSION["user"]["ifup_user_id"]);//to add user img data to the session !

                        if($select_user_img){
                            $_SESSION["user"]["ifup_user_image_id"] = $select_user_img['ifup_user_image_id'];
                            $_SESSION["user"]["ifup_image_id"] = $select_user_img['ifup_image_id'];
                            $_SESSION["user"]["ifup_image_file"] = $select_user_img['ifup_image_file'];
                            $_SESSION["user"]["ifup_image_title"] = $select_user_img['ifup_image_title'];
                            $_SESSION["user"]["ifup_image_alt"] = $select_user_img['ifup_image_alt'];

                            $_SESSION['flash']['success'] .= "Image de profil ajoutée à votre compte !<br/>";
                        }
                        else{
                            $_SESSION['flash']['success'] .= "Image de profil ajoutée à votre compte ! Elle sera mise à jour à la prochaine connexion.<br/>";
                        }
                    }
                    else{
                        unlink($upload_file);// delete the image uploaded

                        $_SESSION['flash']['danger'] .= "Echec de l'ajout de votre nouvelle image de profil. Veuillez réessayer.<br/>";
                    }
                }
            }
            else{
                $_SESSION['flash']['danger'] .= "Echec de l'upload de l'image. Veuillez réessayer.<br/>";
            }
        }

        if(isset($_POST['ifup_user_firstname']) && isset($_POST['ifup_user_lastname']) && isset($_POST['ifup_user_phone']) && isset($_POST['ifup_user_email']) && isset($_POST['ifup_user_time_rate']) && isset($_POST['ifup_user_birthday']) ){
            if(!empty($_POST['ifup_user_firstname']) && !empty($_POST['ifup_user_lastname']) && !empty($_POST['ifup_user_phone']) && !empty($_POST['ifup_user_email']) && filter_var($_POST['ifup_user_email'], FILTER_VALIDATE_EMAIL) ){
                include_once('model/user/update_user_information.php');
                $update_user_information = update_user_information($_SESSION['user']['ifup_user_id'], $_POST);
                if($update_user_information){

                    $_SESSION["user"]["ifup_user_firstname"] = $_POST['ifup_user_firstname'];
                    $_SESSION["user"]["ifup_user_lastname"] = $_POST['ifup_user_lastname'];
                    $_SESSION["user"]["ifup_user_phone"] = $_POST['ifup_user_phone'];
                    $_SESSION["user"]["ifup_user_email"] = $_POST['ifup_user_email'];

                    $_SESSION["user"]["ifup_user_birthday"] = $_POST['ifup_user_birthday'];
                    $_SESSION["user"]["ifup_user_time_rate"] = $_POST['ifup_user_time_rate'];
                    $_SESSION["user"]["ifup_user_biography"] = $_POST['ifup_user_biography'];

                    $_SESSION['flash']['success'] .= "Informations mises à jour !<br/>";
                }
                else{
                    $_SESSION['flash']['success'] .= "Echec de modification de vos informations !<br/>";
                }
            }
            else{
                $_SESSION['flash']['danger'] .= "Certains champs sont incorrects ou vides. Veuillez les corriger ou les remplir.<br/>";
            }
        }

        header("Location: index.php?module=back&action=profile");
        exit();
    }
    elseif(isset($_POST['submit_update_password'])){
        if(!empty($_POST["ifup_user_password"]) && $_POST["ifup_user_password"] == $_POST["ifup_user_confirm_password"]){

            $_POST["ifup_user_password"] = md5($_POST["ifup_user_password"]);

            include_once('model/user/update_user_password.php');
            $update_user_password = update_user_password($_SESSION['user']['ifup_user_id'], $_POST["ifup_user_password"]);
            if($update_user_password && $update_user_password->rowCount() > 0){

                $_SESSION['user']['ifup_user_password'] = $_POST["ifup_user_password"];

                $_SESSION['flash']['success'] = "Mot de passe modifié avec succès !";
                header("Location: index.php?module=back&action=profile");
                exit();
            }
            else{
                $_SESSION['flash']['danger'] = "Echec de la modification de votre mot de passe. Veuillez réessayer.";
                header("Location: index.php?module=back&action=profile");
                exit();
            }
        }
    }
    else{
        include_once('view/back/profile.php');
    }
}
else{
    $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
    header("Location: index.php?module=front&action=index");
    exit();
}
