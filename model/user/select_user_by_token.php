<?php
    function select_user_by_token($token){
        try{
            global $bdd;

            $query = "SELECT * FROM ifup_user
                        WHERE ifup_user_confirmation_token=:ifup_user_confirmation_token";

            $q = $bdd->prepare($query);
            $q->bindParam(':ifup_user_confirmation_token', $token, PDO::PARAM_STR);
            $q->execute();
            $user= $q->fetch();
            $q->closeCursor();
            return $user;
        }
        catch(Exception $e){
            return false;
        }
    }