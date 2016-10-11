<?php
	$title = "IFUP - Demande de service";
	require_once("view/back/layout/header.back.inc.php");
?>
	<div id="content-container">
		<section id="mode-ifup" class="wrap-connect col-11">
			<div id="map-if" ><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d167998.10803373056!2d2.2074740643680624!3d48.85877410312378!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1f06e2b70f%3A0x40b82c3688c9460!2sParis!5e0!3m2!1sfr!2sfr!4v1453738195052" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe></div>
			<div id="forms-mode-ifup" class="ctr space">
				<h2 class="title">J'ai besoin d'un service</h2>
				<p>Les résultats autour de vous, vous serons proposé via la carte ci-dessus.</p>
				<form id="search" class="ctr" method="post" action="#">
					<div class="line-form" >
						<i class="fa fa-hashtag arrow-select2"></i>
						<select class="select select-wrapper" name="ifup_service_filter_id" required id="ifup_service_filter_id">
							<option value="" selected="selected">▾ Filtres</option>
							<?php foreach ($filters as $key => $value) { ?>
									
								<option value="<?php echo $value['ifup_filter_id']; ?>"><?php echo $value['ifup_filter_name']; ?></option>

							<?php } ?>
				
						</select>
					</div>
					<div class="line-form">
						<i class="fa fa-street-view arrow-select2"></i>
						<input class="forms-settings-input" type="text" id="ifup_service_address" name="ifup_service_address" placeholder="Votre position...">
					</div>
					<div class="clear"></div>
					<div>
					<p class="ctr">Description de la demande</p>
					<textarea id="ifup_service_message" name="ifup_service_message" class="forms-settings-input wrap" placeholder="Précisions sur votre demande..."></textarea>
				</div>
					<div class="space">
					<button class="btn" type="submit">Rechercher</button>
					</div>
				</form>
			</div>
		</section>
	</div>

<?php require_once("view/back/layout/footer.back.inc.php");?>