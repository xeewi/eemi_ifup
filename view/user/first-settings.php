<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>IFUP - Configuration de votre compte IFUP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="IFUP, la communauté qui met en avant vos compétences et qui vous permet de profiter des meilleurs bons plans entre particuliers !" />
    <link rel="canonical" href="http://www.ifup.fr" />
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="IFUP - Annonce" />
    <meta property="og:description" content="IFUP, la communauté qui met en avant vos compétences et qui vous permet de profiter des meilleurs bons plans entre particuliers !" />
    <meta property="og:url" content="http://ifup.fr" />
    <meta property="og:site_name" content="IFUP - If You Please" />
    <meta property="og:image" content="http://www.logo.jpg" />
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/jquery-ui.css" />
	<link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="assets/css/mobile.css" rel="stylesheet" type="text/css" media="only screen and (min-width:200px) and (max-width:599px)" />
    <link href="assets/css/tablette.css" rel="stylesheet" type="text/css" media="only screen and (min-width:600px) and (max-width:1024px)" />
     <link rel="apple-touch-icon" sizes="57x57" href="assets/img/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="assets/img/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="assets/img/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="assets/img/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="assets/img/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="assets/img/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="assets/img/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon/favicon-16x16.png">
	<link rel="manifest" href="assets/img/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="assets/img/favicon/ms-icon-144x144.png">
</head>

<body>


    <div class="row">
        <nav id="navbar" class="col-12 navbar-deco">
            <div><span class="col-2 logo"><img src="assets/img/logo-ifup.png"></span></div>
        </nav>
    </div>

    <!-- START FLASH MESSAGES -->
    <?php
    if(isset($_SESSION['flash']))
    {
        if(isset($_SESSION['flash']['success']) && !empty($_SESSION['flash']['success'])){
            ?>
            <div class="alert-success">
                <?php echo $_SESSION['flash']['success']; ?>
            </div>
            <?php
        }
        if(isset($_SESSION['flash']['warning']) && !empty($_SESSION['flash']['warning'])){
            ?>
            <div class="alert-warning">
                <?php echo $_SESSION['flash']['warning']; ?>
            </div>
            <?php
        }
        if(isset($_SESSION['flash']['danger']) && !empty($_SESSION['flash']['danger'])){
            ?>
            <div class="alert-danger">
                <?php echo $_SESSION['flash']['danger']; ?>
            </div>
            <?php
        }
        unset($_SESSION['flash']);
    }
    ?>
    <!-- END FLASH MESSAGES -->

    <section id="fist-settings" class="wrap-deco space">

        <div class="ctr blue">Bienvenue dans la communauté IFUP !</div>

        <p class="ctr">Pour confirmer votre inscription, veuillez compléter les informations suivantes. Vous pourre ensuite accéder à la plateforme.</p>

        <form id="form-first-settings" class="wrap-deco" enctype="multipart/form-data" method="post" action="index.php?module=user&action=first-settings&token=<?php echo $_GET["token"]; ?>">

            <div class="lft col-5">
                <div>
                    <i class="fa fa-user arrow-select2"></i>
                    <input name="ifup_user_firstname" class="forms-first-settings-input" type="text" required placeholder="Votre Prénom">
                </div>
                <div class="clear"></div>
                <div><i class="fa fa-user arrow-select2"></i>
                    <input name="ifup_user_lastname" class="forms-first-settings-input" type="text" required placeholder="Votre Nom">
                </div>
                <div class="clear"></div>
                <div><i class="fa fa-envelope arrow-select2"></i>
                    <input class="forms-first-settings-input" type="email" disabled readonly="readonly"  placeholder="<?php echo $_SESSION['user']['ifup_user_email']; ?>">
                </div>
            </div>

            <div class="rgt col-5">
                <div>
                    <i class="fa fa-phone arrow-select2"></i>
                    <input name="ifup_user_phone" class="forms-first-settings-input" type="text" required placeholder="Votre Numéro">
                </div>
                <div class="clear"></div>
                <div>
                    <i class="fa fa-birthday-cake arrow-select2"></i>
                    <input name="ifup_user_birthday" class="forms-first-settings-input" type="date" min="1900-01-01" id="Date" required placeholder="Votre date de naissance">
                </div>
                <div class="clear"></div>
                <div>
                    <i class="fa fa-euro arrow-select2"></i>
                    <select  class="select-wrapper forms-first-settings-input" name="ifup_user_time_rate">
                        <?php for($k = 1; $k<=30; $k++){?>
                            <option value="<?php echo $k;?>"><?php echo $k;?> € de l'heure</option>
                        <?php }?>
                    </select>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <div>
                <p class="ctr">Biographie (Courte description de vous) :</p>
                <textarea name="ifup_user_biography" class="white forms-settings-input" placeholder="Etudiant dans le web, je suis dynamique est très ouvert d'esprit...."></textarea>
            </div>


            <div class="space"> <label>Uploader une photo de profil <i id="info-pics" class="fa fa-question-circle"></i></label>
                <div id="popup-pics"><ul><li>Poids : 1 mo</li><li>Taille : 150x150 px</li><li>Format : jpg & png</li></div><br/>
                <input class="space" type="file" name="ifup_image_file">
            </div>

            <div id="my-filters">
                <div class="title ctr space">Vos choix de filtres</div>
                <p class="ctr">Configurez vos filtres afin de cibler au mieux vos demandes</p>
                <ul class="ctr">
                    <?php foreach($filters as $key => $filter){?>
                        <li>
                            <span><img class="filter-ico" src="<?php echo $filter['ifup_image_file']; ?>" alt="<?php echo $filter['ifup_image_alt']; ?>" title="<?php echo $filter['ifup_image_title']; ?>"></span>
                            <input id="ifup_user_filters_<?php echo $key;?>" type="checkbox" name="ifup_user_filters[]" value="<?php echo $filter["ifup_filter_id"]; ?>">
                            <label for="ifup_user_filters_<?php echo $key;?>"><?php echo ucfirst($filter["ifup_filter_name"]); ?></label>
                        </li>
                    <?php } ?>
                </ul>

                <div class="title ctr space">Vos choix d'arrondissements</div>
                <p class="ctr">Configurez vos arrondissements afin de cibler au mieux vos demandes</p>

                <div id="arrondissement" class="center-ard">
                    <ul class="ctr">
                        <?php foreach($districts as $key => $district){?>
                            <li>
                                <input id="ifup_user_districts_<?php echo $key;?>" type="checkbox" name="ifup_user_districts[]" value="<?php echo $district["ifup_district_id"]; ?>">
                                <label for="ifup_user_districts_<?php echo $key;?>"><?php echo ucfirst($district["ifup_district_name"]); ?></label>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <div class="ctr">
                <button type="submit" name="form_settings_submit" class="btn ctr space">Confirmer mon compte</button>
            </div>
        </form>

        <div class="clear"></div>
    </section>

    <footer class="col-12">
        <div id="subfooter" class="col-12">
            <span class="ctr">Tous Droits réservés - 2016 - IFUP</span>
        </div>
    </footer>

    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>
</body>

</html>