<?php
    $title = "Voir un service";
    require_once('view/layout/header.inc.php');
?>

    <div class="page-title">
        <span class="title">Service n°<?php echo $service["ifup_service_id"]; ?></span>

        <div class="pull-right card-action">
            <div class="btn-group" role="group" aria-label="...">
                <a href="index.php?module=service&action=index" class="btn btn-info right"><i class="fa fa-plus"></i> Liste des services</a>
            </div>
        </div>
        <div class="description">
            <?php
            if($service['ifup_service_start'] != NULL && $service['ifup_service_finish'] == NULL){
                echo "En cours - commencé le " . date("d/m/Y \à H:i:s", strtotime($service['ifup_service_start']));
            }
            elseif($service['ifup_service_start'] != NULL && $service['ifup_service_finish'] != NULL){
                echo date("d/m/Y - H:i:s", strtotime($service['ifup_service_start'])) . " au " . date("d/m/Y - H:i:s", strtotime($service['ifup_service_finish']));
            }
            elseif($service['ifup_service_start'] == NULL && $service['ifup_service_finish'] != NULL){
                echo "Demande annulée le " . date("d/m/Y \à H:i:s", strtotime($service['ifup_service_finish']));
            }else{
                echo "Pas encore débuté";
            }
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Informations principales</div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                            <div class="sub-title">Service </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Caractéristique</th>
                                            <th>Valeur</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">#ID</th>
                                            <td><?php echo $service['ifup_service_id']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Adresse de la prestation</th>
                                            <td><?php echo $service['ifup_service_address']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Message</th>
                                            <td><?php echo $service['ifup_service_message']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                            <div class="sub-title">Filtre choisi </div>
                            <a href="index.php?module=filter&action=update-filter&filter=<?php echo $service['ifup_filter_id']; ?>">
                                <div class="card blue summary-inline">
                                    <div class="card-body">
                                        <i class="icon"><img src="../<?php echo $service['ifup_image_file']; ?>"></i>
                                        <div class="content">
                                            <div class="title"><?php echo ucfirst($service['ifup_filter_name']); ?></div>
                                            <div class="sub-title">id : <?php echo $service['ifup_filter_id']; ?></div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Les 2 utilisateurs</div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="sub-title">Iffer</div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>Identité</th>
                                        <th>Photo de profil</th>
                                        <th>Email</th>
                                        <th>N° Téléphone</th>
                                        <th>Description</th>
                                        <th>Date d'inscription</th>
                                        <th>Date d'anniversaire</th>
                                        <th>Connexion</th>
                                        <th>Etat du compte</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><?php echo $user_iffer["ifup_user_id"];?></td>
                                        <td><?php echo $user_iffer["ifup_user_firstname"] . " " . $user_iffer["ifup_user_lastname"];?></td>
                                        <td>
                                            <?php if($user_iffer["ifup_user_image_id"] != NULL){?>
                                                <img class="img-responsive" style="max-height: 70px; max-width: 70px;" src="../<?php echo $user_iffer['ifup_image_file']; ?>">
                                            <?php } else { ?>
                                                <img class="img-responsive" style="max-height: 70px; max-width: 70px;" src="../assets/img/user.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php echo $user_iffer["ifup_user_email"];?></td>
                                        <td><?php echo $user_iffer["ifup_user_phone"];?></td>
                                        <td><?php echo $user_iffer["ifup_user_biography"];?></td>
                                        <td><?php echo $user_iffer["ifup_user_register_date"];?></td>
                                        <td><?php echo $user_iffer["ifup_user_birthday"];?></td>
                                        <td><?php if($user_iffer['ifup_user_online'] == 0 || $user_iffer['ifup_user_online']== NULL){ echo "Utilisateur déconnecté";}else{ echo "Utilisateur connecté";}; ?></td>
                                        <td><?php if($user_iffer['ifup_user_archived_at'] == NULL){ echo "Compte activé";}else{ echo "Compte archivé";}; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="sub-title">Upper</div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>Identité</th>
                                        <th>Photo de profil</th>
                                        <th>Email</th>
                                        <th>N° Téléphone</th>
                                        <th>Description</th>
                                        <th>Date d'inscription</th>
                                        <th>Date d'anniversaire</th>
                                        <th>Connexion</th>
                                        <th>Etat du compte</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><?php echo $user_upper["ifup_user_id"];?></td>
                                        <td><?php echo $user_upper["ifup_user_firstname"] . " " . $user_upper["ifup_user_lastname"];?></td>
                                        <td>
                                            <?php if($user_upper["ifup_user_image_id"] != NULL){?>
                                                <img class="img-responsive" style="max-height: 70px; max-width: 70px;" src="../<?php echo $user_upper['ifup_image_file']; ?>">
                                            <?php } else { ?>
                                                <img class="img-responsive" style="max-height: 70px; max-width: 70px;" src="../assets/img/user.png">
                                            <?php } ?>
                                        </td>
                                        <td><?php echo $user_upper["ifup_user_email"];?></td>
                                        <td><?php echo $user_upper["ifup_user_phone"];?></td>
                                        <td><?php echo $user_upper["ifup_user_biography"];?></td>
                                        <td><?php echo $user_upper["ifup_user_register_date"];?></td>
                                        <td><?php echo $user_upper["ifup_user_birthday"];?></td>
                                        <td><?php if($user_upper['ifup_user_online'] == 0 || $user_upper['ifup_user_online']== NULL){ echo "Utilisateur déconnecté";}else{ echo "Utilisateur connecté";}; ?></td>
                                        <td><?php if($user_upper['ifup_user_archived_at'] == NULL){ echo "Compte activé";}else{ echo "Compte archivé";}; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                            <form action="index.php?module=service&action=delete-service" method="POST">
                                <input type="hidden" name="ifup_service_id" value="<?php echo $service['ifup_service_id']; ?>">
                                <button type="submit" class="btn btn-danger delete"><span class="glyphicon glyphicon-trash"></span> Supprimer le service</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once('view/layout/footer.inc.php'); ?>