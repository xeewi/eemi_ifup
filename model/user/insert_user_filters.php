<?php
    function insert_user_filters($user_id, $user_filters){
        try{
            global $bdd;
            $values_string ="";
            foreach($user_filters as $user_filter){
                $values_string .= "(:ifup_user_id, :ifup_filter_id_". $user_filter . ")";
                if(end($user_filters)!== $user_filter){
                    $values_string.= ', ';
                }
            }
            $query = "INSERT INTO ifup_users_filters(ifup_user_id, ifup_filter_id) VALUES". $values_string;
            $insert = $bdd->prepare($query);
            $insert->bindParam(':ifup_user_id', $user_id, PDO::PARAM_INT);

            foreach($user_filters as $user_filter){
                $user_filter = (int)$user_filter;
                $insert->bindValue(':ifup_filter_id_'. $user_filter, $user_filter, PDO::PARAM_INT);
            }
            $insert->execute();
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }