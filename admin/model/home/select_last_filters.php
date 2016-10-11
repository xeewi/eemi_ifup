<?php
    function select_last_filters($limit){
        try{
            $limit= (int)$limit;
            global $bdd;

            $query = "SELECT * FROM ifup_filter f
                          LEFT JOIN ifup_image i
                          ON f.ifup_filter_image_id=i.ifup_image_id
                          WHERE f.ifup_filter_archived_at IS NULL
                          ORDER BY f.ifup_filter_id DESC LIMIT :limit";
            $q = $bdd->prepare($query);
            $q->bindParam(':limit', $limit, PDO::PARAM_INT);
            $q->execute();
            $filters = $q->fetchAll();
            $q->closeCursor();
            return $filters;
        }
        catch(Exception $e){
            return false;
        }
    }