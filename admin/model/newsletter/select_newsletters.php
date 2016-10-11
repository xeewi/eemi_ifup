<?php
    function select_newsletters(){
        try{
            global $bdd;

            $query = "SELECT * FROM ifup_newsletter n
                              ORDER BY n.ifup_newsletter_date DESC";

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