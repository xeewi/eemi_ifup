<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php if(isset($title)){ echo $title;} else{ echo 'IFUP - If You Please';} ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="IFUP, la communauté qui met en avant vos compétences et qui vous permet de profiter des meilleurs bons plans entre particuliers !" />
        <link rel="canonical" href="http://www.ifup.fr" />
        <meta property="og:locale" content="fr_FR" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="IFUP - If You Please" />
        <meta property="og:description" content="IFUP, la communauté qui met en avant vos compétences et qui vous permet de profiter des meilleurs bons plans entre particuliers !" />
        <meta property="og:url" content="http://ifup.fr" />
        <meta property="og:site_name" content="IFUP - If You Please" />
        <meta property="og:image" content="http://www.logo.jpg" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
        <link href="assets/css/mobile.css" rel="stylesheet" type="text/css" media="only screen and (min-width:200px) and (max-width:599px)" />
        <link href="assets/css/tablette.css" rel="stylesheet" type="text/css" media="only screen and (min-width:600px) and (max-width:1024px)" />
        <link rel="stylesheet" href="assets/css/jquery-ui.css" />
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
        <meta name="msapplication-TileImage" content="img/favicon/ms-icon-144x144.png">
    </head>

    <body>
    
    <div id="err-container">
        <div id="err-disp">
            <p id="err-msg">Il y a <span id="demo-result"></span> utilisateurs inscrits qui pourrait répondre à votre demande ! Inscrivez-vous pour utiliser IFUP!</p>
            <p id="err-button"><a href="#!" id="register-after">S'inscrire !</a></p>
        </div>

        <div id="err-back">
            
        </div>
    </div>
    <!-- START HEADER -->

        <div id="fb-root"></div>
        <script type="text/javascript">(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=1680924005497798";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>


        <a href="#" class="backtotop"><img src="assets/img/top.png" alt="Top"></a>

        <!-- START ROW -->
        <div class="row">
            <nav id="navbar" class="navbar-deco col-12">
                <span class="col-2 logo"><a href="index.php" title="Accueil"><img src="assets/img/logo-ifup.png" alt="logo"></a></span>

                <?php if(isset($_SESSION["user"])){ ?>
                    <span class="btn-nav rgt"><a href="index.php?module=user&action=logout">Se Déconnecter</a></span>
                    <span class="btn-deco purple rgt"><a href="index.php?module=back&action=index" title="Revenez sur votre espace iffer/upper">Espace Connecté</a></span>
                <?php } else{?>
                    <!-- BUTTON REGISTER -->
                    <span id="register" class="btn-deco purple rgt"><a href="#!" title="S'inscrire">S'inscrire</a></span>
                    <!-- START FORM REGISTER -->
                    <div id="bloc-register" class="popup-container">
                        <i class="fa fa-times-circle-o rgt close"></i>
                        <h2 class="title-popup">S'inscrire gratuitement</h2>
                        <form id="form-register" class="block-center" method="post" action="index.php?module=user&action=register">
                            <div>
                                <img src="assets/img/mail.png" class="arrow-select" alt="Mail">
                                <input name="ifup_user_email" class="forms-log" type="email" required placeholder="Votre adresse Email">
                            </div>
                            <div>
                                <img src="assets/img/password.png" class="arrow-select" alt="Mot de passe">
                                <input name="ifup_user_password" class="forms-log" type="password" required placeholder="Votre mot de passe">
                            </div>
                            <div>
                                <img src="assets/img/password.png" class="arrow-select" alt="Mot de passe">
                                <input name="ifup_user_confirm_password" class="forms-log" type="password" required placeholder="Confirmer votre mot de passe">
                            </div>
                            <button class="btn" title="S'inscrire" type="submit">S'inscrire</button>
                        </form>
                        <p class="ctr">En validant votre inscription, vous acceptez <a href="index.php?module=front&action=terms-of-service" title="Conditions générales d'utilisation">les conditions générales d'utilisation</a>.
                    </div>
                    <!-- END FORM REGISTER -->

                    <!-- BUTTON LOGIN -->
                    <span id="connect" class="btn-nav rgt"><a href="#!">Se connecter</a></span>
                    <!-- START FORM LOGIN -->
                    <div id="bloc-connect" class="popup-container">
                        <i class="fa fa-times-circle-o rgt close"></i>
                        <h2 class="title-popup">Se connecter</h2>
                        <form method="post" action="?module=user&amp;action=login" id="connect-form" class="block-center">
                            <div>
                                <img src="assets/img/mail.png" class="arrow-select" alt="mail">
                                <input name="ifup_user_email" class="forms-log" required type="email" placeholder="Votre adresse Email">
                            </div>
                            <div>
                                <img src="assets/img/password.png" class="arrow-select" alt="mot de passe">
                                <input name="ifup_user_password" class="forms-log" required type="password" placeholder="Votre mot de passe">
                            </div>
                            <button class="btn" title="Se connecter" type="submit">Se connecter</button>
                        </form>
                        <p class="ctr"><span><a href="index.php?module=user&action=forgot-password" title="Mot de passe oublié ?">Mot de passe oublié</a></span>
                        </p>
                    </div>
                    <!-- END FORM LOGIN -->
                <?php } ?>
            </nav>

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

    <!--  END HEADER -->