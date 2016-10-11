<?php
    function delete_last_news(){
        try{
            global $bdd;

            $query = "DELETE FROM ifup_news WHERE ifup_news_id=(SELECT MAX(ifup_news_id) FROM ifup_news)";
            $delete = $bdd->prepare($query);
            $delete->execute();
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }