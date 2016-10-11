<?php
    $editor = true;
    $title = "Ajouter une FAQ";
    require_once('view/layout/header.inc.php');
?>


<div class="page-title">
    <span class="title">Ajouter une FAQ</span>
    <div class="description">Pensez à ajouter au moins une catégorie avant</div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">Ajouter une FAQ</div>
                </div>
                <div class="pull-right card-action">
                    <div class="btn-group" role="group" aria-label="...">
                        <a href="index.php?module=faq&action=add-faq-category" class="btn btn-info right"><i class="fa fa-plus"> </i> Ajouter une catégorie de FAQ</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="?module=faq&action=add-faq" method="POST">
                    Renseignez tous ces champs pour créer une nouvelle question/réponse.

                    <div class="sub-title">Catégorie de la Question/Réponse <span class="description">( <a href="index.php?module=faq&action=add-faq-category">ajoutez une catégorie ici</a> )</span></div>
                    <select class="select-large"  name="ifup_faq_category_id" required>
                        <?php foreach ($faq_cats as $key => $faq_cat) { ?>
                            <option value="<?php echo $faq_cat['ifup_faq_category_id']; ?>"><?php echo $faq_cat['ifup_faq_category_title']; ?></option>
                        <?php } ?>
                    </select>

                    <div class="sub-title">Question</div>
                    <input type="text" class="form-control" placeholder="La question" name="ifup_faq_question" required>

                    <div class="sub-title">Réponse</div>

                    <textarea required class="form-control" rows="3" name="ifup_faq_answer" id="ifup_faq_answer" placeholder="Votre Réponse à la question..."></textarea>

                        <script type="text/javascript">
                            CKEDITOR.replace( 'ifup_faq_answer' );
                        </script>

                    <button type="submit" name="submit_form_add_faq" class="btn btn-default">Ajouter la FAQ</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php require_once('view/layout/footer.inc.php'); ?>