<?php
    function delete_service($service_id){
        try{
            global $bdd;
            $service_id = (int)$service_id;

            $query = "DELETE FROM ifup_service WHERE ifup_service_id=:ifup_service_id";

            $delete = $bdd->prepare($query);
            $delete->bindParam(':ifup_service_id', $service_id, PDO::PARAM_INT);
            $delete->execute();
            return $delete;
        }
        catch(Exception $e){
            return false;
        }
    }