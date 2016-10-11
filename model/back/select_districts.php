<?php
    function select_districts(){
        try{
            global $bdd;

            $query = "SELECT * FROM ifup_district";
            $q = $bdd->query($query);
            $districts= $q->fetchAll();
            $q->closeCursor();
            return $districts;
        }
        catch(Exception $e){
            return false;
        }
    }