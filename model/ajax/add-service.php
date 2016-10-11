<?php
    function addService($service, $userID){
        try{
            global $bdd;

            $insert = $bdd->prepare("INSERT INTO ifup_service (
                    ifup_service_address,
                    ifup_service_message,
                    ifup_service_user_if_id,
                    ifup_service_filter_id,
                    ifup_service_if_lat_len) 
                VALUES (:ifup_service_address,
                    :ifup_service_message,
                    :ifup_service_user_if_id,
                    :ifup_service_filter_id,
                    :ifup_service_if_lat_len)");

            $insert->bindParam(':ifup_service_address', $service['ifup_service_address'], PDO::PARAM_STR);
            $insert->bindParam(':ifup_service_message', $service['ifup_service_message'], PDO::PARAM_STR);
            $insert->bindParam(':ifup_service_filter_id', $service['ifup_service_filter_id'], PDO::PARAM_STR);
            $insert->bindParam(':ifup_service_if_lat_len', $service['ifup_service_if_lat_len'], PDO::PARAM_STR);
            $insert->bindParam(':ifup_service_user_if_id', $userID, PDO::PARAM_INT);


            $insert->execute();

            $insertID = $bdd->lastInsertId();

            return $insertID;
        }
        catch (Exception $e){
            return "X_BD000";
        }
    }