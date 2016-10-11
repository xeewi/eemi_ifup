<?php
    function delete_user_filters($user_id){
        try{
            global $bdd;
            $user_id = (int)$user_id;

            $query = "DELETE FROM ifup_users_filters WHERE ifup_user_id=:ifup_user_id";

            $delete = $bdd->prepare($query);
            $delete->bindParam(':ifup_user_id', $user_id, PDO::PARAM_INT);
            $delete->execute();
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }