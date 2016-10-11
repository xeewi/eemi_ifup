<?php
    function insert_user($form_register, $token){
        try{
            global $bdd;

            $insert = $bdd->prepare("INSERT INTO ifup_user (ifup_user_email, ifup_user_password, ifup_user_confirmation_token, ifup_user_register_date)
                                    VALUES (:ifup_user_email, :ifup_user_password, :ifup_user_confirmation_token, NOW())");

            $insert->bindParam(':ifup_user_email', $form_register['ifup_user_email'], PDO::PARAM_STR);
            $insert->bindParam(':ifup_user_password',$form_register['ifup_user_password'], PDO::PARAM_STR);
            $insert->bindParam(':ifup_user_confirmation_token',$token, PDO::PARAM_STR);
            $insert->execute();
            return true;
        }
        catch (Exception $e){
            return false;
        }
    }