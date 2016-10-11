<?php
    function select_user_upper($service_id){
        try{
            global $bdd;

            $query = "SELECT * FROM ifup_user u
                          LEFT JOIN ifup_image i
                          ON u.ifup_user_image_id = i.ifup_image_id
                          WHERE u.ifup_user_id=(SELECT s.ifup_service_user_up_id FROM ifup_service s WHERE s.ifup_service_id=:ifup_service_id)";

            $q = $bdd->prepare($query);
            $q->bindParam(':ifup_service_id', $service_id, PDO::PARAM_INT);
            $q->execute();
            $service = $q->fetch();
            $q->closeCursor();
            return $service;
        }
        catch(Exception $e){
            return false;
        }
    }