<?php
    function count_news_in_month(){
        try {
            global $bdd;
            $req = $bdd->query("SELECT COUNT(*) FROM ifup_news WHERE MONTH(ifup_news_date)=MONTH(NOW())");
            $allNews = $req->fetch();
            $req->closeCursor();
            return (int)$allNews[0];//pcq COUNT renvoit 2 lignes dont 1 en string pour montrer qu'on a utilise count.
        }
        catch(Exception $e){
            return false;
        }
    }
