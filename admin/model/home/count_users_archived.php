<?php
    function count_users_archived(){
        try {
            global $bdd;
            $req = $bdd->query("SELECT COUNT(*) FROM ifup_user WHERE ifup_user_archived_at IS NOT NULL");
            $usersArchived = $req->fetch();
            $req->closeCursor();
            return (int)$usersArchived[0];//pcq COUNT renvoit 2 lignes dont 1 en string pour montrer qu'on a utilise count.
        }
        catch(Exception $e){
            return false;
        }
    }