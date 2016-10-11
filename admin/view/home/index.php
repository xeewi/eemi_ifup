<?php
    $chart = true;
    $title = "Tableau de bord";
    require_once('view/layout/header.inc.php');
?>
    <!-- START USER -->
    <div class="page-title">
        <span class="title">Utilisateurs</span>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
            <div class="card card-success">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Informations principales</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12 col-md-6 col-lg-6">
                            <a href="index.php?module=user&action=index">
                                <div class="card blue summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-users fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $nbrUsers ?></div>
                                            <div class="sub-title">
                                                <?php if($nbrUsers > 1){ echo 'Utilisateurs';}else{ echo 'Utilisateur';} ?>
                                            </div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-sm-8 col-xs-12 col-md-6 col-lg-6">
                            <a href="index.php?module=user&action=index">
                                <div class="card blue summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-user-plus fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $nbrUsersInMonth ?></div>
                                            <div class="sub-title">
                                                <?php if($nbrUsersInMonth > 1){ echo 'Nouveaux utilisateurs ce mois-ci(confirmés';}else{ echo 'Nouveau utilisateur ce mois-ci (confirmé)';} ?>
                                            </div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
                            <a href="index.php?module=user&action=index">
                                <div class="card blue summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-user-secret fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $nbrUsersNotConfirmed ?></div>
                                            <div class="sub-title">
                                                <?php if($nbrUsersNotConfirmed > 1){ echo 'comptes utilisateur non confirmés';}else{ echo 'compte utilisateur non confirmé';} ?>
                                            </div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
                            <a href="index.php?module=user&action=index">
                                <div class="card blue summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-archive fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $nbrUsersArchived ?></div>
                                            <div class="sub-title">
                                                <?php if($nbrUsersArchived > 1){ echo 'comptes utilisateur archivés';}else{ echo 'compte utilisateur archivé';} ?>
                                            </div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="panel panel-success fresh-color">
                        <!-- Default panel contents -->
                        <div class="panel-heading">Les derniers utilisateurs</div>
                        <!--<div class="panel-body"></div>-->
                        <div class="table-responsive">
                            <table class="table table-striped ">
                                <thead>
                                <tr>
                                    <th>Date d'inscription</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Taux horaire</th>
                                    <th>Confirmation du compte</th>
                                    <th>Photo de profil</th>
                                    <th>Voir</th>
                                    <th>Archiver</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($last_users as $last_user) {?>
                                    <tr>
                                        <td><?php echo date("d-m-Y \à H:i:s",strtotime($last_user['ifup_user_register_date'])); ?></td>
                                        <td><?php echo $last_user['ifup_user_firstname']; ?></td>
                                        <td><?php echo $last_user['ifup_user_lastname']; ?></td>
                                        <td><?php echo $last_user['ifup_user_time_rate'].'€/h'; ?></td>
                                        <td><?php if($last_user['ifup_user_confirmation_token'] == NULL){ echo "Compte Confirmé";}else{ echo "Compte non-confirmé";} ?></td>
                                        <td>
                                            <?php if($last_user["ifup_user_image_id"] != NULL){?>
                                                <img class="img-responsive" style="max-height: 50px; max-width: 50px;" src="../<?php echo $last_user['ifup_image_file']; ?>">
                                            <?php } else { ?>
                                                <img class="img-responsive" style="max-height: 70px; max-width: 70px;" src="../assets/img/user.png">
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-success" href="index.php?module=user&action=show-user&user=<?php echo $last_user['ifup_user_id']; ?>"><span class="glyphicon glyphicon-pencil"></span> Voir</a>
                                        </td>
                                        <td>
                                            <form action="index.php?module=user&action=archive-user" method="POST">
                                                <input type="hidden" name="ifup_user_id" value="<?php echo $last_user['ifup_user_id']; ?>">
                                                <button type="submit" class="btn btn-danger delete"><span class="glyphicon glyphicon-trash"></span> Archiver</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-6">
            <div class="card card-info">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title" id="ranking-user-title"><span class="fa fa-bar-chart"></span> Classement des meilleurs utilisateurs d'IFUP</div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="jumbotron-bar-chart-user" class="center-block" height="400px"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- END USER -->


    <!-- NEWS & FAQS IN 1 ROW -->
    <div class="row">
        <!-- START NEWS -->
        <div class="col-xs-12 col-md-6 col-lg-6">
            <div class="page-title">
                <span class="title">Actualités</span>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <a href="index.php?module=news&action=index">
                                <div class="card blue summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-newspaper-o fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $nbrNews ?></div>
                                            <div class="sub-title">
                                                <?php if($nbrNews > 1){ echo 'Actualités';}else{ echo 'Actualité';} ?>
                                            </div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <a href="index.php?module=news&action=index">
                                <div class="card green summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-calendar fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $nbrNewsInMonth ?></div>
                                            <div class="sub-title">
                                                <?php if($nbrNewsInMonth > 1){ echo 'Actualités publiées ce mois';}else{ echo 'Actualité publiée ce mois';} ?>
                                            </div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END NEWS -->

        <!-- START FAQ -->
        <div class="col-xs-12 col-md-6 col-lg-6">
            <div class="page-title">
                <span class="title">FAQs</span>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <a href="index.php?module=faq&action=index">
                                <div class="card blue summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-question-circle fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $nbrFaqs ?></div>
                                            <div class="sub-title">
                                                <?php if($nbrFaqs > 1){ echo 'FAQs';}else{ echo 'FAQ';} ?>
                                            </div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <a href="index.php?module=faq&action=faq-categories">
                                <div class="card green summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-inbox fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $nbrFaqCategories ?></div>
                                            <div class="sub-title">
                                                <?php if($nbrFaqCategories > 1){ echo 'Catégories de FAQs';}else{ echo 'Catégorie de FAQs';} ?>
                                            </div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END FAQ -->
    </div>
    <!-- NEWS & FAQS IN 1 ROW -->

    <!-- START FILTER -->
    <div class="page-title">
        <span class="title">Filtres</span>
    </div>
    <div class="row">
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-6">
            <div class="card card-success">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Informations principales</div>
                    </div>
                </div>
                <div class="card-body">
                    <a href="index.php?module=filter&action=index">
                        <div class="card blue summary-inline">
                            <div class="card-body">
                                <i class="icon fa fa-slack fa-4x"></i>
                                <div class="content">
                                    <div class="title"><?php echo $nbrFilters ?></div>
                                    <div class="sub-title">
                                        <?php if($nbrFilters > 1){ echo 'Filtres';}else{ echo 'Filtre';} ?>
                                    </div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                    </a>
                    <br/>
                    <div class="panel panel-success fresh-color">
                        <!-- Default panel contents -->
                        <div class="panel-heading">Les derniers filtres</div>
                        <!--<div class="panel-body"></div>-->
                        <div class="table-responsive">
                            <table class="table table-striped ">
                                <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>Nom</th>
                                        <th>Image du filtre</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($last_filters as $last_filter) {?>
                                    <tr>
                                        <td><?php echo $last_filter["ifup_filter_id"];?></td>
                                        <td><?php echo $last_filter["ifup_filter_name"];?></td>
                                        <td><img style="max-height: 50px; max-width: 50px;" src="../<?php echo $last_filter["ifup_image_file"];?>"></td>
                                        <td>
                                            <a class="btn btn-success" href="index.php?module=filter&action=update-filter&filter=<?php echo $last_filter['ifup_filter_id']; ?>"><span class="glyphicon glyphicon-eye-open"></span> Voir/modifier</a>
                                        </td>
                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-6">
            <div class="card card-info">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title" id="ranking-filter-title"><span class="fa fa-bar-chart"></span> Classement des meilleurs filtres</div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="jumbotron-bar-chart-filter" class="center-block" height="400px"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- END FILTER -->



    <!-- SERVICES & NEWSLETTERS IN 1 ROW -->
    <div class="row">
        <!-- START SERVICES -->
        <div class="col-xs-12 col-md-6 col-lg-6">
            <div class="page-title">
                <span class="title">Services</span>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <a href="index.php?module=service&action=index">
                                <div class="card blue summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-check-circle fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $nbrServicesCompleted ?></div>
                                            <div class="sub-title">
                                                <?php if($nbrServicesCompleted > 1){ echo 'Services effectués';}else{ echo 'Service effectué';} ?>
                                            </div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <a href="index.php?module=service&action=index">
                                <div class="card green summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-calendar fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $nbrServicesCompletedInMonth ?></div>
                                            <div class="sub-title">
                                                <?php if($nbrServicesCompletedInMonth > 1){ echo 'Services effectués ce mois-ci';}else{ echo 'Service effectué ce mois-ci';} ?>
                                            </div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <a href="index.php?module=service&action=index">
                                <div class="card red summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-ban fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $nbrServicesCanceled ?></div>
                                            <div class="sub-title">
                                                <?php if($nbrServicesCanceled > 1){ echo 'Services annulés';}else{ echo 'Service annulé';} ?>
                                            </div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <a href="index.php?module=service&action=index">
                                <div class="card yellow summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-exchange fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $nbrServicesPending ?></div>
                                            <div class="sub-title">
                                                <?php if($nbrServicesPending > 1){ echo 'Services en cours';}else{ echo 'Service en cours';} ?>
                                            </div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SERVICES -->

        <!-- START NEWSLETTERS -->
        <div class="col-xs-12 col-md-6 col-lg-6">
            <div class="page-title">
                <span class="title">Newsletters</span>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <a href="index.php?module=newsletter&action=index">
                                <div class="card blue summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-envelope fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $nbrNewsletters ?></div>
                                            <div class="sub-title">
                                                <?php if($nbrNewsletters > 1){ echo 'Newsletters';}else{ echo 'Newsletter';} ?>
                                            </div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <a href="index.php?module=newsletter&action=not-sent-newsletters">
                                <div class="card yellow summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-exclamation-circle fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $nbrNewslettersNotSent ?></div>
                                            <div class="sub-title">
                                                <?php if($nbrNewslettersNotSent > 1){ echo 'Newsletters non-envoyées';}else{ echo 'Newsletter non-envoyée';} ?>
                                            </div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a href="index.php?module=newsletter&action=index">
                                <div class="card green summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-users fa-4x"></i>
                                        <div class="content">
                                            <div class="title"><?php echo $nbrNewsletterSubscribers ?></div>
                                            <div class="sub-title">
                                                <?php if($nbrNewsletterSubscribers > 1){ echo 'abonnés à la newsletter';}else{ echo 'abonné à la newsletter';} ?>
                                            </div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END FAQ -->
    </div>
    <!-- NEWS & FAQS IN 1 ROW -->
<?php require_once('view/layout/footer.inc.php'); ?>