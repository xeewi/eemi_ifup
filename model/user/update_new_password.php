<?php
    function update_new_password($token, $password){
        try{
            global $bdd;
            $query = $bdd->prepare("UPDATE ifup_user SET ifup_user_password=:ifup_user_password WHERE ifup_user_password=:token");
            $query->bindParam(':ifup_user_password',$password, PDO::PARAM_STR);
            $query->bindParam(':token',$token, PDO::PARAM_STR);
            $query->execute();
            return $query;
        }
        catch(Exception $e){
            return false;
        }
    }