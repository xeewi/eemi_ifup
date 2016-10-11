<?php
    $editor = true;
    $title = "Ajouter une newsletter";
    require_once('view/layout/header.inc.php');
?>
    <div class="page-title">
        <span class="title">Ajouter une newsletter</span>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Ajouter une newsletter</div>
                    </div>
                    <div class="pull-right card-action">
                        <div class="btn-group" role="group" aria-label="...">
                            <a href="index.php?module=newsletter&action=index" class="btn btn-info right"><i class="fa fa-plus"> </i> Liste des newsletters</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="index.php?module=newsletter&action=add-newsletter" method="POST" enctype="multipart/form-data">
                        Renseignez tous ces champs pour créer une nouvelle newsletter.

                        <div class="sub-title">Titre de la newsletter <span class="description">(obligatoire)</span></div>
                        <input type="text" class="form-control" placeholder="Le titre de la newsletter..." name="ifup_newsletter_title" required>

                        <div class="sub-title">Objet de la newsletter <span class="description">(obligatoire)</span></div>
                        <input type="text" class="form-control" placeholder="L'objet de la newsletter..." name="ifup_newsletter_object" required>

                        <!-- START SECTION 1 -->
                        <div class="sub-title">Section 1 <span class="description">(obligatoire)</span></div>
                            <div class="form-group">
                                <label for="ifup_newsletter_section_1">Contenu de la section 1</label>
                                <textarea required class="form-control" rows="3" name="ifup_newsletter_section_1" id="ifup_newsletter_section_1" placeholder="Votre contenu..."></textarea>
                            </div>
                            <script type="text/javascript">
                                CKEDITOR.replace( 'ifup_newsletter_section_1' );
                            </script>

                            <div class="form-group">
                                <label for="ifup_image_file_1">Image de la section 1</label>
                                <input type="file" id="ifup_image_file_1" name="ifup_image_file_1" required>
                                <p class="help-block">Une image de 500px de largeur et de hauteur est conseillée au minimum.</p>
                            </div>

                            <div class="form-group">
                                <label for="ifup_newsletter_url_section_1">Lien de la section 1</label>
                                <input type="url" class="form-control" placeholder="Lien de la section 1..." id="ifup_newsletter_url_section_1" name="ifup_newsletter_url_section_1" required>
                            </div>

                            <div class="form-group">
                                <label for="ifup_newsletter_url_name_section_1">Nom du lien de la section 1</label>
                                <input type="text" class="form-control" placeholder="Nom du lien de la section 1..." id="ifup_newsletter_url_name_section_1" name="ifup_newsletter_url_name_section_1" required>
                            </div>
                        <!-- END SECTION 1 -->

                        <!-- START SECTION 2 -->
                        <div class="sub-title">Section 2 <span class="description">(obligatoire)</span></div>
                            <div class="form-group">
                                <label for="ifup_newsletter_section_2">Contenu de la section 2</label>
                                <textarea required class="form-control" rows="3" name="ifup_newsletter_section_2" id="ifup_newsletter_section_2" placeholder="Votre contenu..."></textarea>
                            </div>
                            <script type="text/javascript">
                                CKEDITOR.replace( 'ifup_newsletter_section_2' );
                            </script>

                            <div class="form-group">
                                <label for="ifup_image_file_2">Image de la section 2</label>
                                <input type="file" id="ifup_image_file_2" name="ifup_image_file_2" required>
                                <p class="help-block">Une image de 500px de largeur et de hauteur est conseillée au minimum.</p>
                            </div>

                            <div class="form-group">
                                <label for="ifup_newsletter_url_section_2">Lien de la section 2</label>
                                <input type="url" class="form-control" placeholder="Lien de la section 2..." id="ifup_newsletter_url_section_2" name="ifup_newsletter_url_section_2" required>
                            </div>

                            <div class="form-group">
                                <label for="ifup_newsletter_url_name_section_2">Nom du lien de la section 2</label>
                                <input type="text" class="form-control" placeholder="Nom du lien de la section 2..." id="ifup_newsletter_url_name_section_2" name="ifup_newsletter_url_name_section_2" required>
                            </div>
                        <!-- END SECTION 1 -->

                        <button type="submit" name="submit_form_add_newsletter" class="btn btn-default">Ajouter la newsletter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require_once('view/layout/footer.inc.php'); ?>