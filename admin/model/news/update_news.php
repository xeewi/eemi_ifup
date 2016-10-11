<?php
    function update_news($news_id, $form){
        try{
            global $bdd;
            $update = $bdd->prepare("UPDATE ifup_news SET ifup_news_title=:ifup_news_title,
                                                          ifup_news_content=:ifup_news_content
                                         WHERE ifup_news_id=:ifup_news_id");
            $update->bindParam(':ifup_news_title', $form["ifup_news_title"], PDO::PARAM_STR);
            $update->bindParam(':ifup_news_content', $form["ifup_news_content"], PDO::PARAM_STR);
            $update->bindParam(':ifup_news_id', $news_id, PDO::PARAM_INT);
            $update->execute();
            return true;
        }
        catch (Exception $e){
            return false;
        }
    }