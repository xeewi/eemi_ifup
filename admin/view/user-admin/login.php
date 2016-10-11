<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>IFUP Admin - Connexion</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
        <!-- CSS Libs -->
        <link rel="stylesheet" type="text/css" href="assets/lib/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/lib/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/lib/css/animate.min.css">
        <link rel="stylesheet" type="text/css" href="assets/lib/css/bootstrap-switch.min.css">
        <link rel="stylesheet" type="text/css" href="assets/lib/css/checkbox3.min.css">
        <link rel="stylesheet" type="text/css" href="assets/lib/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="assets/lib/css/dataTables.bootstrap.css">
        <link rel="stylesheet" type="text/css" href="assets/lib/css/select2.min.css">
        <!-- CSS App -->
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="assets/css/themes/flat-blue.css">
    </head>

    <body class="flat-blue login-page">
        <!-- START FLASH MESSAGES -->
        <?php
        if(isset($_SESSION['flash']))
        {
            foreach($_SESSION['flash'] as $type => $message)
            {
                ?>
                <div>
                    <div class="alert fresh-color alert-<?php echo $type; ?> alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $message; ?>
                    </div>
                </div>
                <?php
                unset($_SESSION['flash']);
            }
        }
        ?>
        <!-- END FLASH MESSAGES -->
        <div class="container">
            <div class="login-box">
                <div>
                    <div class="login-form row">
                        <div class="col-sm-12 text-center login-header">
                            <div><img class="" src="assets/img/ifup/logo-seul.png"></div>
                            <h4 class="login-title">IFUP Admin - Connexion</h4>
                        </div>
                        <div class="col-sm-12">
                            <div class="login-body">
                                <div class="progress hidden" id="login-progress">
                                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        Log In...
                                    </div>
                                </div>
                                <form action="index.php?module=user-admin&action=login" method="POST">
                                    <div class="control">
                                        <input type="text" name ="ifup_user_admin_email" class="form-control" placeholder="Votre adresse email" />
                                    </div>
                                    <div class="control">
                                        <input type="password" name="ifup_user_admin_password" class="form-control" placeholder="Votre mot de passe" />
                                    </div>
                                    <div class="login-button text-center">
                                        <input type="submit" class="btn btn-primary" value="Connexion">
                                    </div>
                                </form>
                            </div>
                            <div class="login-footer">
                                <span class="text-right"><a href="index.php?module=user-admin&action=forgot-password" class="color-white">Mot de passe oublié ?</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Javascript Libs -->
        <script type="text/javascript" src="assets/lib/js/jquery.min.js"></script>
        <script type="text/javascript" src="assets/lib/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/lib/js/Chart.min.js"></script>
        <script type="text/javascript" src="assets/lib/js/bootstrap-switch.min.js"></script>
        <script type="text/javascript" src="assets/lib/js/jquery.matchHeight-min.js"></script>
        <script type="text/javascript" src="assets/lib/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="assets/lib/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/lib/js/select2.full.min.js"></script>
        <script type="text/javascript" src="assets/lib/js/ace/ace.js"></script>
        <script type="text/javascript" src="assets/lib/js/ace/mode-html.js"></script>
        <script type="text/javascript" src="assets/lib/js/ace/theme-github.js"></script>
        <!-- Javascript -->
        <script type="text/javascript" src="assets/js/app.js"></script>
        <script type="text/javascript" src="assets/js/index.js"></script>

    </body>
</html>
