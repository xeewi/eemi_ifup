<?php
    function select_all_news($offset, $limit){
        try{
            global $bdd;
            $offset = (int) $offset;
            $limit = (int) $limit;

            $query = "SELECT * FROM ifup_news n
                      JOIN ifup_image i
                      ON n.ifup_news_image_id = i.ifup_image_id
                        ORDER BY n.ifup_news_date DESC LIMIT :offset, :limit";

            $q = $bdd->prepare($query);
            $q->bindParam(':offset', $offset, PDO::PARAM_INT);
            $q->bindParam(':limit', $limit, PDO::PARAM_INT);
            $q->execute();
            $allNews= $q->fetchAll();
            $q->closeCursor();
            return $allNews;
        }
        catch(Exception $e){
            return false;
        }
    }