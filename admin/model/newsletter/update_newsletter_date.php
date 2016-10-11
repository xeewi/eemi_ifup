<?php
    function update_newsletter_date($newsletter_id){
        try{
            global $bdd;
            //SET THE new image path TO THE image row linked to the user :
            $update = $bdd->prepare("UPDATE ifup_newsletter SET ifup_newsletter_date=NOW()
                                                 WHERE ifup_newsletter_id=:ifup_newsletter_id");

            $update->bindParam(':ifup_newsletter_id', $newsletter_id, PDO::PARAM_INT);
            $update->execute();
            return $update;
        }
        catch (Exception $e){
            return false;
        }
    }