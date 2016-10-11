<?php
    function update_filter_img_id(){
        try{
            global $bdd;
            //SET THE IMG ID TO THE FILTER :
            $update = $bdd->prepare("UPDATE ifup_filter SET ifup_filter_image_id=(SELECT MAX(ifup_image_id) FROM ifup_image)
                                      ORDER BY ifup_filter_id DESC LIMIT 1");//because we can't update and select on the same nested table. so order by desc and retrieve the highest id.
            $update->execute();
            return $update;
        }
        catch (Exception $e){
            return false;
        }
    }