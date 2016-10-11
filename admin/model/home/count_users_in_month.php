<?php
    function count_users_in_month(){
        try {
            global $bdd;
            $req = $bdd->query("SELECT COUNT(*) FROM ifup_user WHERE MONTH(ifup_user_register_date)=MONTH(NOW()) AND ifup_user_archived_at IS NULL AND ifup_user_confirmation_token IS NULL");
            $usersInMonth = $req->fetch();
            $req->closeCursor();
            return (int)$usersInMonth[0];//pcq COUNT renvoit 2 lignes dont 1 en string pour montrer qu'on a utilise count.
        }
        catch(Exception $e){
            return false;
        }
    }