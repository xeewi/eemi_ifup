<?php
    function count_newsletters_not_sent(){
        try {
            global $bdd;
            $req = $bdd->query('SELECT COUNT(*) FROM ifup_newsletter WHERE ifup_newsletter_date IS NULL');
            $allNewsletters = $req->fetch();
            $req->closeCursor();
            return (int)$allNewsletters[0];//pcq COUNT renvoit 2 lignes dont 1 en string pour montrer qu'on a utilise count.
        }
        catch(Exception $e){
            return false;
        }
    }