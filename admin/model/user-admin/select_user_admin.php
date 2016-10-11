<?php
    function select_user_admin($user_email, $user_password)
    {
        try {
            global $bdd;

            //=======================
            //select data of the user :
            //=======================
            $query_select_user = "SELECT * FROM ifup_user_admin a
                                        WHERE a.ifup_user_admin_email=:ifup_user_admin_email
                                        AND a.ifup_user_admin_password=:ifup_user_admin_password";
            $select_user = $bdd->prepare($query_select_user);
            $select_user->bindParam(':ifup_user_admin_email', $user_email, PDO::PARAM_STR);
            $select_user->bindParam(':ifup_user_admin_password', $user_password, PDO::PARAM_STR);
            $select_user->execute();
            $user = $select_user->fetch();
            $select_user->closeCursor();
            return $user;
        } catch (Exception $e) {
            return false;
        }
    }