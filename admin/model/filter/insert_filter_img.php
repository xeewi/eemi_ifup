<?php
    function insert_filter_img($img_file, $img_title="", $img_alt =""){
        try{
            global $bdd;
            //INSERT THE IMAGE :
            $insert = $bdd->prepare("INSERT INTO ifup_image(ifup_image_file, ifup_image_title, ifup_image_alt)
                                         VALUES(:ifup_image_file, :ifup_image_title, :ifup_image_alt)");

            $insert->bindParam(':ifup_image_file', $img_file, PDO::PARAM_STR);
            $insert->bindParam(':ifup_image_title',$img_title, PDO::PARAM_STR);
            $insert->bindParam(':ifup_image_alt',$img_alt, PDO::PARAM_STR);
            $insert->execute();

            return $insert;
        }
        catch (Exception $e){
            return false;
        }
    }