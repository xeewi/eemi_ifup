<?php
    $title = "Liste des actualités";
    require_once('view/layout/header.inc.php');
?>

    <div class="page-title">
        <span class="title">Utilisateurs</span>
        <div class="description">Liste des utilisateurs de IFUP</div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Utilisateurs</div>
                    </div>
                </div>

                <div class="card-body">
                    <?php if(!empty($users)) {?>
                        <div class="table-responsive">
                            <table class="datatable table table-striped" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Taux horaire</th>
                                    <th>Etat de connexion</th>
                                    <th>Confirmation du compte</th>
                                    <th>Photo de profil</th>
                                    <th>Description</th>
                                    <th>Date d'inscription</th>
                                    <th>Voir</th>
                                    <th>Archiver</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#ID</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Taux horaire</th>
                                    <th>Etat de connexion</th>
                                    <th>Confirmation du compte</th>
                                    <th>Photo de profil</th>
                                    <th>Description</th>
                                    <th>Date d'inscription</th>
                                    <th>Voir</th>
                                    <th>Archiver</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php foreach ($users as $key => $user) { ?>
                                    <tr>
                                        <td><?php echo $user['ifup_user_id']; ?></td>
                                        <td><?php echo $user['ifup_user_firstname']; ?></td>
                                        <td><?php echo $user['ifup_user_lastname']; ?></td>
                                        <td><?php echo $user['ifup_user_time_rate'].'€/h'; ?></td>
                                        <td><?php if($user['ifup_user_online'] == 0 || $user['ifup_user_online']== NULL){ echo "Utilisateur déconnecté";}else{ echo "Utilisateur connecté";}; ?></td>
                                        <td><?php if($user['ifup_user_confirmation_token'] == NULL){ echo "Compte Confirmé";}else{ echo "Compte non-confirmé";} ?></td>
                                        <td>
                                            <?php if($user["ifup_user_image_id"] != NULL){?>
                                                <img class="img-responsive" style="max-height: 70px; max-width: 70px;" src="../<?php echo $user['ifup_image_file']; ?>">
                                            <?php } else { ?>
                                                <img class="img-responsive" style="max-height: 70px; max-width: 70px;" src="../assets/img/user.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php echo $user['ifup_user_biography']; ?></td>
                                        <td><?php echo date("d-m-Y",strtotime($user['ifup_user_register_date'])); ?></td>
                                        <td>
                                            <a class="btn btn-success" href="index.php?module=user&action=show-user&user=<?php echo $user['ifup_user_id']; ?>"><span class="glyphicon glyphicon-pencil"></span> Voir</a>
                                        </td>
                                        <td>
                                            <form action="index.php?module=user&action=archive-user" method="POST">
                                                <input type="hidden" name="ifup_user_id" value="<?php echo $user['ifup_user_id']; ?>">
                                                <button type="submit" class="btn btn-danger delete"><span class="glyphicon glyphicon-trash"></span> Archiver</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php }  ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else{ ?>
                        <h3 class="center">Vous n'avez pas d'utilisateur.</h3>
                        <div class="center">
                            <a href="index.php?module=home&action=index" class="btn btn-info"><i class="fa fa-home"></i> Retour à l'accueil</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

<?php require_once('view/layout/footer.inc.php'); ?>