{* loginpage *}
{include file="xhtml.tpl"}
{include file="header.tpl"}
<body>
{include file="kop.tpl"}
{include file="menu.tpl"}
{**************************************************************************************
Inhoud onderverdeeld in 3 vakken: verhouding van verdeling 2 : 8 : 2 (samen 12)
Standaard links en rechts een side-bar en middenin de inhoud.
**************************************************************************************}
	<div id="standaard_inhoud_id" class="container-fluid">
		<div class="row">
			<div class="col-sm-2" id="linker_menu_id" style="height:450px;border-radius:3px">
				{* Division voor de achtergrond afbeelding met ballonnen *}
				<div style="height:100%;width:100%;background-image:url(./afbeeldingen/achtergrond_verjaardagen.jpg);
				background-repeat:no-repeat;
				background-size:90%;
				background-position:10px 25px;border-radius:3px">
				
				{* Division voor de de wit doorschijnende achtergrond *}
				<div style="height:100%;width:100%;background:RGBA(48,48,200,0.8);display:flex;border-radius:3px"> 
				{* Division voor de lijst met jarigen *}
				<div style="width:100%;padding:5px;color:white">
				
				{* Titel met de naam van de maand automatisch gegenereerd a.d.h.v. de huidige datum *}
				<h4 style="text-align:center;color:white" >Jarigen in de maand<br/>{$smarty.now|date_format:"%B"|capitalize}</h4>

				{**
				 * Er wordt een tabel aangemaakt voor het tonen van de jarigen van deze maand
				 *} 
				 
				<table align="center" style="margin-top:20px;color=white">
					{foreach $aJarigenVanDeMaand as $Key => $aJarige}
						<tr>
							<td height="20px" width="30px">{$aJarige.dag}</td>
							<td height="20px">{$aJarige.naam}</td>
						</tr>
					{/foreach}
				</table>

				</div> {* Einde van division (lijst met jarigen)*}
				{* Division met bewegende afbeelding rechts-onder*}
				<div style="position:absolute;left:0px;bottom:10px";width:100%>
				<img src="./afbeeldingen/micky-verjaardag.gif" style="margin-left:10%;width:80%">
				</div> {*Einde van division (bewegende afbeelding)*}
				
				</div> {* Einde van division (doorschijnende achtergrond) *}
				</div>  {* Einde van division (achtergrond met ballonnen) *}
			</div>
			<div class="col-sm-8" id="inhoud_id">
				<form action="{$aData.postlink}" method="POST">
					<table align="center">
						<tr align="center">
							<td style="padding:10px">Gebruikernaam:</td>
							<td style="padding:10px"><input type="text" name="gebruiker" value="" /><br /></td>
						</tr>
						<tr align="center">
							<td style="padding:10px">Wachtwoord: </td>
							<td style="padding:10px"><input type="password" name="wachtwoord" value="" /></td>
						</tr>
						<tr>
							<td style="padding:10px"></td>
							<td colspan="2" align="left" style="padding:10px"><input type="submit" name="submit" value="Inloggen" /></td>
						</tr>
					</table>
				</form>
			</div>
			<div class="col-sm-2" id="rechter_menu_id" style="height:450px;border-radius:3px">
				<div style=\"height:100%;width:100%;background:RGBA(48,48,200,0.8);display:flex;border-radius:3px\">
					<div style=\"position:absolute;margin-left:8%\">
						<form>
							<h4 style=\"color:white\">Het laatste nieuws!</h4>
							<script>toonRSS('bcrianto','rssOutput',3);</script>
							<select onchange=\"toonRSS(this.value,'rssOutput',3)\" style=\"color:#33A\">
								<option value=\"bcrianto\">BC Rianto - Nieuws</option>
								<option value=\"nbb\">NBB Nieuws</option>
								<option value=\"badminton\">Badminton Info</option>
								<option value=\"bwf\">Badminton Federatie</option>
							</select>  
						</form>
					</div>
					<br>
					<div style=\"position:relative;margin-left:8%;margin-top:70px\" id=\"rssOutput\">
						Hier komt uw nieuws...
					</div>
				</div>
			</div>
</body>
</html>
