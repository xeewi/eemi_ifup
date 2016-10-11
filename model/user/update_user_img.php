<?php
    function update_user_img($img_file, $user_img_id){
        try{
            global $bdd;
            //SET THE new image path TO THE image row linked to the user :
            $update = $bdd->prepare("UPDATE ifup_image SET ifup_image_file=:ifup_image_file
                                     WHERE ifup_image_id=:ifup_image_id");

            $update->bindParam(':ifup_image_file', $img_file, PDO::PARAM_STR);
            $update->bindParam(':ifup_image_id', $user_img_id, PDO::PARAM_INT);
            $update->execute();
            return $update;
        }
        catch (Exception $e){
            return false;
        }
    }