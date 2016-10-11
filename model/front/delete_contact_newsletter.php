<?php
    function delete_contact_newsletter($email){
        try {
            global $bdd;

            $req = $bdd->prepare("DELETE FROM ifup_contact WHERE ifup_contact_email=:ifup_contact_email");
            $req->bindParam(':ifup_contact_email', $email, PDO::PARAM_STR);
            $req->execute();
            return $req;
        }
        catch(Exception $e){
            return false;
        }
    }