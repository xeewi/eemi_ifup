<?php
    function insert_faq_category($form){
        try{
            global $bdd;

            $insert = $bdd->prepare("INSERT INTO ifup_faq_category (ifup_faq_category_title)
                                            VALUES (:ifup_faq_category_title)");

            $insert->bindParam(':ifup_faq_category_title', $form['ifup_faq_category_title'], PDO::PARAM_STR);
            $insert->execute();
            return $insert;
        }
        catch (Exception $e){
            return false;
        }
    }