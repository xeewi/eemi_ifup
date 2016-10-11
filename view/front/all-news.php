<?php
    $title = "IFUP - Nos Actualités";
    require_once("view/front/layout/header.front.inc.php");
?>
    <section id="article" xmlns="http://www.w3.org/1999/html">
        <div class="wrap-deco">
            <div class="clear"></div>
            <div class="intro-front"><h2 class="title ctr">Le Blog</h2></div>

            <!-- START NEWS -->
            <?php foreach($allNews as $news){?>
                <div class="article-preview-container">

                    <h3 class="title ctr space"><?php echo $news['ifup_news_title']; ?></h3>
                    <img  style="max-height: 100px; max-width: 100px" src="<?php echo $news['ifup_image_file'];?>" class="picto-article lft ctr-mobile" alt="<?php echo $news['ifup_image_alt'];?>" title="<?php echo $news['ifup_image_title'];?>">



                    <div id ="article-date" class="rgt ctr-mobile"><span class="cblue">Date de publication :</span> <?php echo date("d-m-Y",strtotime($news['ifup_news_date']));?></div>

                    </br>
                    <a  id="readmorenews" class="rgt ctr-mobile" href="index.php?module=front&action=show-news&news-id=<?php echo $news['ifup_news_id'];?>&page=<?php echo $page; ?>">Lire l'article</a>
                </div>

                <div class="clear"></div>
            <?php } ?>
            <!-- END NEWS -->

            <div class="clear"></div>

            <!-- START PAGINATION -->
            <ul class="pager">
                <?php
                $nbrPages = ($nbrNews / NEWS_PER_PAGE);
                $nbrPages = ceil($nbrPages);

                if($nbrPages <= 5){
                    for($i=1;$i<=$nbrPages;$i++)
                    {
                        ?>
                        <li><a <?php if($page == $i){echo 'class="active"';}?> href="index.php?module=front&action=all-news&page=<?php echo $i;?>"><?php echo $i; ?></a></li>
                        <?php
                    }
                }
                else{
                    for($i=1;$i<=3;$i++)
                    {
                        ?>
                        <li><a <?php if($page == $i){echo 'class="active"';}?> href="index.php?module=front&action=all-news&page=<?php echo $i;?>"><?php echo $i; ?></a></li>
                        <?php
                    }
                    ?>
                    <li><a  href="">.....</a></li>
                    <li><a <?php if($page == $nbrPages){echo 'class="active"';}?> href="index.php?module=front&action=all-news&page=<?php echo $nbrPages;?>"><?php echo $nbrPages; ?></a></li>
                    <?php
                }
                if($page > 1){
                    ?>
                    <li class="previous">
                        <a href="index.php?module=front&action=all-news&page=<?php echo $page-1;?>">&larr; Précédent</a>
                    </li>
                    <?php
                }
                if( $page < $nbrPages ) {
                    ?>
                    <li class="next">
                        <a href="index.php?module=front&action=all-news&page=<?php echo $page+1; ?>">Suivant &rarr;</a>
                    </li>
                    <?php
                }
                ?>
            </ul>
            <!-- END PAGINATION -->
        </div>
    </section>

<?php require_once("view/front/layout/footer.front.inc.php");?>