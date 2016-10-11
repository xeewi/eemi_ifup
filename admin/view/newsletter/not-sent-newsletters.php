<?php
$title = "Newsletters non-envoyées";
require_once('view/layout/header.inc.php');
?>

    <div class="page-title">
        <span class="title">Newsletters non-envoyées</span>
        <div class="description">Liste des newsletters non-envoyées de IFUP</div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Newsletters non-envoyées</div>
                    </div>
                    <div class="pull-right card-action">
                        <div class="btn-group" role="group" aria-label="...">
                            <a href="index.php?module=newsletter&action=add-newsletter" class="btn btn-info right"><i class="fa fa-plus"></i> Ajouter une newsletter</a>
                        </div>
                    </div>
                    <div class="pull-right card-action">
                        <div class="btn-group" role="group" aria-label="...">
                            <a href="#" class="btn btn-info right"><i class="fa fa-users"></i> <?php echo $nbr_contacts; ?> abonnés à la newsletter</a>
                        </div>
                    </div>
                    <div class="pull-right card-action">
                        <div class="btn-group" role="group" aria-label="...">
                            <a href="index.php?module=newsletter&action=index" class="btn btn-info right"><i class="fa fa-envelope"></i> Liste des newsletters</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <?php if(!empty($newsletters)) {?>
                        <div class="table-responsive">
                            <table class="datatable table table-striped" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Objet</th>
                                    <th>Titre</th>
                                    <th>Envoyer</th>
                                    <th>Voir</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Objet</th>
                                    <th>Titre</th>
                                    <th>Envoyer</th>
                                    <th>Voir</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php foreach ($newsletters as $key => $newsletter) { ?>
                                    <tr>
                                        <td>#<?php echo $newsletter['ifup_newsletter_id']; ?></td>
                                        <td><?php echo $newsletter['ifup_newsletter_object']; ?></td>
                                        <td><?php echo $newsletter['ifup_newsletter_title']; ?></td>
                                        <td>
                                            <?php if(empty($newsletter['ifup_newsletter_date'])){?>
                                                <a class="btn btn-info" href="index.php?module=newsletter&action=send-newsletter&newsletter=<?php echo $newsletter['ifup_newsletter_id']; ?>"><span class="glyphicon glyphicon-envelope"></span> Envoyer</a>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-success" href="index.php?module=newsletter&action=show-newsletter&newsletter=<?php echo $newsletter['ifup_newsletter_id']; ?>"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>
                                        </td>
                                    </tr>
                                <?php }  ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else{ ?>
                        <h3 class="center">Vous n'avez aucune newsletter en attente d'envoi.</h3>
                        <div class="center">
                            <a href="index.php?module=home&action=index" class="btn btn-info"><i class="fa fa-home"></i> Retour à l'accueil</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

<?php require_once('view/layout/footer.inc.php'); ?>