<?php
$title = "Liste des filtres";
require_once('view/layout/header.inc.php');
?>

    <div class="page-title">
        <span class="title">Filtres IFUP</span>
        <div class="description">Liste des filtres de IFUP</div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Filtres</div>
                    </div>
                    <div class="pull-right card-action">
                        <div class="btn-group" role="group" aria-label="...">
                            <a href="index.php?module=filter&action=add-filter" class="btn btn-info right"><i class="fa fa-plus"></i> Ajouter un filtre</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <?php if(!empty($filters)) {?>
                        <div class="table-responsive">
                            <table class="datatable table table-striped" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Nom</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Nom</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php foreach ($filters as $key => $filter) { ?>
                                    <tr>
                                        <td><?php echo $filter['ifup_filter_id']; ?></td>
                                        <td><img class="img-responsive" style="max-height: 70px; max-width: 70px;" src="../<?php echo $filter['ifup_image_file']; ?>" title="<?php echo $filter['ifup_image_title']; ?>" alt="<?php echo $filter['ifup_image_alt']; ?>"></td>
                                        <td><?php echo $filter['ifup_filter_name']; ?></td>

                                        <td>
                                            <a class="btn btn-success" href="index.php?module=filter&action=update-filter&filter=<?php echo $filter['ifup_filter_id']; ?>"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>
                                        </td>
                                        <td>
                                            <form action="index.php?module=filter&action=archive-filter" method="POST">
                                                <input type="hidden" name="ifup_filter_id" value="<?php echo $filter['ifup_filter_id']; ?>">
                                                <button type="submit" class="btn btn-danger delete"><span class="glyphicon glyphicon-trash"></span> Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php }  ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else{ ?>
                        <h3 class="center">Vous n'avez aucun filtre.</h3>
                        <div class="center">
                            <a href="index.php?module=home&action=index" class="btn btn-info"><i class="fa fa-home"></i> Retour à l'accueil</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

<?php require_once('view/layout/footer.inc.php'); ?>