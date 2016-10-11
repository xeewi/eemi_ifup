<?php
    function insert_user_information($user_id, $form_settings){
        try{
            global $bdd;

            //no update of email
            $insert = $bdd->prepare("UPDATE ifup_user SET ifup_user_firstname=:ifup_user_firstname,
                                                              ifup_user_lastname=:ifup_user_lastname,
                                                              ifup_user_phone=:ifup_user_phone,
                                                              ifup_user_birthday=:ifup_user_birthday,
                                                              ifup_user_time_rate=:ifup_user_time_rate,
                                                              ifup_user_biography=:ifup_user_biography
                                         WHERE ifup_user_id = :ifup_user_id");

            $insert->bindParam(':ifup_user_firstname', $form_settings["ifup_user_firstname"], PDO::PARAM_STR);
            $insert->bindParam(':ifup_user_lastname',$form_settings["ifup_user_lastname"], PDO::PARAM_STR);
            $insert->bindParam(':ifup_user_phone',$form_settings["ifup_user_phone"], PDO::PARAM_STR);
            $insert->bindParam(':ifup_user_birthday',$form_settings["ifup_user_birthday"], PDO::PARAM_STR);
            $insert->bindParam(':ifup_user_time_rate',$form_settings["ifup_user_time_rate"], PDO::PARAM_INT);
            $insert->bindParam(':ifup_user_biography',$form_settings["ifup_user_biography"], PDO::PARAM_STR);

            $insert->bindParam(':ifup_user_id',$user_id, PDO::PARAM_INT);

            $insert->execute();
            return true;
        }
        catch (Exception $e){
            return false;
        }
    }