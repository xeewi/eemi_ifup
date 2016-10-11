<?php
    function update_password_to_token($email, $token){
        try{
            global $bdd;
            $query = $bdd->prepare("UPDATE ifup_user SET ifup_user_password=:token WHERE ifup_user_email=:ifup_user_email AND ifup_user_archived_at IS NULL");

            $query->bindParam(':ifup_user_email',$email, PDO::PARAM_STR);
            $query->bindParam(':token',$token, PDO::PARAM_STR);
            $query->execute();
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }