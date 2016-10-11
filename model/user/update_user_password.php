<?php
    function update_user_password($user_id, $password){
    try{
        global $bdd;
        $query = $bdd->prepare("UPDATE ifup_user SET ifup_user_password=:ifup_user_password WHERE ifup_user_id=:ifup_user_id");
        $query->bindParam(':ifup_user_password',$password, PDO::PARAM_STR);
        $query->bindParam(':ifup_user_id',$user_id, PDO::PARAM_INT);
        $query->execute();
        return $query;
    }
    catch(Exception $e){
        return false;
    }
}