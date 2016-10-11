
<?php
	$title = "IFUP - Mon Profil";
	require_once("view/back/layout/header.back.inc.php");
?>

	<section id="settings" class="wrap-connect col-11">
		<div class="title ctr"><p>Configurer mes informations</p></div>



		<form id="form-settings" class="wrap-deco" method="post" enctype="multipart/form-data" action="index.php?module=back&action=profile">
			<div class="col-6 bloc-container-settings">
				<div class="">
					<p>Prénom :</p>
					<i class="fa fa-user arrow-select2"></i>
					<input name="ifup_user_firstname" class="forms-settings-input" type="text" required placeholder="Votre prénom" value="<?php echo $_SESSION['user']['ifup_user_firstname']; ?>">
				</div>
			</div>

			<div class="col-6 bloc-container-settings">
				<div>
					<p>Nom :</p>
					<i class="fa fa-user arrow-select2"></i>
					<input name="ifup_user_lastname" class="forms-settings-input" type="text" required placeholder="Votre nom" value="<?php echo $_SESSION['user']['ifup_user_lastname']; ?>">
				</div>
			</div>


			<div class="col-6 bloc-container-settings">
				<p>Numéro de télèphone :</p>
				<i class="fa fa-phone arrow-select2"></i>
				<input name="ifup_user_phone" class="forms-settings-input" type="text" required placeholder="Votre Numéro de téléphone" value="<?php echo $_SESSION['user']['ifup_user_phone']; ?>">
			</div>

			<div class="col-6 bloc-container-settings">
				<p>Email :</p>
				<span>
					<i class="fa fa-envelope arrow-select2"></i>
					<input name="ifup_user_email" class="forms-settings-input" type="email" required placeholder="mon-email@gmail.com" value="<?php echo $_SESSION['user']['ifup_user_email']; ?>">
				</span>
			</div>

			<div class="col-6 bloc-container-settings">
				<p>Date d'anniversaire :</p>
				<i class="fa fa-birthday-cake arrow-select2"></i>
				<input name="ifup_user_birthday" class="forms-settings-input" type="date" min="1900-01-01" id="Date" required placeholder="Votre date de naissance" value="<?php echo $_SESSION['user']['ifup_user_birthday']; ?>">
			</div>

			<div class="col-6 bloc-container-settings">
				<p>Taux horaire de vos prestations :</p>
				<i class="fa fa-euro arrow-select2"></i>
				<select  class="select-wrapper" name="ifup_user_time_rate">
					<?php for($k = 1; $k<=30; $k++){?>
						<option value="<?php echo $k;?>"
							<?php if($_SESSION['user']['ifup_user_time_rate'] == $k){ echo 'selected="selected"';} ?>><?php echo $k;?> € de l'heure</option>
					<?php }?>
				</select>
			</div>

			<div class="clear"></div>

			<div>
				<p class="ctr">Biographie (Courte description de qui vous êtes) :</p>
				<textarea name="ifup_user_biography" class="forms-settings-input"><?php echo $_SESSION['user']['ifup_user_biography']; ?></textarea>
			</div>


			<div class="space">
				<label>Uploader une photo de profil <i id="info-pics" class="fa fa-question-circle"></i></label>
				<p id="popup-pics">Poids : 1 mo | Taille : 150x150 px | Format : jpg & png</p>
				<br/>
				<input class="space" type="file" name="ifup_image_file">
			</div>

			<p class="ctr">
				<button type="submit" class="btn ctr space" name="submit_form_profile">Valider mes informations</button>
			</p>

		</form>

		<div class="ctr"><button id="badge-btn" class="btn">Voir mes badges</button></div>

		<div id="badge" class="ctr wrap-deco">
			<div class="space badge"><img src="assets/img/badge/badge-welcolm.png" alt="Welcolm">
				<p class="ctr">Bienvenue parmi nous !</p>
			</div>

			<div class="space badge"><img src="assets/img/badge/badge-pics.png" alt="Badge-Pics">
				<p class="ctr">Vous avez mis une photo</p>
			</div>

			<div class="space badge"><img src="assets/img/badge/badge-if.png" alt="Badge IF">
				<p class="ctr">5 services reçus</p>
			</div>

			<div class="space badge"><img  class="unbadge" src="assets/img/badge/badge-up.png" alt="Badge Up">
				<p class="ctr">5 services rendus</p>
			</div>

			<div class="space badge"><img src="assets/img/badge/badge-rapide.png" alt="Badge rapide">
				<p class="ctr">2 services le même jour</p>
			</div>

			<div class="space badge"><img src="assets/img/badge/badge-rapideif.png" alt="Badge rapide">
				<p class="ctr">2 services le même jour</p>
			</div>

			<div class="space badge"><img src="assets/img/badge/badge-biographie.png" alt="Badge Bio">
				<p class="ctr">Vous vous êtes présenté</p>
			</div>

			<div class="space badge"><img src="assets/img/badge/badge-arrondissement.png" alt="Badge Arrondissement">
				<p class="ctr">Présent dans chaque arrondissement</p>
			</div>


			<div class="space badge"><img src="assets/img/badge/badge-anniversaire.png" alt="Badge Up">
				<p class="ctr">Membre depuis 1 mois</p>
			</div>

			<div class="space badge"><img src="assets/img/badge/badge-cuisine.png" alt="Badge Anniversaire">
				<p class="ctr">As de la cuisine</p>
			</div>

			<div class="space badge"><img src="assets/img/badge/badge-jardinage.png" alt="Badge Anniversaire">
				<p class="ctr">As du jardinage</p>
			</div>

			<div class="space badge"><img class="unbadge" src="assets/img/badge/badge-menage.png" alt="Badge Anniversaire">
				<p class="ctr">As du ménage</p>
			</div>

			<div class="space badge"><img class="unbadge" src="assets/img/badge/badge-animaux.png" alt="Badge Rapide">
				<p class="ctr">As des animaux</p>
			</div>

			<div class="space badge"><img src="assets/img/badge/badge-bricolage.png" alt="Welcolm">
				<p class="ctr">As du bricolage</p>
			</div>

			<div class="space badge"><img class="unbadge" src="assets/img/badge/badge-administatif.png" alt="Badge-Pics">
				<p class="ctr">As de la paperasse</p>
			</div>

			<div class="space badge"><img src="assets/img/badge/badge-livraison.png" alt="Badge IF">
				<p class="ctr">As de la livraison</p>
			</div>

			<div class="space badge"><img class="unbadge" src="assets/img/badge/badge-reparation.png" alt="Badge Up">
				<p class="ctr">As de la réparation</p>
			</div>

			<div class="space badge"><img src="assets/img/badge/badge-demenagement.png" alt="Badge-Pics">
				<p class="ctr">As du démènagement</p>
			</div>

			<div class="space badge"><img src="assets/img/badge/badge-informatique.png" alt="Badge IF">
				<p class="ctr">As de l'informatique</p>
			</div>
		</div>


		<form id="form-forgot-password-user" class="wrap-deco ctr" action="index.php?module=back&action=profile" method="post">
			<div class="title ctr space">Changer mon mot de passe</div>

			<div class="col-6 bloc-container-settings">
				<p>Nouveau mot de passe :</p>
				<span>
					<i class="fa fa-lock arrow-select2"></i>
					<input name="ifup_user_password" class="forms-settings-input" type="password" placeholder="•••••••••••">
				</span>
			</div>

			<div class="col-6 bloc-container-settings">
				<p>Confirmer le mot de passe :</p>
				<span>
					<i class="fa fa-lock arrow-select2"></i>
					<input name="ifup_user_confirm_password" class="forms-settings-input" type="password" placeholder="•••••••••••">
				</span>
			</div>
			<button type="submit" class="btn" name="submit_update_password">Réinitialiser Mon Mot De Passe</button>
		</form>

		<div class="ctr space"><a href="index.php?module=user&action=archive-user" class="btn-decline delete-user">Supprimer mon compte</a></div>
	</section>
<?php require_once("view/back/layout/footer.back.inc.php");?>