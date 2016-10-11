<?php
    function select_user_filters($user_id){
        try{
            global $bdd;


            //=======================
            //select filters of the user :
            //=======================
            $query_select_user_filters = "SELECT * FROM ifup_users_filters fs
                            LEFT JOIN ifup_filter f
                            ON fs.ifup_filter_id=f.ifup_filter_id
                            LEFT JOIN ifup_image i
                            ON i.ifup_image_id=f.ifup_filter_image_id
                            WHERE fs.ifup_user_id=:ifup_user_id
                            AND f.ifup_filter_archived_at IS NULL";

            $select_user_filters = $bdd->prepare($query_select_user_filters);
            $select_user_filters->bindParam(':ifup_user_id', $user_id, PDO::PARAM_INT);
            $select_user_filters->execute();
            $user= $select_user_filters->fetchAll();
            $select_user_filters->closeCursor();

            return $user;
        }
        catch(Exception $e){
            return false;
        }
    }