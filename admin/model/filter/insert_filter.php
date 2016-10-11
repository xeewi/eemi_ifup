<?php
    function insert_filter($filter_name){
        try{
            global $bdd;

            $insert = $bdd->prepare("INSERT INTO ifup_filter(ifup_filter_name)
                                        VALUES(:ifup_filter_name)");

            $insert->bindParam(':ifup_filter_name', $filter_name, PDO::PARAM_STR);
            $insert->execute();
            return $insert;
        }
        catch (Exception $e){
            return false;
        }
    }