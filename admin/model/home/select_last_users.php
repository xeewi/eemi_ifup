<?php
    function select_last_users($limit){
        try{
            $limit = (int)$limit;
            global $bdd;

            $query = "SELECT * FROM ifup_user u
                              LEFT JOIN ifup_image i
                              ON u.ifup_user_image_id=i.ifup_image_id
                              WHERE u.ifup_user_archived_at IS NULL
                              ORDER BY u.ifup_user_register_date DESC LIMIT :limit";
            $q = $bdd->prepare($query);
            $q->bindParam(':limit', $limit, PDO::PARAM_INT);
            $q->execute();
            $users = $q->fetchAll();
            $q->closeCursor();
            return $users;
        }
        catch(Exception $e){
            return false;
        }
    }