<?php
    function update_image_news($img_id, $img_file, $img_title, $img_alt){
        try{
            global $bdd;
            //SET THE new image path TO THE image row linked to the user :
            $update = $bdd->prepare("UPDATE ifup_image SET ifup_image_file=:ifup_image_file,
                                                           ifup_image_title=:ifup_image_title,
                                                           ifup_image_alt=:ifup_image_alt
                                             WHERE ifup_image_id=:ifup_image_id");

            $update->bindParam(':ifup_image_file', $img_file, PDO::PARAM_STR);
            $update->bindParam(':ifup_image_title', $img_title, PDO::PARAM_STR);
            $update->bindParam(':ifup_image_alt', $img_alt, PDO::PARAM_STR);
            $update->bindParam(':ifup_image_id', $img_id, PDO::PARAM_INT);
            $update->execute();
            return $update;
        }
        catch (Exception $e){
            return false;
        }
    }