<?php
    function insert_user_img($user_id, $img_file, $img_title="", $img_alt =""){
        try{
            global $bdd;
            //INSERT THE IMAGE :
            $insert = $bdd->prepare("INSERT INTO ifup_image(ifup_image_file, ifup_image_title, ifup_image_alt)
                                     VALUES(:ifup_image_file, :ifup_image_title, :ifup_image_alt)");

            $insert->bindParam(':ifup_image_file', $img_file, PDO::PARAM_STR);
            $insert->bindParam(':ifup_image_title',$img_title, PDO::PARAM_STR);
            $insert->bindParam(':ifup_image_alt',$img_alt, PDO::PARAM_STR);
            $insert->execute();

            //SET THE IMG ID TO THE USER :
            $update = $bdd->prepare("UPDATE ifup_user SET ifup_user_image_id=(SELECT ifup_image_id FROM ifup_image WHERE ifup_image_id=LAST_INSERT_ID())
                                     WHERE ifup_user_id=:ifup_user_id");

            $update->bindParam(':ifup_user_id',$user_id, PDO::PARAM_INT);
            $update->execute();
            return true;
        }
        catch (Exception $e){
            return false;
        }
    }