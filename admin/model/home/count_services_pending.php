<?php
    function count_services_pending(){
        try {
            global $bdd;
            $req = $bdd->query('SELECT COUNT(*) FROM ifup_service WHERE ifup_service_start IS NOT NULL AND ifup_service_finish IS NULL');
            $servicesInProgress = $req->fetch();
            $req->closeCursor();
            return (int)$servicesInProgress[0];//pcq COUNT renvoit 2 lignes dont 1 en string pour montrer qu'on a utilise count.
        }
        catch(Exception $e){
            return false;
        }
    }