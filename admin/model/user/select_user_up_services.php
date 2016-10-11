<?php
    function select_user_up_services($user_up_id){
        try{
            global $bdd;

            $query = "SELECT * FROM ifup_service s
                          LEFT JOIN ifup_user u
                          ON u.ifup_user_id=s.ifup_service_user_if_id
                          LEFT JOIN ifup_filter f
                          ON f.ifup_filter_id=s.ifup_service_filter_id
                          WHERE s.ifup_service_user_up_id=:ifup_service_user_up_id";
            //on join les données de l'user if mais pas celles du upper car on les a déjà dans l'array $user.

            $q = $bdd->prepare($query);
            $q->bindParam(':ifup_service_user_up_id', $user_up_id, PDO::PARAM_INT);
            $q->execute();
            $user_up_services = $q->fetchAll();
            $q->closeCursor();
            return $user_up_services;
        }
        catch(Exception $e){
            return false;
        }
    }