<?php
    function count_news()
    {
        try
        {
            global $bdd;
            $req = $bdd->query('SELECT COUNT(*) FROM ifup_news');
            $nbrNews = $req->fetch();
            $req->closeCursor();
            return (int)$nbrNews[0];//pcq COUNT renvoit 2 lignes dont 1 en string pour montrer qu'on a utilis� count.
        }
        catch(Exception $e)
        {
            return false;
        }
    }
