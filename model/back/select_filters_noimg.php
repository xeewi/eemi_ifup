<?php
    function select_filters_noimg(){
        try{
            global $bdd;

            $query = "SELECT * FROM ifup_filter WHERE ifup_filter_archived_at IS NULL";
            $q = $bdd->query($query);
            $filters = $q->fetchAll();
            $q->closeCursor();
            return $filters;
        }
        catch(Exception $e){
            return false;
        }
    }