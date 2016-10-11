<?php
    function count_faq_categories(){
        try {
            global $bdd;
            $req = $bdd->query('SELECT COUNT(*) FROM ifup_faq_category');
            $allFaqCategories = $req->fetch();
            $req->closeCursor();
            return (int)$allFaqCategories[0];//pcq COUNT renvoit 2 lignes dont 1 en string pour montrer qu'on a utilise count.
        }
        catch(Exception $e){
            return false;
        }
    }