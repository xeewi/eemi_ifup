<?php
    function select_all_news(){
        try{
            global $bdd;

            $query = "SELECT * FROM ifup_news n
                          LEFT JOIN ifup_image i
                          ON n.ifup_news_image_id = i.ifup_image_id
                          ORDER BY n.ifup_news_date DESC";

            $q = $bdd->prepare($query);
            $q->execute();
            $allNews= $q->fetchAll();
            $q->closeCursor();
            return $allNews;
        }
        catch(Exception $e){
            return false;
        }
    }