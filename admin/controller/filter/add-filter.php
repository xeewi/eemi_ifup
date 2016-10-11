<?php
    if(isset($_SESSION['admin'])){
        if(isset($_POST["submit_form_add_filter"])){//verif if form is submitted
            if(!empty($_POST["ifup_filter_name"]) && isset($_FILES['ifup_image_file']) && $_FILES["ifup_image_file"]['error'] == 0){//verif if form is valid
                include_once("model/filter/insert_filter.php");
                $insert_filter = insert_filter($_POST["ifup_filter_name"]);
                if($insert_filter && $insert_filter->rowCount() > 0){
                    //upload parameters :
                    $allowed_exts = ["png", "jpeg", "jpg", "svg"];
                    $content_dir = "../assets/upload/";
                    $file = 'ifup_image_file';
                    //upload the img on the server
                    $upload_file = xp_upload_file($file, $allowed_exts, $content_dir, $max_size = 1000000, $width = 100, $height = 100);//return the path of the file ex : assets/upload/dehfize.jpg

                    if($upload_file) {
                        /*================================================================================================
                        *****IMPORTANT - clean path of $upload_file (because we are not at the root of the website********
                        ================================================================================================*/
                            $divide_upload_file = explode('../',$upload_file);
                            $max = max(array_keys($divide_upload_file));
                            $upload_file_clean = $divide_upload_file[$max];//the path without the '../' !

                        //insert the img in the db :
                        include_once("model/filter/insert_filter_img.php");
                        $insert_filter_img = insert_filter_img($upload_file_clean, $_POST["ifup_filter_name"], $_POST["ifup_filter_name"]);
                        if($insert_filter_img && $insert_filter_img->rowCount() > 0){
                            //link the last image inserted to the last filter inserted :
                            include_once("model/filter/update_filter_img_id.php");
                            $update_filter_img_id = update_filter_img_id();
                            if($update_filter_img_id && $update_filter_img_id->rowCount() > 0){
                                $_SESSION['flash']['success'] = "Succès de l'ajout du filtre.<br/>";
                                header("Location:?module=filter&action=index");
                                exit();
                            }
                            else{
                                //if no link between the image and the filter :
                                include_once("model/filter/delete_last_filter.php");
                                delete_last_filter();

                                include_once("model/filter/delete_last_img.php");
                                delete_last_img();

                                unlink($upload_file);// delete the image uploaded (with a path like ../assets/upload/ieothreo.jpg

                                $_SESSION['flash']['danger'] = "Echec de l'ajout du filtre. Veuillez réessayer.<br/>";
                                header("Location:?module=filter&action=add-filter");
                                exit();
                            }
                        }
                        else{
                            //if insert of the image failed :
                            include_once("model/filter/delete_last_filter.php");
                            delete_last_filter();

                            unlink($upload_file);// delete the image uploaded (with a path like ../assets/upload/ieothreo.jpg

                            $_SESSION['flash']['danger'] = "Echec de l'ajout du filtre. Veuillez réessayer.<br/>";
                            header("Location:?module=filter&action=add-filter");
                            exit();
                        }
                    }
                    else{
                        //if the upload failed :
                        include_once("model/filter/delete_last_filter.php");
                        delete_last_filter();

                        $_SESSION['flash']['danger'] = "Echec de l'ajout du filtre. Veuillez réessayer.<br/>";
                        header("Location:?module=filter&action=add-filter");
                        exit();
                    }
                }
                else{
                    //if the filter insert failed :
                    $_SESSION['flash']['danger'] = "Echec de l'ajout du filtre. Veuillez réessayer.<br/>";
                    header("Location:?module=filter&action=add-filter");
                    exit();
                }
            }
            else{
                //if form is not valid :
                $_SESSION['flash']['danger'] = 'Certains champs sont incorrects. Veuillez réessayer';
                header("Location:?module=filter&action=add-filter");
                exit();
            }
        }
        else{
            //if no POST :
            include_once('view/filter/add-filter.php');
        }
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header('Location: index.php?module=user-admin&action=login');
        exit();
    }