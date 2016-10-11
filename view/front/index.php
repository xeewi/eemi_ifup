<?php
    $title = "IFUP - If You Please - La plateforme de rencontre entre offre et demande";
    require_once("view/front/layout/header.front.inc.php");
?>
    <section id="section1">
        <div id="forms-home" class="block-center">
            <div id="intro-home">
                <h2 class="ctr intro">Imaginez une communauté qui met en avant vos compétences et qui vous permet de profiter des meilleurs bons plans.</h2>
                <div class="title-ifup"><span class="cblue">IF</span><span class="purple">UP</span></div>
            </div>

            <div id="scroll" class="bounce space"><i class="fa fa-arrow-down"></i></div>

            <div id="forms-container-home" class="ctr space">
                <h2 class="title">J'ai besoin d'un service</h2>
                <p>Regardez si des utilisateurs pourraient vous aider !</p>

                <form id="search" class="ctr" method="post" action="#">
                    <div class="line-form">
                        <i class="fa fa-hashtag arrow-select2"></i>
                        <select class="select select-wrapper" id="demo-filter" required="required">
                            <option selected="filter">▾ Filtre</option>
                            <?php foreach ($filters as $key => $filter) { ?>
                                <option value="<?php echo $filter['ifup_filter_id']; ?>">
                                    <?php echo $filter['ifup_filter_name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="line-form">
                        <i class="fa fa-street-view arrow-select2"></i>
                        <input id="demo-position" class="forms-settings-input" type="text" placeholder="Votre position..." required="required">
                    </div>

                    <div class="line-form">
                        <i class="fa fa-clock-o arrow-select2"></i>
                        <select class="select select-wrapper" id="select-index">
                            <option selected="delais">▾ Délais</option>
                            <option>Immédiatement</option>
                            <option>Moins de 48 heures</option>
                            <option>Plus de 48 heures</option>
                        </select>
                    </div>

                    <div class="line-form">
                        <button class="btn" type="submit" id="submit-home">Rechercher</button>
                    </div>
                </form>
            </div>
            <img id="down" src="assets/img/down.png" alt="down">
        </div>
    </section>

    <div class="clear"></div>


    <div id="map-home" class="col-12">
        <iframe src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d10498.82211160225!2d2.3399891763256915!3d48.86382541697922!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e6!4m5!1s0x47e671fd86b33f39%3A0x45d782e2444c552f!2sRivoli+Couture%2C+Rue+de+Rivoli%2C+Paris!3m2!1d48.8556465!2d2.3588047!4m5!1s0x47e66e3cf4eb73d5%3A0x95719384f2f9d47e!2sBourse%2C+Paris!3m2!1d48.868648!2d2.341374!5e0!3m2!1sfr!2sfr!4v1451573130956" border="0" width="100%" height="450" frameborder="0" style="pointer-events:none;" allowfullscreen></iframe>
    </div>

    <div class="clear"></div>

    <section id="section3">
        <?php if(!isset($_SESSION['user'])){?>
            <div id="index-explain">
                <div class="col-6 lft">
                    <h4 class="title-ifup">IFUP</h4>
                    <p>C’est très simple, c’est gratuit et cela ne prend que quelques minutes !
                        Il suffit de vous rendre sur la page d’accueil et de cliquer sur « M’inscrire » situé en haut à droite ou rendez-vous directement sur cette page.
                        Vous accèderez ensuite à un formulaire à compléter avec des informations vous concernant
                    </p>
                    <a href="#!" title="S'inscrire" id="index-register" class="btn rgt">S'inscrire</a>
                </div>
                <div class="col-6 content-center">
                    <ul class="col-4"><li><img class="" src="assets/img/icon/menage.svg" alt=""></li>
                        <li><img class="" src="assets/img/icon/informatique.svg" alt=""></li>
                        <li><img class="" src="assets/img/icon/cuisine.svg" alt=""></li>
                    </ul>
                    <ul class="col-4"><li><img class="" src="assets/img/icon/animaux.svg" alt=""></li>
                        <li><img class="" src="assets/img/icon/livraison.svg" alt=""></li>
                        <li><img class="" src="assets/img/icon/jardinage.svg" alt=""></li>
                    </ul>
                    <ul class="col-4 none-mobile"><li><img class="" src="assets/img/icon/reparation.svg" alt=""></li>
                        <li><img class="" src="assets/img/icon/démenagement.svg" alt=""></li>
                        <li><img class="" src="assets/img/icon/administratif.svg" alt=""></li>
                    </ul>
                </div>
            </div>
        <?php } else{ ?>
            <div id="index-explain">
                <div class="col-6 lft">
                    <h4 class="title-ifup">INVITER UN AMI</h4>
                    <p>Vous pouvez inviter un ami à rejoindre la communauté ifup en lui envoyant un mail.</p>
                    <form method="post" action="index.php?module=front&action=invite-people">
                        <div>
                            <i class="fa fa-at arrow-select3"></i>
                            <input name="ifup_user_email" class="invite-settings-input" type="email" required placeholder="Adresse Email de l'invité">
                            <button type="submit" class="btn rgt" name="submit_form_invite">Inviter</button>
                        </div>
                    </form>
                </div>

                <div class="rgt col-6 content-center">
                    <ul class="col-4"><li><img class="" src="assets/img/icon/menage.svg" alt=""></li>
                        <li><img class="" src="assets/img/icon/informatique.svg" alt=""></li>
                        <li><img class="" src="assets/img/icon/cuisine.svg" alt=""></li>
                    </ul>
                    <ul class="col-4 none-mobile"><li><img class="" src="assets/img/icon/animaux.svg" alt=""></li>
                        <li><img class="" src="assets/img/icon/livraison.svg" alt=""></li>
                        <li><img class="" src="assets/img/icon/jardinage.svg" alt=""></li>
                    </ul>
                    <ul class="col-4 none-mobile"><li><img class="" src="assets/img/icon/reparation.svg" alt=""></li>
                        <li><img class="" src="assets/img/icon/démenagement.svg" alt=""></li>
                        <li><img class="" src="assets/img/icon/administratif.svg" alt=""></li>
                    </ul>
                </div>
            </div>
        <?php } ?>
    </section>

    <div id="section2" class="space">
        <div class="col-4 ctr bt1"> <img src="assets/img/if.png" alt="IF"></div>
        <div class="col-4 ctr"><img src="assets/img/ifup.png" alt="IFUP"></div>
        <div class="col-4 ctr bt2"> <img src="assets/img/up.png" alt="UP"></div>
    </div>

    <div id="people-home" class="col-12 space">
        <h2 class="ctr title">TEMOIGNAGES</h2>
        <div class="col-4 ctr">
            <div class="bloc-container">
                <img src="assets/img/profil1.jpg" class="profil-pics" title="Guillaume" alt="témoignage">
                <h6>Guillaume - 23 ans</h6>
                <blockquote>
                    <p>
                        "Grâce à IFUP, je peux enfin m'accorder du temps en me détachant des tâches quotidiennes "
                    </p>
                </blockquote>
            </div>
        </div>
        <div class="col-4 ctr">
            <div class="bloc-container">
                <img src="assets/img/profil2.jpg" class="profil-pics" title="Lisa" alt="témoignage">
                <h6>Lisa - 27 ans</h6>
                <blockquote>
                    <p>
                        "Cette communauté m'a permis de faire d'excellentes rencontres et d'arrondir mes fins de mois"
                    </p>
                </blockquote>
            </div>
        </div>
        <div class="col-4 ctr">
            <div class="bloc-container">
                <img src="assets/img/profil3.jpg" class="profil-pics" title="Paul" alt="témoignage">
                <h6>Paul - 42 ans</h6>
                <blockquote>
                    <p>
                        "Une interface intuitive et très simple à prendre en main !"
                    </p>
                </blockquote>
            </div>
        </div>
    </div>
<?php require_once("view/front/layout/footer.front.inc.php");?>