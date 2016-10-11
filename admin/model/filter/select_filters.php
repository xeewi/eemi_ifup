<?php
    function select_filters(){
        try{
            global $bdd;

            $query = "SELECT * FROM ifup_filter f
                      LEFT JOIN ifup_image i
                      ON f.ifup_filter_image_id=i.ifup_image_id
                      WHERE f.ifup_filter_archived_at IS NULL
                      ORDER BY f.ifup_filter_id DESC";
            $q = $bdd->query($query);
            $filters = $q->fetchAll();
            $q->closeCursor();
            return $filters;
        }
        catch(Exception $e){
            return false;
        }
    }