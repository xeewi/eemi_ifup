<?php
    $title = "Liste des services";
    require_once('view/layout/header.inc.php');
?>
    <div class="page-title">
        <span class="title">Services</span>
        <div class="description">Liste des services réalisés sur IFUP</div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Services</div>
                    </div>
                </div>

                <div class="card-body">
                    <?php if(!empty($services)) {?>
                        <div class="table-responsive">
                            <table class="datatable table table-striped" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>#ID du service</th>
                                    <th>Adresse du service</th>
                                    <th>Message</th>
                                    <th>Filtre</th>
                                    <th>Iffer</th>
                                    <th>Upper</th>
                                    <th>Date de prestation</th>
                                    <th>Voir</th>
                                    <th>Archiver</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#ID du service</th>
                                    <th>Adresse du service</th>
                                    <th>Message</th>
                                    <th>Filtre</th>
                                    <th>Iffer</th>
                                    <th>Upper</th>
                                    <th>Date de prestation</th>
                                    <th>Voir</th>
                                    <th>Archiver</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php foreach ($services as $key => $service) { ?>
                                    <tr>
                                        <td><?php echo $service['ifup_service_id']; ?></td>
                                        <td><?php echo $service['ifup_service_address']; ?></td>
                                        <td><?php echo $service['ifup_service_message']; ?></td>
                                        <td><?php echo $service['ifup_filter_name']; ?></td>
                                        <td>
                                            <?php echo $service[11] . " ". $service[12];?>
                                        </td>
                                        <td>
                                            <?php
                                            if($service['ifup_service_user_up_id'] == NULL){
                                                echo "aucun prestataire";
                                            }else{
                                                echo $service[13] . " ". $service[14];
                                            }
                                            ?>
                                        </td>
                                        <td><?php
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
                                        </td>
                                        <td>
                                            <a class="btn btn-success" href="index.php?module=service&action=show-service&service=<?php echo $service['ifup_service_id']; ?>"><span class="glyphicon glyphicon-pencil"></span> Voir</a>
                                        </td>
                                        <td>
                                            <form action="index.php?module=service&action=delete-service" method="POST">
                                                <input type="hidden" name="ifup_service_id" value="<?php echo $service['ifup_service_id']; ?>">
                                                <button type="submit" class="btn btn-danger delete"><span class="glyphicon glyphicon-trash"></span> Archiver</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php }  ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else{ ?>
                    <h3 class="center">Vous n'avez pas de service.</h3>
                        <div class="center">
                            <a href="index.php?module=home&action=index" class="btn btn-info"><i class="fa fa-home"></i> Retour à l'accueil</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

<?php require_once('view/layout/footer.inc.php'); ?>