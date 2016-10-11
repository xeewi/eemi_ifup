<?php
    function count_faqs_per_cat($category){
        try {
            global $bdd;
            $req = $bdd->query('SELECT COUNT(*) FROM ifup_faq WHERE ifup_faq_category_id=:ifup_faq_category_id');
            $req->bindParam(':ifup_faq_category_id', $category, PDO::PARAM_INT);
            $req->execute();
            $allFaqs = $req->fetch();
            $req->closeCursor();
            return (int)$allFaqs[0];//pcq COUNT renvoit 2 lignes dont 1 en string pour montrer qu'on a utilise count.
        }
        catch(Exception $e){
            return false;
        }
    }
