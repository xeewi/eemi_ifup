<?php
    function select_faqs(){
        try{
            global $bdd;

            $query = "SELECT * FROM ifup_faq f
                      JOIN ifup_faq_category c
                      ON f.ifup_faq_category_id=c.ifup_faq_category_id
                      ORDER BY c.ifup_faq_category_title ASC";

            $q = $bdd->prepare($query);
            $q->execute();
            $faqs= $q->fetchAll();
            $q->closeCursor();
            return $faqs;
        }
        catch(Exception $e){
            return false;
        }
    }