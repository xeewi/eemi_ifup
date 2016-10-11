<?php
if(isset($_SESSION['admin'])){
    if(isset($_GET["filter"])) {
        if (isset($_POST["submit_form_update_filter"])) {//verif if form is submitted
            if(isset($_POST["ifup_filter_name"]) && !empty($_POST["ifup_filter_name"])) {//verif if form is valid
                include_once('model/filter/update_filter.php');
                $update_filter = update_filter($_GET['filter'], $_POST);
                if ($update_filter) {//test insert the project
                    $_SESSION['flash']['success'] = 'La modification du filtre a été effectué avec succès !<br/>';
                } else {
                    $_SESSION['flash']['danger'] = 'La modification du nom a échoué !<br/>';
                }
            }
            else{
                $_SESSION['flash']['danger'] .= "Le filtre doit porter un nom. Veuillez en trouver un pour ce filtre.<br/>";
            }

            if(isset($_FILES['ifup_image_file']) && $_FILES["ifup_image_file"]['error'] == 0){
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

                    include_once('model/filter/update_image.php');
                    $update_image = update_image($upload_file_clean, $_POST["ifup_filter_image_id"]);
                    if($update_image && $update_image->rowCount() > 0){
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

            header("Location:?module=filter&action=update-filter&filter=" . $_GET["filter"]);
            exit();
        }
        else{
            include_once('model/filter/select_filter.php');
            $filter = select_filter($_GET['filter']);

            if(!$filter){
                $_SESSION['flash']['warning'] = "La page ne s'est pas chargée correctement. Nous n'avons pas pu récupérer les informations du filtre";
                header("Location:?module=filter&action=index");
                exit();
            }
            else {
                include_once('view/filter/update-filter.php');
            }
        }
    }
    else{
        header("Location: index.php?module=filter&action=index");
        exit();
    }
}
else{
    $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
    header('Location: index.php?module=user-admin&action=login');
    exit();
}
