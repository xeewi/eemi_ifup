<?php 

function selectUserImg($imageID){
	try{

        global $bdd;

        $select = $bdd->prepare("SELECT * FROM ifup_image 
        	WHERE ifup_image_id = :imageID");
        $select->bindParam(':imageID', $imageID, PDO::PARAM_INT);
        $select->execute();
        $image = $select->fetch();
        return $image;

    } catch(Exception $e){
        return false;
    }
}