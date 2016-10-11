<?php
    function archive_user($user_id){
        try{
            global $bdd;
            $query="UPDATE ifup_user SET ifup_user_archived_at=NOW() WHERE ifup_user_id=:ifup_user_id";
            $archive = $bdd->prepare($query);
            $archive->bindParam(':ifup_user_id', $user_id, PDO::PARAM_INT);
            $archive->execute();
            return $archive;
        }
        catch(Exception $e){
            return false;
        }
    }