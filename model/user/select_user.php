<?php
    function select_user($user_email, $user_password)
    {
        try {
            global $bdd;

            //=======================
            //select data of the user :
            //=======================
            $query_select_user = "SELECT * FROM ifup_user u
                                    LEFT JOIN ifup_image i
                                    ON u.ifup_user_image_id = i.ifup_image_id
                                    WHERE u.ifup_user_email=:ifup_user_email
                                    AND u.ifup_user_password=:ifup_user_password
                                    AND u.ifup_user_confirmation_token IS NULL
                                    AND u.ifup_user_archived_at IS NULL";//because if not null, account is not yet confirmed and is archived.
            $select_user = $bdd->prepare($query_select_user);
            $select_user->bindParam(':ifup_user_email', $user_email, PDO::PARAM_STR);
            $select_user->bindParam(':ifup_user_password', $user_password, PDO::PARAM_STR);
            $select_user->execute();
            $user = $select_user->fetch();
            $select_user->closeCursor();
            return $user;
        } catch (Exception $e) {
            return false;
        }
    }