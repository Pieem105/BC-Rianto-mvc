{* loguitpagina *}
{include file="xhtml.tpl"}
{include file="header.tpl"}
<body>
{include file="beheerkop.tpl"}
{include file="menu.tpl"}
{**************************************************************************************
Inhoud onderverdeeld in 1 vak, volle breedte van 12
**************************************************************************************}
	<div id="standaard_inhoud_id" class="container-fluid">
		<div class="row">
			<div class="col-sm-12" id="inhoud_id">
				<form action="{$aData.postlink}" method="POST">
					<table align="center">
						<tr align="center">
							<td style="padding:10px">Naam:</td>
							<td style="padding:10px">*** Hier komt de naam!!! ***<br></td>
						</tr>
						<tr>
							<td style="padding:10px"></td>
							<td colspan="2" align="left" style="padding:10px"><input type="submit" name="submit" value="Uitloggen" /></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
