<?php
    $title = "IFUP - FAQ - Foire aux Questions";
    require_once("view/front/layout/header.front.inc.php");
?>
    <section id="faq">

        <div class="wrap-deco">
            <div class="clear"></div>

            <div class="intro-front">
                <h2 class="title ctr">FAQ : Foire aux questions</h2>
            </div>
            <p class="ctr">Un problème ou une question ? Voici nos solutions !</p>

            <div id="faq-style">
                <?php if(isset($category)){ ?>
                    <h3 class="purple style-ol space"><?php echo ucfirst($faqs[0]["ifup_faq_category_title"]); ?></h3>
                    <div class="clear"></div>
                <?php } ?>
                <ul>
                    <?php if(!empty($faqs)) { ?>
                        <?php foreach($faqs as $faq) { ?>
                            <li>
                                <strong class="space cblue"><?php echo ucfirst($faq["ifup_faq_question"]);?></strong>
                                <?php if(!isset($category)){ ?>
                                    <span>- <?php echo ucfirst($faq["ifup_faq_category_title"]); ?> </span>
                                <?php } ?>
                            </li>
                            <p class="space style-faq"><?php echo ucfirst($faq["ifup_faq_answer"]);?></p>
                            <div class="clear"></div>
                        <?php }  ?>
                    <?php } else{ ?>
                        <h3 class="ctr">Vous n'avez aucune FAQ.</h3>
                        <div class="ctr">
                            <a href="index.php?module=front&action=index" class="btn btn-info"><i class="fa fa-home"></i> Retour à l'accueil</a>
                        </div>
                    <?php } ?>
                </ul>
            </div>

            <div id="faq-cat">
                <h3 class="purple style-ol space">Catégories</h3>
                <?php foreach ($faq_cats as $key => $value) { ?>
                    <a href="index.php?module=front&action=faq&category=<?php echo $value['ifup_faq_category_id']; ?>">
                        <?php echo ucfirst($value['ifup_faq_category_title']); ?>
                    </a>
                <?php } ?>
                <a href="index.php?module=front&action=faq">Toutes les FAQS</a>
            </div>

            <div class="clear"></div>
            <!-- START PAGINATION -->
            <ul class="pager">
                <?php
                $nbrPages = ($allFaqs / FAQS_PER_PAGE);
                $nbrPages = ceil($nbrPages);

                if($nbrPages <= 5){
                    for($i=1;$i<=$nbrPages;$i++)
                    {
                        ?>
                        <?php if(isset($_GET['category'])){ ?>
                            <li><a <?php if($page == $i){echo 'class="active"';}?> href="index.php?module=front&action=faq&category=<?php echo $_GET['category'];?>&page=<?php echo $i;?>"><?php echo $i; ?></a></li>
                        <?php }else{ ?>
                            <li><a <?php if($page == $i){echo 'class="active"';}?> href="index.php?module=front&action=faq&page=<?php echo $i;?>"><?php echo $i; ?></a></li>
                        <?php } ?>

                        <?php
                    }
                }
                else{
                    for($i=1;$i<=3;$i++)
                    {
                        ?>

                        <?php if(isset($category)){ ?>
                            <li><a <?php if($page == $i){echo 'class="active"';}?> href="index.php?module=front&action=faq&category=<?php echo $category;?>&page=<?php echo $i;?>"><?php echo $i; ?></a></li>
                        <?php }else{ ?>
                            <li><a <?php if($page == $i){echo 'class="active"';}?> href="index.php?module=front&action=faq&page=<?php echo $i;?>"><?php echo $i; ?></a></li>
                        <?php } ?>

                        <?php
                    }
                    ?>
                    <li><a  href="">.....</a></li>

                    <?php if(isset($category)){ ?>
                        <li><a <?php if($page == $nbrPages){echo 'class="active"';}?> href="index.php?module=front&action=faq&category=<?php echo $category;?>&page=<?php echo $nbrPages;?>"><?php echo $nbrPages; ?></a></li>
                    <?php }else{ ?>
                        <li><a <?php if($page == $nbrPages){echo 'class="active"';}?> href="index.php?module=front&action=faq&page=<?php echo $nbrPages;?>"><?php echo $nbrPages; ?></a></li>
                    <?php } ?>
                    <?php
                }
                if($page > 1){
                    ?>
                    <?php if(isset($category)){ ?>
                        <li class="previous">
                            <a href="index.php?module=front&action=faq&category=<?php echo $category;?>&page=<?php echo $page-1;?>">&larr; Précédent</a>
                        </li>
                    <?php }else{ ?>
                        <li class="previous">
                            <a href="index.php?module=front&action=faq&page=<?php echo $page-1;?>">&larr; Précédent</a>
                        </li>
                    <?php } ?>


                    <?php
                }
                if( $page < $nbrPages ) {
                    ?>

                    <?php if(isset($category)){ ?>
                        <li class="next">
                            <a href="index.php?module=front&action=faq&category=<?php echo $category;?>&page=<?php echo $page+1; ?>">Suivant &rarr;</a>
                        </li>
                    <?php }else{ ?>
                        <li class="next">
                            <a href="index.php?module=front&action=faq&page=<?php echo $page+1; ?>">Suivant &rarr;</a>
                        </li>
                    <?php } ?>

                    <?php
                }
                ?>
            </ul>
            <!-- END PAGINATION -->

        </div>
    </section>
<?php require_once("view/front/layout/footer.front.inc.php");?>