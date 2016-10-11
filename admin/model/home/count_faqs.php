<?php
    function count_faqs(){
        try {
            global $bdd;
            $req = $bdd->query('SELECT COUNT(*) FROM ifup_faq');
            $allfaqs = $req->fetch();
            $req->closeCursor();
            return (int)$allfaqs[0];//pcq COUNT renvoit 2 lignes dont 1 en string pour montrer qu'on a utilise count.
        }
        catch(Exception $e){
            return false;
        }
    }
