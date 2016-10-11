<?php
    function select_service($service_id){
        try{
            global $bdd;

            $query = "SELECT s.*, f.*, i.ifup_image_file, i.ifup_image_id FROM ifup_service s
                          LEFT JOIN ifup_filter f
                          ON f.ifup_filter_id=s.ifup_service_filter_id
                          LEFT JOIN ifup_image i
                          ON f.ifup_filter_image_id=i.ifup_image_id
                          WHERE s.ifup_service_id=:ifup_service_id";
            //on join les données de l'user up et celles de l'user if.

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