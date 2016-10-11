<?php
    function select_services(){
        try{
            global $bdd;

            $query = "SELECT s.*, f.ifup_filter_name, u.ifup_user_firstname, u.ifup_user_lastname, u2.ifup_user_firstname, u2.ifup_user_lastname FROM ifup_service s
                      LEFT JOIN ifup_user u
                      ON u.ifup_user_id=s.ifup_service_user_if_id
                      LEFT JOIN ifup_user u2
                      ON u2.ifup_user_id=s.ifup_service_user_up_id
                      LEFT JOIN ifup_filter f
                      ON f.ifup_filter_id=s.ifup_service_filter_id";
            //on join les données de l'user up et celles de l'user if.

            $q = $bdd->prepare($query);
            $q->execute();
            $services = $q->fetchAll();
            $q->closeCursor();
            return $services;
        }
        catch(Exception $e){
            return false;
        }
    }