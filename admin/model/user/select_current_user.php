<?php
    function select_current_user($user_id){
        try{
            global $bdd;
            $query = "SELECT * FROM ifup_user u
                              LEFT JOIN ifup_image i
                              ON u.ifup_user_image_id = i.ifup_image_id
                              WHERE u.ifup_user_id=:ifup_user_id
                              AND u.ifup_user_archived_at IS NULL";

            $q = $bdd->prepare($query);
            $q->bindParam(':ifup_user_id', $user_id, PDO::PARAM_INT);
            $q->execute();
            $user= $q->fetch();
            $q->closeCursor();
            return $user;
        }
        catch(Exception $e){
            return false;
        }
    }