<?php
    function select_filter($filter_id){
        try{
            global $bdd;

            $query = "SELECT * FROM ifup_filter f
                          LEFT JOIN ifup_image i
                          ON f.ifup_filter_image_id=i.ifup_image_id
                          WHERE f.ifup_filter_id=:ifup_filter_id
                          AND f.ifup_filter_archived_at IS NULL";
            $q = $bdd->prepare($query);
            $q->bindParam(':ifup_filter_id', $filter_id, PDO::PARAM_INT);
            $q->execute();
            $filter = $q->fetch();
            $q->closeCursor();
            return $filter;
        }
        catch(Exception $e){
            return false;
        }
    }