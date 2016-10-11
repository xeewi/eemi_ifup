<?php
    function delete_news($news_id){
        try{
            global $bdd;
            $news_id = (int)$news_id;

            $query = "DELETE FROM ifup_news WHERE ifup_news_id=:ifup_news_id";

            $delete = $bdd->prepare($query);
            $delete->bindParam(':ifup_news_id', $news_id, PDO::PARAM_INT);
            $delete->execute();
            return $delete;
        }
        catch(Exception $e){
            return false;
        }
    }