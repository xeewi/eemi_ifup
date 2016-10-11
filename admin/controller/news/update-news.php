<?php
if(isset($_SESSION['admin'])){
    if(isset($_GET["news"])) {
        if (isset($_POST["submit_form_update_news"])) {//verif if form is submitted

            //UPDATE NEWS TITLE AND CONTENT
            if(isset($_POST["ifup_news_title"]) && !empty($_POST["ifup_news_title"]) && isset($_POST["ifup_news_content"]) && !empty($_POST["ifup_news_content"])) {//verif if form is valid
                include_once('model/news/update_news.php');
                $update_news = update_news($_GET['news'], $_POST);
                if ($update_news) {//test insert the project
                    $_SESSION['flash']['success'] = "La modification de l'actualité a été effectué avec succès !<br/>";
                } else {
                    $_SESSION['flash']['danger'] = "La modification de l'actualité a échoué !<br/>";
                }
            }
            else{
                $_SESSION['flash']['danger'] .= "L'actualité doit avoir un titre et un contenu. Veuillez les ajouter.<br/>";
            }

            //UPDATE IMAGE :
            if(isset($_FILES['ifup_image_file']) && $_FILES["ifup_image_file"]['error'] == 0){
                if(!empty($_POST["ifup_image_title"]) && !empty($_POST["ifup_image_alt"])){
                    //upload parameters :
                    $allowed_exts = ["png", "jpeg", "jpg", "svg"];
                    $content_dir = "../assets/upload/";
                    $file = 'ifup_image_file';
                    //upload the img on the server
                    $upload_file = xp_upload_file($file, $allowed_exts, $content_dir, $max_size = 1000000, $width = 100, $height = 100);//return the path of the file ex : assets/upload/dehfize.jpg

                    if($upload_file){
                        /*================================================================================================
                        *****IMPORTANT - clean path of $upload_file (because we are not at the root of the website********
                        ================================================================================================*/
                        $divide_upload_file = explode('../',$upload_file);
                        $max = max(array_keys($divide_upload_file));
                        $upload_file_clean = $divide_upload_file[$max];//the path without the '../' !

                        include_once('model/news/update_image_news.php');
                        $update_image_news = update_image_news($_POST["ifup_news_image_id"], $upload_file_clean, $_POST["ifup_image_title"], $_POST["ifup_image_alt"]);
                        if($update_image_news && $update_image_news->rowCount() > 0){
                            unlink("../" . $_POST["ifup_image_file"]);// delete the old image
                            $_SESSION['flash']['success'] .= "Image modifiée avec succès.<br/>";
                        }
                        else{
                            unlink($upload_file);// delete the image uploaded
                            $_SESSION['flash']['danger'] .= "Echec de l'upload de l'image. Veuillez réessayer.<br/>";
                        }
                    }
                    else{
                        $_SESSION['flash']['danger'] .= "Echec de l'upload de l'image. Veuillez réessayer.<br/>";
                    }
                }
                else{
                    $_SESSION['flash']['danger'] .= "Veuillez renseigner le titre et le texte alternatif de l'image pour la modifier.<br/>";
                }
            }

            header("Location: index.php?module=news&action=update-news&news=" . $_GET["news"]);
            exit();
        }
        else{
            include_once('model/news/select_current_news.php');
            $news = select_current_news($_GET['news']);

            if(!$news){
                $_SESSION['flash']['warning'] = "La page ne s'est pas chargée correctement. Nous n'avons pas pu récupérer les informations de l'actualité";
                header("Location: index.php?module=news&action=index");
                exit();
            }
            else {
                include_once('view/news/update-news.php');
            }
        }
    }
    else{
        header("Location: index.php?module=news&action=index");
        exit();
    }
}
else{
    $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
    header('Location: index.php?module=user-admin&action=login');
    exit();
}
