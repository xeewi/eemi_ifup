<?php
    function select_verify_email_newsletter($email){
        try{
            global $bdd;

            $query = "SELECT * FROM ifup_contact
                        WHERE ifup_contact_email=:email";

            $q = $bdd->prepare($query);
            $q->bindParam(':email', $email, PDO::PARAM_STR);
            $q->execute();
            $user= $q->fetch();
            $q->closeCursor();
            return $user;
        }
        catch(Exception $e){
            return false;
        }
    }