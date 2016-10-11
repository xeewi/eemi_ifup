<?php
$editor = true;
$title = "Modifier une actualité";
require_once('view/layout/header.inc.php');
?>
    <div class="page-title">
        <span class="title">Mofifier une actualité</span>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Modifier une actualité</div>
                    </div>
                    <div class="pull-right card-action">
                        <div class="btn-group" role="group" aria-label="...">
                            <a href="index.php?module=news&action=index" class="btn btn-info right"><i class="fa fa-plus"> </i> Liste des actualités</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="index.php?module=news&action=update-news&news=<?php echo $_GET['news'] ;?>" method="POST" enctype="multipart/form-data">

                        <div class="sub-title">Titre de l'actualité <span class="description">(obligatoire)</span></div>
                        <input type="text" class="form-control" placeholder="Le titre de l'actu..." name="ifup_news_title" value="<?php echo $news["ifup_news_title"] ;?>" required>

                        <div class="sub-title">Changer d'image</div>
                            <div class="form-group">
                                <label for="ifup_image_file">Mon image</label>
                                <input type="file" id="ifup_image_file" name="ifup_image_file">
                                <p class="help-block">Une image de 300px de largeur et de hauteur est conseillée.</p>
                            </div>

                            <img src="../<?php echo $news["ifup_image_file"] ;?>" alt="<?php echo $news["ifup_image_alt"]; ?>" class="img-responsive center-block">
                            <input type="hidden" name="ifup_news_image_id" value="<?php echo $news["ifup_news_image_id"] ;?>" required>
                            <input type="hidden" name="ifup_image_file" value="<?php echo $news["ifup_image_file"] ;?>" required>

                            <div class="form-group">
                                <label for="ifup_image_title">Titre de l'image</label>
                                <input type="text" class="form-control" id="ifup_image_title" name="ifup_image_title" value="<?php echo $news["ifup_image_title"] ;?>" required>
                            </div>
                            <div class="form-group">
                                <label for="ifup_image_alt">Texte alternatif de l'image</label>
                                <p class="help-block">Texte qui s'affiche lorsque l'image n'est pas chargée ou qui permet aux mal-voyants de comprendre l'image.</p>
                                <input type="text" class="form-control" id="ifup_image_alt" name="ifup_image_alt" value="<?php echo $news["ifup_image_alt"] ;?>" required>
                            </div>

                        <div class="sub-title">Contenu de l'actualité <span class="description">(obligatoire)</span></div>
                        <textarea required class="form-control" rows="3" name="ifup_news_content" id="ifup_news_content" placeholder="Votre contenu...">
                            <?php echo $news["ifup_news_content"] ;?>
                        </textarea>
                        <script type="text/javascript">
                            CKEDITOR.replace( 'ifup_news_content' );
                        </script>

                        <button type="submit" name="submit_form_update_news" class="btn btn-default">Modifier l'actualité</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require_once('view/layout/footer.inc.php'); ?>