<?php
    function insert_news($form_news){
        try{
            global $bdd;

            $insert = $bdd->prepare("INSERT INTO ifup_news(ifup_news_title, ifup_news_content, ifup_news_date)
                                            VALUES(:ifup_news_title, :ifup_news_content, NOW())");

            $insert->bindParam(':ifup_news_title', $form_news["ifup_news_title"], PDO::PARAM_STR);
            $insert->bindParam(':ifup_news_content', $form_news["ifup_news_content"], PDO::PARAM_STR);
            $insert->execute();
            return $insert;
        }
        catch (Exception $e){
            return false;
        }
    }