<?php
    function delete_user_districts($user_id){
        try{
            global $bdd;

            $query = "DELETE FROM ifup_users_districts WHERE ifup_user_id=:ifup_user_id";

            $delete = $bdd->prepare($query);
            $delete->bindParam(':ifup_user_id', $user_id, PDO::PARAM_INT);
            $delete->execute();
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }