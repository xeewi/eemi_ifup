<?php
    function update_faq_category($faq_cat_id, $form){
        try{
            global $bdd;

            $insert = $bdd->prepare("UPDATE ifup_faq_category SET ifup_faq_category_title=:ifup_faq_category_title
                                         WHERE ifup_faq_category_id = :ifup_faq_category_id");

            $insert->bindParam(':ifup_faq_category_title', $form["ifup_faq_category_title"], PDO::PARAM_STR);
            $insert->bindParam(':ifup_faq_category_id',$faq_cat_id, PDO::PARAM_INT);
            $insert->execute();
            return true;
        }
        catch (Exception $e){
            return false;
        }
    }