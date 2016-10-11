<?php
    function update_faq($faq_id, $form){
        try{
            global $bdd;

            $insert = $bdd->prepare("UPDATE ifup_faq SET ifup_faq_question=:ifup_faq_question,
                                                          ifup_faq_answer=:ifup_faq_answer,
                                                          ifup_faq_category_id=:ifup_faq_category_id
                                     WHERE ifup_faq_id = :ifup_faq_id");

            $insert->bindParam(':ifup_faq_question', $form["ifup_faq_question"], PDO::PARAM_STR);
            $insert->bindParam(':ifup_faq_answer',$form["ifup_faq_answer"], PDO::PARAM_STR);
            $insert->bindParam(':ifup_faq_category_id',$form["ifup_faq_category_id"], PDO::PARAM_INT);
            $insert->bindParam(':ifup_faq_id',$faq_id, PDO::PARAM_INT);
            $insert->execute();
            return true;
        }
        catch (Exception $e){
            return false;
        }
    }