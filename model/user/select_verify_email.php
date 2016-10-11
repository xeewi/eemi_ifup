<?php
    function select_verify_email($user_email){
        try{
            global $bdd;

            $query = "SELECT * FROM ifup_user
                    WHERE ifup_user_email=:user_email
                    AND ifup_user_archived_at IS NULL";

            $q = $bdd->prepare($query);
            $q->bindParam(':user_email', $user_email, PDO::PARAM_STR);
            $q->execute();
            $user= $q->fetch();
            $q->closeCursor();
            return $user;
        }
        catch(Exception $e){
            return false;
        }
    }