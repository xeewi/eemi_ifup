<?php
    function delete_faq($faq_id){
        try{
            global $bdd;
            $faq_id = (int)$faq_id;

            $query = "DELETE FROM ifup_faq WHERE ifup_faq_id=:ifup_faq_id";

            $delete = $bdd->prepare($query);
            $delete->bindParam(':ifup_faq_id', $faq_id, PDO::PARAM_INT);
            $delete->execute();
            return $delete;
        }
        catch(Exception $e){
            return false;
        }
    }