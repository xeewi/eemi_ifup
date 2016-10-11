<?php
    function select_user_img($user_id)
    {
        try {
            global $bdd;

            //=======================
            //select data of the user img :
            //=======================
            $query_select_user = "SELECT u.ifup_user_image_id, i.ifup_image_id, i.ifup_image_file, i.ifup_image_title, i.ifup_image_alt  FROM ifup_user u
                                        LEFT JOIN ifup_image i
                                        ON u.ifup_user_image_id = i.ifup_image_id
                                        WHERE u.ifup_user_id=:ifup_user_id
                                        AND u.ifup_user_confirmation_token IS NULL";//because if not null, account is not yet confirmed
            $select_user = $bdd->prepare($query_select_user);
            $select_user->bindParam(':ifup_user_id', $user_id, PDO::PARAM_INT);
            $select_user->execute();
            $user_img = $select_user->fetch();
            $select_user->closeCursor();
            return $user_img;
        } catch (Exception $e) {
            return false;
        }
    }