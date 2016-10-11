<?php
    function select_faqs_per_cat($offset, $limit, $category){
        try{
            global $bdd;
            $offset = (int) $offset;
            $limit = (int) $limit;

            $query = "SELECT * FROM ifup_faq f
                      LEFT JOIN ifup_faq_category c
                      ON f.ifup_faq_category_id=c.ifup_faq_category_id
                      WHERE f.ifup_faq_category_id=:ifup_faq_category_id
                      ORDER BY f.ifup_faq_id DESC LIMIT :offset, :limit";

            $q = $bdd->prepare($query);
            $q->bindParam(':offset', $offset, PDO::PARAM_INT);
            $q->bindParam(':limit', $limit, PDO::PARAM_INT);
            $q->bindParam(':ifup_faq_category_id', $category, PDO::PARAM_INT);
            $q->execute();
            $faqs= $q->fetchAll();
            $q->closeCursor();
            return $faqs;
        }
        catch(Exception $e){
            return false;
        }
    }