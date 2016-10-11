<?php
    function delete_last_img(){
        try{
            global $bdd;

            $query = "DELETE FROM ifup_image WHERE ifup_image_id=(SELECT MAX(ifup_image_id) FROM ifup_image)";
            $delete = $bdd->prepare($query);
            $delete->execute();
            return true;
        }
        catch(Exception $e){
            return false;
        }
    }