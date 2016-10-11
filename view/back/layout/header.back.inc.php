<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php if(isset($title)){ echo $title;} else{ echo 'IFUP - Annonce';} ?></title>
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
<div id="err-container"></div>
<!-- START HEADER -->
    <!-- START ROW -->
    <div class="row">

        <nav id="navbar" class="col-12 navbar-connect">
            <div><span class="col-2 logo"><a href="index.php?module=back&action=index" title="Accueil"><img src="assets/img/logo-ifup.png"></a> </span></div>
            <div id="navbar-connect">


                <div id="menu" class="rgt">
                    <span id="navbar-profil" class="btn-connect"> <a href="index.php?module=back&action=profile" title="Mon Profil"><img class="profil-connect"
                        <?php if(!empty($_SESSION['user']['ifup_image_file'])) { echo 'src="'. $_SESSION['user']['ifup_image_file'] . '"';} else {?>src="assets/img/user.png"<?php }?>
                                                                       alt="votre image de profil" title="votre image de profil"></a>
                    </span>
                </div>
            </div>
        </nav>

        <section id="sidebar" class="col-1">
            <div id="sidebar-list" class="ctr">
                <ul>
                    <li class="links" id="link-if"><a href="index.php?module=back&action=index" title="Mode IF"> <i class="picto-sidebar color-up">IF</i><div><strong class="sidebar-label">Je demande</strong></div></a></li>
                    <li class="links" id="link-up"><a href="index.php?module=back&action=mode-up" title="Mode UP"> <i class="picto-sidebar color-up">UP</i><div><strong class="sidebar-label">J'offre</strong></div></a></li>
                    <li class="links"><a href="index.php?module=back&action=settings" title="Mes réglages upper"><i class="fa fa-cog color-up"></i><div><strong class="sidebar-label">Mes réglages upper</strong></div></a></li>
                    <li class="links"><a href="index.php?module=back&action=profile" title="Mon Profil"> <i class="fa fa-user color-up"></i><div><span class="sidebar-label">Mon Profil</span></div></a></li>
                    <li class="links"><a href="index.php?module=front&action=faq" title="FAQ"> <i class="fa fa-question-circle color-up"></i><div><span class="sidebar-label">FAQ</span></div></a></li>
                    <li class="links"><a href="index.php?module=user&action=logout" title="Se déconnecter"> <i class="fa fa-user-times red"></i><div><span class="sidebar-label">Déconnexion</span></div></a></li>
                    <li class="links" id="link-cancel">
                        <a href="#!" id="cancel" title="Annuler la demande"> 
                            <i class="fa fa-ban red"></i>
                            <div>
                                <span class="sidebar-label">Annuler</span>
                            </div>
                        </a>
                    </li>
                </ul>
                <div id="display-sidebar"><img src="assets/img/icon/squares.png" alt="Menu"></div>
            </div>
        </section>

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

<!-- END HEADER -->