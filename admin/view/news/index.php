<?php
$title = "Liste des actualités";
require_once('view/layout/header.inc.php');
?>

    <div class="page-title">
        <span class="title">Actualités IFUP</span>
        <div class="description">Liste des actualités de IFUP</div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Actualités</div>
                    </div>
                    <div class="pull-right card-action">
                        <div class="btn-group" role="group" aria-label="...">
                            <a href="index.php?module=news&action=add-news" class="btn btn-info right"><i class="fa fa-plus"></i> Ajouter une actualité</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <?php if(!empty($allNews)) {?>
                        <div class="table-responsive">
                            <table class="datatable table table-striped" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Date de publication</th>
                                    <th>Titre</th>
                                    <th>Contenu</th>
                                    <th>Image</th>
                                    <th>Voir/Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Date de publication</th>
                                    <th>Titre</th>
                                    <th>Contenu</th>
                                    <th>Image</th>
                                    <th>Voir/Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php foreach ($allNews as $key => $news) { ?>
                                    <tr>
                                        <td>#<?php echo $news['ifup_news_id']; ?></td>
                                        <td><?php echo date("d-m-Y \à H:i:s",strtotime($news['ifup_news_date'])); ?></td>
                                        <td><?php echo $news['ifup_news_title']; ?></td>
                                        <td><?php echo $news['ifup_news_content']; ?></td>
                                        <td><img class="img-responsive" style="max-height: 70px; max-width: 70px;" src="../<?php echo $news['ifup_image_file']; ?>" title="<?php echo $news['ifup_image_title']; ?>" alt="<?php echo $news['ifup_image_alt']; ?>"></td>
                                        <td>
                                            <a class="btn btn-success" href="index.php?module=news&action=update-news&news=<?php echo $news['ifup_news_id']; ?>"><span class="glyphicon glyphicon-pencil"></span> Voir/Modifier</a>
                                        </td>
                                        <td>
                                            <form action="index.php?module=news&action=delete-news" method="POST">
                                                <input type="hidden" name="ifup_news_id" value="<?php echo $news['ifup_news_id']; ?>">
                                                <button type="submit" class="btn btn-danger delete"><span class="glyphicon glyphicon-trash"></span> Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php }  ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else{ ?>
                        <h3 class="center">Vous n'avez aucune actualité.</h3>
                        <div class="center">
                            <a href="index.php?module=home&action=index" class="btn btn-info"><i class="fa fa-home"></i> Retour à l'accueil</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

<?php require_once('view/layout/footer.inc.php'); ?>