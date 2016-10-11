<?php
    function insert_faq($form){
        try{
            global $bdd;

            $insert = $bdd->prepare("INSERT INTO ifup_faq (ifup_faq_question, ifup_faq_answer, ifup_faq_category_id)
                                        VALUES (:ifup_faq_question, :ifup_faq_answer, :ifup_faq_category_id)");

            $insert->bindParam(':ifup_faq_question', $form['ifup_faq_question'], PDO::PARAM_STR);
            $insert->bindParam(':ifup_faq_answer',$form['ifup_faq_answer'], PDO::PARAM_STR);
            $insert->bindParam(':ifup_faq_category_id',$form["ifup_faq_category_id"], PDO::PARAM_INT);
            $insert->execute();
            return true;
        }
        catch (Exception $e){
            return false;
        }
    }