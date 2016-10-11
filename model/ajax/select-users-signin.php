<?php 

function selectUsersSignin($filterID){
	try{

        global $bdd;

        $select = $bdd->prepare("SELECT * FROM ifup_users_filters 
        	WHERE ifup_filter_id = :filterID");
        $select->bindParam(':filterID', $filterID, PDO::PARAM_INT);
        $select->execute();
        $users = $select->fetchAll();
        return $users;

    } catch(Exception $e){
        return false;
    }
}