<?php 

function selectUsersUp($service){
	try{

        global $bdd;

        $online = 1;

        $update = $bdd->prepare("SELECT * FROM ifup_user 
        	WHERE ifup_user_online = 1
        		AND ifup_user_status ");
        $update->bindParam(':online', $online, PDO::PARAM_INT);
        $update->bindParam(':userID', $userID, PDO::PARAM_INT);
        $update->execute();

        return true;

    } catch(Exception $e){
        return false;
    }
}