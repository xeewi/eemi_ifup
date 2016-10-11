<?php
    function select_newsletter($newsletter_id){
        try{
            global $bdd;

            $query = "SELECT * FROM ifup_newsletter n WHERE n.ifup_newsletter_id=:ifup_newsletter_id";

            $q = $bdd->prepare($query);
            $q->bindParam(':ifup_newsletter_id', $newsletter_id, PDO::PARAM_INT);
            $q->execute();
            $newsletter= $q->fetch();
            $q->closeCursor();
            return $newsletter;
        }
        catch(Exception $e){
            return false;
        }
    }