<?php
    function count_users(){
        try {
            global $bdd;
            $req = $bdd->query('SELECT COUNT(*) FROM ifup_user WHERE ifup_user_archived_at IS NULL AND ifup_user_confirmation_token IS NULL');
            $allUsers = $req->fetch();
            $req->closeCursor();
            return (int)$allUsers[0];//pcq COUNT renvoit 2 lignes dont 1 en string pour montrer qu'on a utilise count.
        }
        catch(Exception $e){
            return false;
        }
    }
