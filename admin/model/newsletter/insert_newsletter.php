<?php
    function insert_newsletter($title, $object, $content){
        try{
            global $bdd;

            $insert = $bdd->prepare("INSERT INTO ifup_newsletter(ifup_newsletter_content, ifup_newsletter_object, ifup_newsletter_title)
                                                VALUES(:ifup_newsletter_content, :ifup_newsletter_object, :ifup_newsletter_title)");

            $insert->bindParam(':ifup_newsletter_title', $title, PDO::PARAM_STR);
            $insert->bindParam(':ifup_newsletter_object', $object, PDO::PARAM_STR);
            $insert->bindParam(':ifup_newsletter_content', $content, PDO::PARAM_STR);
            $insert->execute();
            return $insert;
        }
        catch (Exception $e){
            return false;
        }
    }