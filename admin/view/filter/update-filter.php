<?php
$title = "Modifier un filtre";
require_once('view/layout/header.inc.php');
?>
    <div class="page-title">
        <span class="title">Modifier un filtre</span>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Modifier un filtre</div>
                    </div>
                    <div class="pull-right card-action">
                        <div class="btn-group" role="group" aria-label="...">
                            <a href="index.php?module=filter&action=index" class="btn btn-info right"><i class="fa fa-plus"> </i> Liste des filtres</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="index.php?module=filter&action=update-filter&filter=<?php echo $_GET['filter'] ;?>" method="POST" enctype="multipart/form-data">

                        <div class="sub-title">Nom du filtre <span class="description">(obligatoire)</span></div>
                        <input type="text" class="form-control" placeholder="Le nom du filtre" name="ifup_filter_name" value="<?php echo $filter["ifup_filter_name"] ;?>" required>

                        <div class="sub-title">Changer d'image</div>

                        <div class="form-group">
                            <input type="file" id="ifup_image_file" name="ifup_image_file">
                            <p class="help-block">Une image de 100px de largeur et de hauteur est conseillée.</p>
                        </div>

                        <img src="../<?php echo $filter["ifup_image_file"] ;?>" alt="<?php echo $filter["ifup_image_alt"]; ?>" class="img-responsive text-center">
                        <input type="hidden" name="ifup_filter_image_id" value="<?php echo $filter["ifup_filter_image_id"] ;?>" required>
                        <input type="hidden" name="ifup_image_file" value="<?php echo $filter["ifup_image_file"] ;?>" required>

                        <button type="submit" name="submit_form_update_filter" class="btn btn-default">Modifier le filtre</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require_once('view/layout/footer.inc.php'); ?>