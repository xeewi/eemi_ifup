<?php
    function select_users(){
        try{
            global $bdd;

            $query = "SELECT * FROM ifup_user u
                              LEFT JOIN ifup_image i
                              ON u.ifup_user_image_id = i.ifup_image_id
                              WHERE u.ifup_user_archived_at IS NULL
                              ORDER BY u.ifup_user_register_date DESC";

            $q = $bdd->prepare($query);
            $q->execute();
            $users= $q->fetchAll();
            $q->closeCursor();
            return $users;
        }
        catch(Exception $e){
            return false;
        }
    }