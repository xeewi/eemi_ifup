<?php
    function delete_faq_category($faq_cat_id){
        try{
            global $bdd;
            $faq_cat_id = (int)$faq_cat_id;

            $query = "DELETE FROM ifup_faq_category WHERE ifup_faq_category_id=:ifup_faq_category_id";

            $delete = $bdd->prepare($query);
            $delete->bindParam(':ifup_faq_category_id', $faq_cat_id, PDO::PARAM_INT);
            $delete->execute();
            return $delete;
        }
        catch(Exception $e){
            return false;
        }
    }