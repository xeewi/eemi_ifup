<?php
    function update_user_token($user_id){
        try{
            global $bdd;
            $user_id = (int)$user_id;
            $query = $bdd->prepare("UPDATE ifup_user SET ifup_user_confirmation_token=NULL WHERE ifup_user_id=:ifup_user_id");
            $query->bindParam(':ifup_user_id', $user_id, PDO::PARAM_INT);
            $query->execute();
            return true;
        }
        catch (Exception $e){
            return false;
        }
    }