<?php
    function select_contacts(){
        try{
            global $bdd;

            $query = "SELECT * FROM ifup_contact";

            $q = $bdd->prepare($query);
            $q->execute();
            $contacts= $q->fetchAll();
            $q->closeCursor();
            return $contacts;
        }
        catch(Exception $e){
            return false;
        }
    }