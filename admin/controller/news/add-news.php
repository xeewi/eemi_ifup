<?php
if(isset($_SESSION['admin'])){
    if(isset($_POST["submit_form_add_news"])){//verif if form is submitted
        if(!empty($_POST["ifup_news_title"])
            && !empty($_POST["ifup_news_content"])
            && isset($_FILES['ifup_image_file']) && $_FILES["ifup_image_file"]['error'] == 0
            && !empty($_POST["ifup_image_alt"])
            && !empty($_POST["ifup_image_title"])){//verif if form is valid

            include_once("model/news/insert_news.php");
            $insert_news = insert_news($_POST);
            if($insert_news && $insert_news->rowCount() > 0){
                //upload parameters :
                $allowed_exts = ["png", "jpeg", "jpg", "svg"];
                $content_dir = "../assets/upload/";
                $file = 'ifup_image_file';
                //upload the img on the server
                $upload_file = xp_upload_file($file, $allowed_exts, $content_dir, $max_size = 1000000, $width = 300, $height = 300);//return the path of the file ex : assets/upload/dehfize.jpg

                if($upload_file) {
                    /*================================================================================================
                    *****IMPORTANT - clean path of $upload_file (because we are not at the root of the website)*******
                    ================================================================================================*/
                    $divide_upload_file = explode('../',$upload_file);
                    $max = max(array_keys($divide_upload_file));
                    $upload_file_clean = $divide_upload_file[$max];//the path without the '../' !

                    //insert the img in the db :
                    include_once("model/news/insert_news_img.php");
                    $insert_news_img = insert_news_img($upload_file_clean, $_POST["ifup_image_title"], $_POST["ifup_image_alt"]);
                    if($insert_news_img && $insert_news_img->rowCount() > 0){
                        //link the last image inserted to the last filter inserted :
                        include_once("model/news/update_news_img_id.php");
                        $update_news_img_id = update_news_img_id();
                        if($update_news_img_id && $update_news_img_id->rowCount() > 0){
                            $_SESSION['flash']['success'] = "Succès de l'ajout de l'actualité.<br/>";
                            header("Location: index.php?module=news&action=index");
                            exit();
                        }
                        else{
                            //if no link between the image and the news :
                            include_once("model/news/delete_last_news.php");
                            delete_last_news();

                            include_once("model/news/delete_last_img.php");
                            delete_last_img();

                            unlink($upload_file);// delete the image uploaded (with a path like ../assets/upload/ieothreo.jpg

                            $_SESSION['flash']['danger'] = "Echec de l'ajout de l'actualité. Veuillez réessayer.<br/>";
                            header("Location: index.php?module=news&action=add-news");
                            exit();
                        }
                    }
                    else{
                        //if insert of the image failed :
                        include_once("model/news/delete_last_news.php");
                        delete_last_news();

                        unlink($upload_file);// delete the image uploaded (with a path like ../assets/upload/ieothreo.jpg

                        $_SESSION['flash']['danger'] = "Echec de l'ajout de l'actualité. Veuillez réessayer.<br/>";
                        header("Location: index.php?module=news&action=add-news");
                        exit();
                    }
                }
                else{
                    //if the upload failed :
                    include_once("model/news/delete_last_news.php");
                    delete_last_news();

                    $_SESSION['flash']['danger'] = "Echec de l'ajout de l'actualité. Veuillez réessayer. L'ajout de l'image a échoué (à cause du format ou de la taille)<br/>";
                    header("Location: index.php?module=news&action=add-news");
                    exit();
                }
            }
            else{
                //if the news insert failed :
                $_SESSION['flash']['danger'] = "Echec de l'ajout de l'actualité. Veuillez réessayer.<br/>";
                header("Location: index.php?module=news&action=add-news");
                exit();
            }
        }
        else{
            //if form is not valid :
            $_SESSION['flash']['danger'] = 'Certains champs sont incorrects. Veuillez réessayer';
            header("Location: index.php?module=news&action=add-news");
            exit();
        }
    }
    else{
        //if no POST :
        include_once('view/news/add-news.php');
    }
}
else{
    $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
    header('Location: index.php?module=user-admin&action=login');
    exit();
}