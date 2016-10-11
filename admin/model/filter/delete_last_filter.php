<?php
    function delete_last_filter(){
        try{
            global $bdd;

            $query = "DELETE FROM ifup_filter WHERE ifup_filter_id=(SELECT MAX(ifup_filter_id) FROM ifup_filter)";
            $delete = $bdd->prepare($query);
            $delete->execute();
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }