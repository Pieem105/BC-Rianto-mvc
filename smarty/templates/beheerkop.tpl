{* beheerkop.tpl *}
	{**************************************************************************************
	Kop onderverdeeld in 3 vakken: verhouding van verdeling 3 : 7 : 2 (samen 12)
	Standaard links het logo, middenin een carousel van foto's en rechts contactgegevens.
	**************************************************************************************}
	<div class="container-fluid">
		<div class="row" id="kop_id">
				{*********************
				Kop met links het logo
				*********************}
				<div class="col-sm-1" id="kop_links_id">
					<a href="index.php?page=1"><img src='./afbeeldingen/logo_rianto.gif' style="height:90px;padding:5px;" /></a>
				</div>
				{********************************
				Kop met in het midden de carousel
				********************************}
				<div class="col-sm-9" id="kop_middenbalk_id">
                    <h2>Beheerpagina</h2>
				</div>
				{******************************
				Kop met rechts contact-gegevens
				******************************}
				<div class="col-sm-2" id="kop_rechts_id">
					<div style="text-align:center">
						<br>{$aContact.naam}<br>
						<span class="glyphicon glyphicon-earphone" > {$aContact.telefoon}</span><br>
						<a href="mailto:{$aContact.email}"><span class="glyphicon glyphicon-envelope" style="color:grey"> {$aContact.email}</span></a>
					</div>
				</div>
		</div>
	</div>
