<?php
$title = "Ajouter un filtre";
require_once('view/layout/header.inc.php');
?>
    <div class="page-title">
        <span class="title">Ajouter un filtre</span>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Ajouter un filtre</div>
                    </div>
                    <div class="pull-right card-action">
                        <div class="btn-group" role="group" aria-label="...">
                            <a href="index.php?module=filter&action=index" class="btn btn-info right"><i class="fa fa-plus"> </i> Liste des filtres</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="index.php?module=filter&action=add-filter" method="POST" enctype="multipart/form-data">
                        Renseignez tous ces champs pour créer une nouveau filtre.

                        <div class="sub-title">Nom du filtre <span class="description">( obligatoire )</span></div>
                        <input type="text" class="form-control" placeholder="Le nom du filtre" name="ifup_filter_name" required>

                        <div class="sub-title">Ajouter une image <span class="description">( obligatoire )</span></div>
                        <div class="form-group">
                            <input type="file" id="ifup_image_file" name="ifup_image_file" required>
                            <p class="help-block">Une image de 100px de largeur et de hauteur est conseillée.</p>
                        </div>

                        <button type="submit" name="submit_form_add_filter" class="btn btn-default">Ajouter le filtre</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require_once('view/layout/footer.inc.php'); ?>