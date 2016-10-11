<?php
    function count_districts(){
        try{
            global $bdd;
            $query = "SELECT COUNT(*) FROM ifup_district";
            $q = $bdd->query($query);
            $allDistricts = $q->fetch();
            $q->closeCursor();
            return (int)$allDistricts[0];
        }
        catch(Exception $e){
            return false;
        }
    }