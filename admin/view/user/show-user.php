<?php
    $title = "Voir un utilisateur";
    require_once('view/layout/header.inc.php');
?>

    <div class="page-title">
        <span class="title">Utilisateur - <?php echo $user["ifup_user_firstname"] . " " . $user["ifup_user_lastname"];?></span>
        <div class="pull-right card-action">
            <div class="btn-group" role="group" aria-label="...">
                <a href="index.php?module=user&action=index" class="btn btn-info right"><i class="fa fa-plus"></i> Liste des utilisateurs</a>
            </div>
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
                    <div class="sub-title">Profil </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Caractéristique</th>
                                        <th>Valeur</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Prénom</th>
                                            <td><?php echo $user['ifup_user_firstname']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Nom</th>
                                            <td><?php echo $user['ifup_user_lastname']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td><?php echo $user['ifup_user_email']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Date d'inscription</th>
                                            <td><?php echo "Le " . date("d/m/Y \à H:i:s" , strtotime($user['ifup_user_register_date'])); ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Numéro de téléphone</th>
                                            <td><?php echo $user['ifup_user_phone']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Description</th>
                                            <td><?php echo $user['ifup_user_biography']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Date de naissance</th>
                                            <td> <?php echo "Le " . date("d/m/Y" , strtotime($user['ifup_user_birthday'])); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <?php if($user["ifup_user_image_id"] != NULL){ ?>
                                <img class="img-responsive" style="max-height: 400px; max-width: 400px;" src="../<?php echo $user['ifup_image_file']; ?>">
                            <?php } else { ?>
                                <p>Cet utilisateur n'a pas d'image de profil.</p>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="sub-title">Etat </div>
                    <div class="row">
                        <div class="col-sm-4 col-md-3 col-lg-2">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Compte</div>
                                <div class="panel-body">
                                    <?php if($user['ifup_user_confirmation_token'] == NULL){ echo "Compte confirmé";} else{ echo "Compte non-confirmé";}; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-3 col-lg-2">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Connexion</div>
                                <div class="panel-body">
                                    <?php if($user['ifup_user_online'] == 0 || $user['ifup_user_online']== NULL){ echo "Utilisateur déconnecté";}else{ echo "Utilisateur connecté";}; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-3 col-lg-2">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Statut</div>
                                <div class="panel-body">
                                    <?php if($user['ifup_user_status'] == 0 || $user['ifup_user_status']== NULL){ echo "Iffer";}else{ echo "Upper";}; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-3 col-lg-2">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Compte activé ou archivé</div>
                                <div class="panel-body">
                                    <?php if($user['ifup_user_archived_at'] == NULL){ echo "Compte activé";}else{ echo "Compte archivé";}; ?>
                                </div>
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
                        <div class="title">Paramètres Upper</div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="sub-title">Filtres choisis </div>
                            <?php if(!empty($user_filters)) {?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Nom</th>
                                            <th>Image du filtre</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($user_filters as $user_filter) {?>
                                            <tr>
                                                <td><?php echo $user_filter["ifup_filter_id"];?></td>
                                                <td><?php echo $user_filter["ifup_filter_name"];?></td>
                                                <td><img style="max-height: 50px; max-width: 50px;" src="../<?php echo $user_filter["ifup_image_file"];?>"></td>
                                            </tr>
                                        <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } else{ ?>
                                <p>Cet utilisateur n'a choisi aucun filtre.</p>
                            <?php } ?>
                        </div>
                        <div class="col-sm-6">
                            <div class="sub-title">Arrondissements choisis </div>
                            <?php if(!empty($user_districts)) {?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Nom</th>
                                            <th>Code postal</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($user_districts as $user_district) {?>
                                            <tr>
                                                <td><?php echo $user_district["ifup_district_id"];?></td>
                                                <td><?php echo $user_district["ifup_district_name"];?></td>
                                                <td><?php echo $user_district["ifup_district_zip_code"];?></td>
                                            </tr>
                                        <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } else{ ?>
                                <p>Cet utilisateur n'a choisi aucun arrondissement.</p>
                            <?php } ?>
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
                        <div class="title">Service</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="sub-title">En tant que demandeur (Iffer)</div>
                            <?php if(!empty($user_if_services)) {?>
                                <div class="table-responsive">
                                    <table class="datatable table table-striped" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>#ID du service</th>
                                            <th>Adresse du service</th>
                                            <th>Message</th>
                                            <th>Filtre</th>
                                            <th>Upper</th>
                                            <th>Date de prestation</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>#ID du service</th>
                                            <th>Adresse du service</th>
                                            <th>Message</th>
                                            <th>Filtre</th>
                                            <th>Upper</th>
                                            <th>Date de prestation</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php foreach ($user_if_services as $key => $user_if_service) { ?>
                                            <tr>
                                                <td><?php echo $user_if_service['ifup_service_id']; ?></td>
                                                <td><?php echo $user_if_service['ifup_service_address']; ?></td>
                                                <td><?php echo $user_if_service['ifup_service_message']; ?></td>
                                                <td><?php echo $user_if_service['ifup_filter_name']; ?></td>
                                                <td>
                                                    <?php
                                                    if($user_if_service['ifup_service_user_up_id'] == NULL){
                                                        echo "aucun prestataire";
                                                    }else{
                                                        echo $user_if_service['ifup_user_firstname'] . " ". $user_if_service['ifup_user_lastname'];
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php
                                                    if($user_if_service['ifup_service_start'] != NULL && $user_if_service['ifup_service_finish'] == NULL){
                                                        echo "En cours - commencé le " . date("d/m/Y \à H:i:s", strtotime($user_if_service['ifup_service_start']));
                                                    }
                                                    elseif($user_if_service['ifup_service_start'] != NULL && $user_if_service['ifup_service_finish'] != NULL){
                                                        echo date("d/m/Y - H:i:s", strtotime($user_if_service['ifup_service_start'])) . " au " . date("d/m/Y - H:i:s", strtotime($user_if_service['ifup_service_finish']));
                                                    }
                                                    elseif($user_if_service['ifup_service_start'] == NULL && $user_if_service['ifup_service_finish'] != NULL){
                                                        echo "Demande annulée le " . date("d/m/Y \à H:i:s", strtotime($user_if_service['ifup_service_finish']));
                                                    }else{
                                                        echo "Pas encore débuté";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php }  ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } else{ ?>
                                <p>Cet utilisateur n'a fait aucune demande de service.</p>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="sub-title">En tant que prestataire (Upper)</div>
                            <?php if(!empty($user_up_services)) {?>
                                <div class="table-responsive">
                                    <table class="datatable table table-striped" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>#ID du service</th>
                                            <th>Adresse du service</th>
                                            <th>Message</th>
                                            <th>Filtre</th>
                                            <th>Iffer</th>
                                            <th>Date de prestation</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>#ID du service</th>
                                            <th>Adresse du service</th>
                                            <th>Message</th>
                                            <th>Filtre</th>
                                            <th>Iffer</th>
                                            <th>Date de prestation</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php foreach ($user_up_services as $key => $user_up_service) { ?>
                                            <tr>
                                                <td><?php echo $user_up_service['ifup_service_id']; ?></td>
                                                <td><?php echo $user_up_service['ifup_service_address']; ?></td>
                                                <td><?php echo $user_up_service['ifup_service_message']; ?></td>
                                                <td><?php echo $user_up_service['ifup_filter_name']; ?></td>
                                                <td><?php echo $user_up_service['ifup_user_firstname'] . " ". $user_up_service['ifup_user_lastname']; ?></td>
                                                <td><?php
                                                    if($user_up_service['ifup_service_start'] != NULL && $user_up_service['ifup_service_finish'] == NULL){
                                                        echo "En cours - commencé le " . date("d/m/Y \à H:i:s", strtotime($user_up_service['ifup_service_start']));
                                                    }
                                                    elseif($user_up_service['ifup_service_start'] != NULL && $user_up_service['ifup_service_finish'] != NULL){
                                                        echo date("d/m/Y - H:i:s", strtotime($user_up_service['ifup_service_start'])) . " au " . date("d/m/Y - H:i:s", strtotime($user_up_service['ifup_service_finish']));
                                                    }
                                                    elseif($user_up_service['ifup_service_start'] == NULL && $user_up_service['ifup_service_finish'] != NULL){
                                                        echo "Demande annulée le " . date("d/m/Y \à H:i:s", strtotime($user_up_service['ifup_service_finish']));
                                                    }else{
                                                        echo "Pas encore débuté";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php }  ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } else{ ?>
                                <p>Cet utilisateur n'a fait aucune prestation de service.</p>
                            <?php } ?>
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
                            <form action="index.php?module=user&action=archive-user" method="POST">
                                <input type="hidden" name="ifup_user_id" value="<?php echo $user['ifup_user_id']; ?>">
                                <button type="submit" class="btn btn-danger delete"><span class="glyphicon glyphicon-trash"></span> Archiver l'utilisateur</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once('view/layout/footer.inc.php'); ?>