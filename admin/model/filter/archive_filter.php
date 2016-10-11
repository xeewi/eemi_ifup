<?php
    function archive_filter($filter_id){
        try{
            global $bdd;
            $query="UPDATE ifup_filter SET ifup_filter_archived_at=NOW() WHERE ifup_filter_id=:ifup_filter_id";
            $archive = $bdd->prepare($query);
            $archive->bindParam(':ifup_filter_id', $filter_id, PDO::PARAM_INT);
            $archive->execute();
            return $archive;
        }
        catch(Exception $e){
            return false;
        }
    }