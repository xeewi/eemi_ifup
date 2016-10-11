<?php
    function insert_contact_newsletter($email){
        try{
            global $bdd;

            $insert = $bdd->prepare("INSERT INTO ifup_contact (ifup_contact_email)
                                        VALUES (:ifup_contact_email)");

            $insert->bindParam(':ifup_contact_email',$email, PDO::PARAM_STR);
            $insert->execute();
            return $insert;
        }
        catch (Exception $e){
            return false;
        }
    }