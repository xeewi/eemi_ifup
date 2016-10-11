<?php
function count_newsletter_subscribers(){
    try {
        global $bdd;
        $req = $bdd->query('SELECT COUNT(distinct ifup_contact_email) FROM ifup_contact');
        $allSubscribers = $req->fetch();
        $req->closeCursor();
        return (int)$allSubscribers[0];//pcq COUNT renvoit 2 lignes dont 1 en string pour montrer qu'on a utilise count.
    }
    catch(Exception $e){
        return false;
    }
}