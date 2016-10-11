<?php
    function select_user_districts($user_id){
        try{
            global $bdd;
            //=======================
            //select districts of the user :
            //=======================
            $query_select_user_districts = "SELECT * FROM ifup_users_districts ds
                            JOIN ifup_district d
                            ON ds.ifup_district_id=d.ifup_district_id
                            WHERE ds.ifup_user_id=:ifup_user_id";

            $select_user_districts = $bdd->prepare($query_select_user_districts);
            $select_user_districts->bindParam(':ifup_user_id', $user_id, PDO::PARAM_INT);
            $select_user_districts->execute();
            $user = $select_user_districts->fetchAll();
            $select_user_districts->closeCursor();

            return $user;
        }
        catch(Exception $e){
            return false;
        }
    }