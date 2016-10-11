<?php
    function select_faq($faq_id){
        try{
            $faq_id = (int)$faq_id;

            global $bdd;
            $query = "SELECT * FROM ifup_faq WHERE ifup_faq_id =:ifup_faq_id";
            $q = $bdd->prepare($query);
            $q->bindParam(':ifup_faq_id', $faq_id, PDO::PARAM_INT);
            $q->execute();
            $current_faq= $q->fetch();
            $q->closeCursor();
            return $current_faq;
        }
        catch(Exception $e){
            return false;
        }
    }