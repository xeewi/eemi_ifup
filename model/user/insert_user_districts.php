<?php
    function insert_user_districts($user_id, array $user_districts){
        try{
            global $bdd;
            $values_string ="";

            foreach($user_districts as $user_district){
                $values_string .= "(:ifup_user_id, :ifup_district_id_". $user_district . ")";
                if(end($user_districts)!== $user_district){
                    $values_string.= ', ';
                }
            }
            $query = "INSERT INTO ifup_users_districts(ifup_user_id, ifup_district_id) VALUES". $values_string;
            $insert = $bdd->prepare($query);
            $insert->bindParam(':ifup_user_id', $user_id, PDO::PARAM_INT);
            foreach($user_districts as $user_district){
                $user_district = (int)$user_district;
                $insert->bindValue(':ifup_district_id_'. $user_district, $user_district, PDO::PARAM_INT);
            }
            $insert->execute();
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }