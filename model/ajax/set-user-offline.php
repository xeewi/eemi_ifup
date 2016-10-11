<?php 

function setUserOffline($userID){
	try{

        global $bdd;

        $online = 0;

        $update = $bdd->prepare("UPDATE ifup_user SET ifup_user_online = :online WHERE ifup_user_id = :userID");
        $update->bindParam(':online', $online, PDO::PARAM_INT);
        $update->bindParam(':userID', $userID, PDO::PARAM_INT);
        $update->execute();

        return true;

    } catch(Exception $e){
        return false;
    }
}