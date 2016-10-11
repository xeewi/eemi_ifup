<?php
    $editor = true;
    $title = "Ajouter une actualité";
    require_once('view/layout/header.inc.php');
?>
    <div class="page-title">
        <span class="title">Ajouter une actualité</span>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Ajouter une actualité</div>
                    </div>
                    <div class="pull-right card-action">
                        <div class="btn-group" role="group" aria-label="...">
                            <a href="index.php?module=news&action=index" class="btn btn-info right"><i class="fa fa-plus"> </i> Liste des actualités</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="index.php?module=news&action=add-news" method="POST" enctype="multipart/form-data">
                        Renseignez tous ces champs pour créer une nouvelle actualité.

                        <div class="sub-title">Titre de l'actualité <span class="description">(obligatoire)</span></div>
                        <input type="text" class="form-control" placeholder="Le titre de l'actu..." name="ifup_news_title" required>

                        <div class="sub-title">Ajouter une image <span class="description">( obligatoire )</span></div>
                            <div class="form-group">
                                <label for="ifup_image_file">Mon image</label>
                                <input type="file" id="ifup_image_file" name="ifup_image_file" required>
                                <p class="help-block">Une image de 500px de largeur et de hauteur est conseillée au minimum.</p>
                            </div>
                            <div class="form-group">
                                <label for="ifup_image_title">Titre de l'image</label>
                                <input type="text" class="form-control" id="ifup_image_title" name="ifup_image_title" required>
                            </div>
                            <div class="form-group">
                                <label for="ifup_image_alt">Texte alternatif de l'image</label>
                                <p class="help-block">Texte qui s'affiche lorsque l'image n'est pas chargée ou qui permet aux mal-voyants de comprendre l'image.</p>
                                <input type="text" class="form-control" id="ifup_image_alt" name="ifup_image_alt" required>
                            </div>

                        <div class="sub-title">Contenu de l'actualité <span class="description">(obligatoire)</span></div>
                        <textarea required class="form-control" rows="3" name="ifup_news_content" id="ifup_news_content" placeholder="Votre contenu..."></textarea>
                        <script type="text/javascript">
                            CKEDITOR.replace( 'ifup_news_content' );
                        </script>

                        <button type="submit" name="submit_form_add_news" class="btn btn-default">Ajouter l'actualité</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require_once('view/layout/footer.inc.php'); ?>