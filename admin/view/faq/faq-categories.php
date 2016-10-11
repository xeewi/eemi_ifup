<?php
    $title = "Catégories de FAQ";
    require_once('view/layout/header.inc.php');
?>

    <div class="page-title">
        <span class="title">Catégories de FAQ</span>
        <div class="description">Liste des catégories de FAQ</div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Catégories de FAQ</div>
                    </div>
                    <?php if(!empty($faq_cats)) {?>
                        <div class="pull-right card-action">
                            <div class="btn-group" role="group" aria-label="...">
                                <a href="index.php?module=faq&action=index" class="btn btn-info right"><i class="fa fa-plus"></i> Liste des FAQs</a>
                            </div>
                        </div>
                        <div class="pull-right card-action">
                            <div class="btn-group" role="group" aria-label="...">
                                <a href="index.php?module=faq&action=add-faq" class="btn btn-info right"><i class="fa fa-plus"></i> Ajouter une FAQ</a>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="pull-right card-action">
                        <div class="btn-group" role="group" aria-label="...">
                            <a href="index.php?module=faq&action=add-faq-category" class="btn btn-info right"><i class="fa fa-plus"></i>Ajouter une catégorie de FAQ</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <?php if(!empty($faq_cats)) {?>
                        <div class="table-responsive">
                            <table class="datatable table table-striped" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Categorie</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Categorie</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php foreach ($faq_cats as $key => $faq_cat) { ?>
                                    <tr>
                                        <td><?php echo $faq_cat['ifup_faq_category_id']; ?></td>
                                        <td><?php echo $faq_cat['ifup_faq_category_title']; ?></td>
                                        <td>
                                            <a class="btn btn-success" href="index.php?module=faq&action=update-faq-category&faq-cat=<?php echo $faq_cat['ifup_faq_category_id']; ?>"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>
                                        </td>
                                        <td>
                                            <form action="index.php?module=faq&action=delete-faq-category" method="POST">
                                                <input type="hidden" name="ifup_faq_category_id" value="<?php echo $faq_cat['ifup_faq_category_id']; ?>">
                                                <button type="submit" class="btn btn-danger delete"><span class="glyphicon glyphicon-trash"></span> Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php }  ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else{ ?>
                        <h3 class="center">Vous n'avez aucune catégorie de FAQ.</h3>
                        <div class="center">
                            <a href="index.php?module=home&action=index" class="btn btn-info"><i class="fa fa-home"></i> Retour à l'accueil</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

<?php require_once('view/layout/footer.inc.php'); ?>