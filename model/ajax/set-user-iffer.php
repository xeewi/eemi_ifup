<?php 

function setUserIffer($userID){
	try{

        global $bdd;

        $iffer = 0;

        $update = $bdd->prepare("UPDATE ifup_user SET ifup_user_status = :iffer WHERE ifup_user_id = :userID");
        $update->bindParam(':iffer', $iffer, PDO::PARAM_INT);
        $update->bindParam(':userID', $userID, PDO::PARAM_INT);
        $update->execute();

        return true;

    } catch(Exception $e){
        return "X_BDx4";
    }
}