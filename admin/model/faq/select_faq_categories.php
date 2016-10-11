<?php
    function select_faq_categories(){
        try{
            global $bdd;

            $query = "SELECT * FROM ifup_faq_category ORDER BY ifup_faq_category_id DESC";

            $q = $bdd->prepare($query);
            $q->execute();
            $cats= $q->fetchAll();
            $q->closeCursor();
            return $cats;
        }
        catch(Exception $e){
            return false;
        }
    }