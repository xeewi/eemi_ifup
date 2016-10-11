<?php
    function select_10_best_filters(){
        try{
            global $bdd;

            $query = "SELECT f.ifup_filter_name, COUNT(s.ifup_service_filter_id) nbrServicesPerFilter FROM ifup_service s
                      LEFT JOIN ifup_filter f
                      ON f.ifup_filter_id=s.ifup_service_filter_id
                      WHERE f.ifup_filter_archived_at IS NULL
                      GROUP BY s.ifup_service_filter_id
                      ORDER BY nbrServicesPerFilter DESC LIMIT 10";
            $q = $bdd->query($query);
            $bestFilters = $q->fetchAll();
            $q->closeCursor();
            return $bestFilters;
        }
        catch(Exception $e){
            return false;
        }
    }