<?php
    function select_faq_category($faq_cat_id){
        try{
            $faq_cat_id = (int)$faq_cat_id;

            global $bdd;
            $query = "SELECT * FROM ifup_faq_category WHERE ifup_faq_category_id =:ifup_faq_category_id";
            $q = $bdd->prepare($query);
            $q->bindParam(':ifup_faq_category_id', $faq_cat_id, PDO::PARAM_INT);
            $q->execute();
            $current_faq_cat= $q->fetch();
            $q->closeCursor();
            return $current_faq_cat;
        }
        catch(Exception $e){
            return false;
        }
    }