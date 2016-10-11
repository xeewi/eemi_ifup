<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin IFUP - <?php if(isset($title)){ echo $title; }else{ echo 'Accueil';} ;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php if(isset($editor) && $editor == true){?>
            <!-- CKEDITOR -->
            <script type="text/javascript" src="../lib/ckeditor/ckeditor.js"></script>
        <?php } ?>
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

    <body class="flat-blue">
        <div class="app-container">
            <div class="row content-container">
                <nav class="navbar navbar-default navbar-fixed-top navbar-top">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-expand-toggle">
                                <i class="fa fa-bars icon"></i>
                            </button>
                            <ol class="breadcrumb navbar-breadcrumb">
                                <li class="active">Tableau de bord</li>
                            </ol>
                            <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                                <i class="fa fa-th icon"></i>
                            </button>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                                <i class="fa fa-times icon"></i>
                            </button>

                            <li>
                                <a href="../index.php?module=front&action=index">Accéder au site</a>
                            </li>

                            <li class="dropdown profile">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['admin']['ifup_user_admin_firstname']; ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu animated fadeInDown">
                                    <li class="profile-img">
                                        <img src="assets/img/ifup/logo-ifup.png" class="profile-img" alt="ifup">
                                    </li>
                                    <li>
                                        <div class="profile-info">
                                            <h4 class="username"><?php echo ucfirst($_SESSION['admin']['ifup_user_admin_firstname']) .' '. ucfirst($_SESSION['admin']['ifup_user_admin_lastname']); ?></h4>
                                            <p><?php echo $_SESSION['admin']['ifup_user_admin_email']; ?></p>
                                            <div class="btn-group margin-bottom-2x" role="group">
                                                <a href="index.php?module=user-admin&action=logout" class="btn btn-default"><i class="fa fa-sign-out"></i> Déconnexion</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="side-menu sidebar-inverse">
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="side-menu-container">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="index.php?module=home&action=index">
                                    <div class="icon"><img class="minicon" src="assets/img/ifup/logo-seul.png" alt="ifup"></div>
                                    <div class="title">IFUP</div>
                                </a>
                                <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                                    <i class="fa fa-times icon"></i>
                                </button>
                            </div>
                            <ul class="nav navbar-nav">
                                <li <?php if(!isset($_GET['module']) || $_GET['module'] == "home"){echo 'class="active"';} ?> >
                                    <a href="index.php?module=home&action=index">
                                        <span class="icon fa fa-tachometer"></span><span class="title">Tableau de bord</span>
                                    </a>
                                </li>

                                <li class="panel panel-default dropdown <?php if(isset($_GET['module']) && $_GET['module'] == "news"){echo 'active';} ?>">
                                    <a data-toggle="collapse" href="#dropdown-news">
                                        <span class="icon fa fa-newspaper-o"></span><span class="title">Actualités</span>
                                    </a>
                                    <!-- Dropdown level 1 -->
                                    <div id="dropdown-news" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul class="nav navbar-nav">
                                                <li><a href="index.php?module=news&action=index">Les actus</a></li>
                                                <li><a href="index.php?module=news&action=add-news">Ajouter une actu</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li class="panel panel-default dropdown <?php if(isset($_GET['module']) && $_GET['module'] == "faq"){echo 'active';} ?>">
                                    <a data-toggle="collapse" href="#dropdown-faq">
                                        <span class="icon fa fa-question-circle"></span><span class="title">FAQ</span>
                                    </a>
                                    <!-- Dropdown level 1 -->
                                    <div id="dropdown-faq" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul class="nav navbar-nav">
                                                <li><a href="index.php?module=faq&action=index">Les FAQs</a></li>
                                                <li><a href="index.php?module=faq&action=add-faq">Ajouter une FAQ</a></li>
                                                <li><a href="index.php?module=faq&action=faq-categories">Les catégories de FAQ</a></li>
                                                <li><a href="index.php?module=faq&action=add-faq-category">Ajouter une catégorie de FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li class="panel panel-default dropdown <?php if(isset($_GET['module']) && $_GET['module'] == "filter"){echo 'active';} ?>">
                                    <a data-toggle="collapse" href="#dropdown-filter">
                                        <span class="icon fa fa-slack"></span><span class="title">Filtres</span>
                                    </a>
                                    <!-- Dropdown level 1 -->
                                    <div id="dropdown-filter" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul class="nav navbar-nav">
                                                <li><a href="index.php?module=filter&action=index">Les filtres</a></li>
                                                <li><a href="index.php?module=filter&action=add-filter">Ajouter un filtre</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li class="panel panel-default dropdown <?php if(isset($_GET['module']) && $_GET['module'] == "user"){echo 'active';} ?>">
                                    <a data-toggle="collapse" href="#dropdown-user">
                                        <span class="icon fa fa-users"></span><span class="title">Utilisateurs</span>
                                    </a>
                                    <!-- Dropdown level 1 -->
                                    <div id="dropdown-user" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul class="nav navbar-nav">
                                                <li><a href="index.php?module=user&action=index">Les utilisateurs</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li class="panel panel-default dropdown <?php if(isset($_GET['module']) && $_GET['module'] == "service"){echo 'active';} ?>">
                                    <a data-toggle="collapse" href="#dropdown-service">
                                        <span class="icon fa fa-exchange"></span><span class="title">Services</span>
                                    </a>
                                    <!-- Dropdown level 1 -->
                                    <div id="dropdown-service" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul class="nav navbar-nav">
                                                <li><a href="index.php?module=service&action=index">Les services</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li class="panel panel-default dropdown <?php if(isset($_GET['module']) && $_GET['module'] == "newsletter"){echo 'active';} ?>">
                                    <a data-toggle="collapse" href="#dropdown-newsletter">
                                        <span class="icon fa fa-envelope"></span><span class="title">Newsletters</span>
                                    </a>
                                    <!-- Dropdown level 1 -->
                                    <div id="dropdown-newsletter" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul class="nav navbar-nav">
                                                <li><a href="index.php?module=newsletter&action=index">Les newsletters</a></li>
                                                <li><a href="index.php?module=newsletter&action=not-sent-newsletters">Les newsletters non-envoyées</a></li>
                                                <li><a href="index.php?module=newsletter&action=add-newsletter">Ajouter une newsletter</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </nav>
                </div>

                <!-- Main Content -->
                <div class="container-fluid">
                    <div class="side-body padding-top">
                        <!-- CONTENT -->
                            <!-- START FLASH MESSAGES -->
                            <?php
                            if(isset($_SESSION['flash']))
                            {
                                if(isset($_SESSION['flash']['success']) && !empty($_SESSION['flash']['success'])){
                                    ?>
                                    <div class="alert fresh-color alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <?php echo $_SESSION['flash']['success']; ?>
                                    </div>
                                    <?php
                                }
                                if(isset($_SESSION['flash']['warning']) && !empty($_SESSION['flash']['warning'])){
                                    ?>
                                    <div class="alert fresh-color alert-warning alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <?php echo $_SESSION['flash']['warning']; ?>
                                    </div>
                                    <?php
                                }
                                if(isset($_SESSION['flash']['danger']) && !empty($_SESSION['flash']['danger'])){
                                    ?>
                                    <div class="alert fresh-color alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <?php echo $_SESSION['flash']['danger']; ?>
                                    </div>
                                    <?php
                                }
                                unset($_SESSION['flash']);
                            }
                            ?>
                            <!-- END FLASH MESSAGES -->