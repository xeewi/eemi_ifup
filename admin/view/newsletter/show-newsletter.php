<?php
    $title = "Voir une newsletter";
    require_once('view/layout/header.inc.php');
?>

    <div class="page-title">
        <span class="title">Newsletter n°<?php echo $newsletter["ifup_newsletter_id"]; ?></span>

        <div class="pull-right card-action">
            <div class="btn-group" role="group" aria-label="...">
                <a href="index.php?module=newsletter&action=index" class="btn btn-info right"><i class="fa fa-plus"></i> Liste des newsletters</a>
            </div>
        </div>
        <div class="description">
            <?php
            if($newsletter['ifup_newsletter_date'] != NULL ){
                echo "Statut : envoyée le " . date("d/m/Y \à H:i:s", strtotime($newsletter['ifup_newsletter_date']));
            }
            else{
                echo "Statut : non-envoyée";
            }
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Objet : <?php echo ucfirst($newsletter["ifup_newsletter_object"]); ?></div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="sub-title center">Titre : <?php echo ucfirst($newsletter["ifup_newsletter_title"]); ?></div>
                            <div class="table-responsive">
                                <iframe src="index.php?module=newsletter&action=show-newsletter-content-iframe&newsletter=<?php echo $newsletter['ifup_newsletter_id']; ?>" onload="resizeIframe(this)" id="show-newsletter" width="100%" frameborder="0" >
                                    <p>Votre navigateur ne supporte pas les iframes.</p>
                                </iframe>
                                <script type="text/javascript">
                                    function resizeIframe(obj) {
                                        obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(empty($newsletter['ifup_newsletter_date'])){?>
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="title">Action</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <a class="btn btn-info" href="index.php?module=newsletter&action=send-newsletter&newsletter=<?php echo $newsletter['ifup_newsletter_id']; ?>"><span class="glyphicon glyphicon-envelope"></span> Envoyer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

<?php require_once('view/layout/footer.inc.php'); ?>