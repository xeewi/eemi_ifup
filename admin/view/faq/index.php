<?php
    $title = "Liste des FAQS";
    require_once('view/layout/header.inc.php');
?>

    <div class="page-title">
        <span class="title">Foire aux questions</span>
        <div class="description">Liste des FAQS de IFUP</div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">FAQS</div>
                    </div>
                    <div class="pull-right card-action">
                        <div class="btn-group" role="group" aria-label="...">
                            <a href="index.php?module=faq&action=add-faq" class="btn btn-info right"><i class="fa fa-plus"></i> Ajouter une FAQ</a>
                        </div>
                    </div>
                    <div class="pull-right card-action">
                        <div class="btn-group" role="group" aria-label="...">
                            <a href="index.php?module=faq&action=add-faq-category" class="btn btn-info right"><i class="fa fa-plus"></i>Ajouter une catégorie de FAQ</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <?php if(!empty($faqs)) {?>
                        <div class="table-responsive">
                            <table class="datatable table table-striped" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Categorie</th>
                                    <th>Question</th>
                                    <th>Réponse</th>
                                    <th>Voir/Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Categorie</th>
                                    <th>Question</th>
                                    <th>Réponse</th>
                                    <th>Voir/Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php foreach ($faqs as $key => $faq) { ?>
                                    <tr>
                                        <td><?php echo $faq['ifup_faq_category_title']; ?></td>
                                        <td><?php echo $faq['ifup_faq_question']; ?></td>
                                        <td><?php echo $faq['ifup_faq_answer']; ?></td>
                                        <td>
                                            <a class="btn btn-success" href="index.php?module=faq&action=update-faq&faq=<?php echo $faq['ifup_faq_id']; ?>"><span class="glyphicon glyphicon-pencil"></span> Voir/Modifier</a>
                                        </td>
                                        <td>
                                            <form action="index.php?module=faq&action=delete-faq" method="POST">
                                                <input type="hidden" name="ifup_faq_id" value="<?php echo $faq['ifup_faq_id']; ?>">
                                                <button type="submit" class="btn btn-danger delete"><span class="glyphicon glyphicon-trash"></span> Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php }  ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else{ ?>
                        <h3 class="center">Vous n'avez aucune FAQ.</h3>
                        <div class="center">
                            <a href="index.php?module=home&action=index" class="btn btn-info"><i class="fa fa-home"></i> Retour à l'accueil</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

<?php require_once('view/layout/footer.inc.php'); ?>