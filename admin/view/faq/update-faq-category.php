<?php
    $title = "Modifier une catégorie de FAQ";
    require_once('view/layout/header.inc.php');
?>
    <div class="page-title">
        <span class="title">Mofifier une catégorie de FAQ</span>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Modifier une catégorie de FAQ</div>
                    </div>
                    <div class="pull-right card-action">
                        <div class="btn-group" role="group" aria-label="...">
                            <a href="index.php?module=faq&action=add-faq-category" class="btn btn-info right"><i class="fa fa-plus"> </i> Ajouter une catégorie de FAQ</a>
                        </div>
                    </div>
                    <div class="pull-right card-action">
                        <div class="btn-group" role="group" aria-label="...">
                            <a href="index.php?module=faq&action=faq-categories" class="btn btn-info right"><i class="fa fa-plus"> </i> Liste des catégories de FAQ</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="index.php?module=faq&action=update-faq-category&faq-cat=<?php echo $_GET['faq-cat'] ;?>" method="POST">

                        <div class="sub-title">Nom de la catégorie</div>
                        <input type="text" class="form-control" placeholder="Le nom de la catégorie" name="ifup_faq_category_title" value="<?php echo $faq_cat["ifup_faq_category_title"] ;?>" required>

                        <button type="submit" name="submit_form_update_faq_category" class="btn btn-default">Modifier la catégorie</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require_once('view/layout/footer.inc.php'); ?>