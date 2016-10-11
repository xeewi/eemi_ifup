<?php
    function select_not_sent_newsletters(){
        try{
            global $bdd;

            $query = "SELECT * FROM ifup_newsletter n WHERE n.ifup_newsletter_date IS NULL ORDER BY n.ifup_newsletter_id DESC";

            $q = $bdd->prepare($query);
            $q->execute();
            $allNewsletters= $q->fetchAll();
            $q->closeCursor();
            return $allNewsletters;
        }
        catch(Exception $e){
            return false;
        }
    }