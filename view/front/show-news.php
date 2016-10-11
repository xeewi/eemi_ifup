<?php
    $title = "IFUP - " . $currentNews["ifup_news_title"];
    require_once("view/front/layout/header.front.inc.php");
?>
    <section id="article-detail" class="space">
        <div class="wrap-deco">
            <div class="clear"></div>
            <div id="article-detail-container" >
                <div id="arianne" class="space"><a href="index.php?module=front&action=index" title="Accueil">Accueil</a> / <a href="index.php?module=front&action=all-news" title="News">News</a> / Article - <?php echo $currentNews["ifup_news_title"];?> </div>
                <div class="title space ctr"><?php echo $currentNews["ifup_news_title"];?></div>
                <div class="article-share rgt">
                    <span class="cblue space">Partager l'article :</span>
                    <a href="https://twitter.com/share?url=https://ifup.fr&amp;text=J'aime IFUP&amp;hashtags=#IFUP" target="_blank">
                        <i class="fa fa-twitter-square"></i>
                    </a>

                    <a href="mailto:?Subject=IFUP&amp;Body=J'aime IFUP https://ifup.fr">
                        <i class="fa fa-envelope"></i>
                    </a>

                    <a href="http://www.facebook.com/sharer.php?u=https://ifup.fr" target="_blank">
                        <i class="fa fa-facebook-official"></i>
                    </a>

                    <a href="https://plus.google.com/share?url=https://ifup.fr" target="_blank">
                        <i class="fa fa-google-plus-square"></i>
                    </a>

                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=https://ifup.fr" target="_blank">
                        <i class="fa fa-linkedin-square"></i>
                    </a>
                </div>

                <div id ="article-date" class=""><span class="cblue">Date de publication :</span> <?php echo date("d-m-Y",strtotime($currentNews['ifup_news_date']));?></div>
                <div class="ctr"><img src="<?php echo $currentNews["ifup_image_file"];?>" alt="<?php echo $currentNews["ifup_image_title"];?>" title="<?php echo $currentNews["ifup_image_title"];?>" class="picto-article"></div>
                <p><?php echo $currentNews["ifup_news_content"];?></p>
            </div>
        </div>
    </section>

<?php require_once("view/front/layout/footer.front.inc.php");?>