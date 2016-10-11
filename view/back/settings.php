<?php
    $title = "IFUP - Mes Paramètres UPPER";
    require_once("view/back/layout/header.back.inc.php");
?>
    <section id="my-filters" class="wrap-connect col-11">
        <form method="post" action="index.php?module=back&action=settings">
            <div class="title ctr space">Configurer mes filtres de demande</div>
            <p class="ctr">Configurez vos filtres afin de cibler au mieux vos demandes</p>

            <ul class="ctr">
                <?php foreach($filters as $key => $filter){?>
                    <li>
                        <span><img class="filter-ico" src="<?php echo $filter['ifup_image_file']; ?>" alt="<?php echo $filter['ifup_image_alt']; ?>" title="<?php echo $filter['ifup_image_title']; ?>"></span>
                        <input id="ifup_user_filters_<?php echo $key;?>" type="checkbox" name="ifup_user_filters[]"
                            <?php
                            if(isset($_SESSION['user']['ifup_user_filters'])){
                                $ifup_user_filters = $_SESSION['user']['ifup_user_filters'];
                                $nbr_ifup_user_filters = count($ifup_user_filters);

                                for($w = 0; $w < $nbr_ifup_user_filters; $w++){
                                    if( $filter["ifup_filter_id"] == $ifup_user_filters[$w]['ifup_filter_id']){
                                        echo 'checked="checked"';
                                    }
                                }
                            }
                            ?>
                               value="<?php echo $filter["ifup_filter_id"]; ?>">
                        <label for="ifup_user_filters_<?php echo $key;?>"><?php echo $filter["ifup_filter_name"]; ?></label>
                    </li>
                <?php } ?>
            </ul>

            <div class="title ctr space">Vos choix d'arrondissement</div>
            <p class="ctr">Configurez vos arrondissements afin de cibler au mieux vos demandes</p>

            <div id="arrondissement" class="center-ard">
                <ul class="ctr">
                    <?php foreach($districts as $key => $district){?>
                        <li>
                            <input id="ifup_user_districts_<?php echo $key;?>" type="checkbox" name="ifup_user_districts[]"
                                   <?php
                                   if(isset($_SESSION['user']['ifup_user_districts'])){
                                       $ifup_user_districts = $_SESSION['user']['ifup_user_districts'];
                                       $nbr_ifup_user_districts = count($ifup_user_districts);

                                       for($u = 0; $u < $nbr_ifup_user_districts; $u++){
                                           if($district["ifup_district_id"] == $ifup_user_districts[$u]['ifup_district_id']){
                                               echo 'checked="checked"';
                                           }
                                       }
                                   }
                                   ?>
                                   value="<?php echo $district["ifup_district_id"]; ?>">
                            <label for="ifup_user_districts_<?php echo $key;?>"><?php echo $district["ifup_district_name"]; ?></label>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <div class="ctr">
                <button type="submit" name="submit_form_settings" class="btn">Valider mes paramètres Upper</button>
                <button type="reset" class="btn-decline ">Réinitialiser</button>
            </div>
        </form>

    </section>
<?php require_once("view/back/layout/footer.back.inc.php");?>