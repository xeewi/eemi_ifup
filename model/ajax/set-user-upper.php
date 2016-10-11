<?php 

function setUserUpper($userID){
	try{

        global $bdd;

        $upper = 1;

        $update = $bdd->prepare("UPDATE ifup_user SET ifup_user_status = :upper WHERE ifup_user_id = :userID");
        $update->bindParam(':upper', $upper, PDO::PARAM_INT);
        $update->bindParam(':userID', $userID, PDO::PARAM_INT);
        $update->execute();

        return true;

    } catch(Exception $e){
        return "X_BDx4";
    }
}