<?php
    function update_filter($filter_id, $form){
        try{
            global $bdd;
            $update = $bdd->prepare("UPDATE ifup_filter SET ifup_filter_name=:ifup_filter_name
                                     WHERE ifup_filter_id=:ifup_filter_id");
            $update->bindParam(':ifup_filter_name', $form["ifup_filter_name"], PDO::PARAM_STR);
            $update->bindParam(':ifup_filter_id', $filter_id, PDO::PARAM_INT);
            $update->execute();
            return true;
        }
        catch (Exception $e){
            return false;
        }
    }