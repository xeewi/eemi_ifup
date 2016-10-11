<?php 

function setServiceFinish($serviceID){
	try{

        global $bdd;

        $now = date("Y-m-d H:i:s");

        $update = $bdd->prepare("UPDATE ifup_service 
            SET ifup_service_finish = :now
            WHERE ifup_service_id = :serviceID");
        $update->bindParam(':serviceID', $serviceID, PDO::PARAM_INT);
        $update->bindParam(':now', $now, PDO::PARAM_STR);
        $update->execute();

        return $now;

    } catch(Exception $e){
        return "X_BDx5";
    }
}