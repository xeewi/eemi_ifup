<?php
    function select_current_news($news_id){
        try{
            global $bdd;

            $query = "SELECT * FROM ifup_news n
                              LEFT JOIN ifup_image i
                              ON n.ifup_news_image_id=i.ifup_image_id
                              WHERE n.ifup_news_id=:ifup_news_id";
            $q = $bdd->prepare($query);
            $q->bindParam(':ifup_news_id', $news_id, PDO::PARAM_INT);
            $q->execute();
            $news = $q->fetch();
            $q->closeCursor();
            return $news;
        }
        catch(Exception $e){
            return false;
        }
    }