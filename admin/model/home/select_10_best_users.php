<?php
    function select_10_best_users(){
        try{
            global $bdd;


            $query = "SELECT u.ifup_user_firstname, u.ifup_user_lastname,
                            (SELECT COUNT(ifup_service_user_if_id) FROM ifup_service
                              WHERE ifup_service_user_if_id=u.ifup_user_id
                              AND ifup_service_start IS NOT NULL
                              AND ifup_service_finish IS NOT NULL) nbrServicesAsIffer,
                            (SELECT COUNT(ifup_service_user_up_id) FROM ifup_service WHERE ifup_service_user_up_id=u.ifup_user_id AND ifup_service_start IS NOT NULL AND ifup_service_finish IS NOT NULL) nbrServicesAsUpper,
                            ((SELECT COUNT(ifup_service_user_if_id) FROM ifup_service WHERE ifup_service_user_if_id=u.ifup_user_id AND ifup_service_start IS NOT NULL AND ifup_service_finish IS NOT NULL)
                            + (SELECT COUNT(ifup_service_user_up_id) FROM ifup_service WHERE ifup_service_user_up_id=u.ifup_user_id AND ifup_service_start IS NOT NULL AND ifup_service_finish IS NOT NULL)) NbrServicesPerUser
                            FROM ifup_user u
                            WHERE u.ifup_user_archived_at IS NULL
                            ORDER BY NbrServicesPerUser DESC LIMIT 10";

            $q = $bdd->query($query);
            $bestUsers = $q->fetchAll();
            $q->closeCursor();
            return $bestUsers;
        }
        catch(Exception $e){
            return false;
        }
    }