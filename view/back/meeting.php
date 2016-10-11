<?php include_once("view/back/layout/header.back.inc.php");?>
<div id="meeting">
	<section id="map-meet" class="wrap-connect col-11">
		<iframe id="map" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d167998.10804421484!2d2.2074741!3d48.8587741!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1f06e2b70f%3A0x40b82c3688c9460!2sParis!5e0!3m2!1sfr!2sfr!4v1453768706107" width="100%"  frameborder="0" style="border:0" allowfullscreen></iframe>
	</section>

	<div id="display-sidebar-announce-close" class="vertical-txt-left">   AFFICHER    </div>

	<section id="announce">
		<section id="info-announce">

			<div id="display-sidebar-announce-open" class="vertical-txt-left">    CACHER    </div>

			<div class="ctr">
				<img src="assets/img/profil1.jpg" class="profil-pics" id="span-profil">
				<div><a href="#!" class="space" id="span-name" title="profil"></a></div>
			</div>

			<div class="wrap-announce">


				<p id="span-msg"></p>

				<table class="table table-striped table-responsive">
					<tbody>
					<tr>
						<td><i class="fa fa-hashtag"></i></td>
						<td><span id="span-filter" class="pull-right"></span></td>
					</tr>
					<tr>
						<td><i class="fa fa-map-pin"></i></td>
						<td><span id="span-address" class="pull-right"></span></td>
					</tr>
					<tr>
						<td><i class="fa fa-clock-o"></i></td>
						<td><span id="span-time" class="pull-right"></span></td>
					</tr>
					<tr>
						<td><i class="fa fa-phone"></i></td>
						<td><span id="span-phone" class="pull-right"></span></td>
					</tr>

					</tbody>
				</table>
				<p id="start-legend"></p>
				<p id="start-button-container"></p>
			</div>


		</section>


	</section>
</div>
<?php include_once("view/back/layout/footer.back.inc.php");?>