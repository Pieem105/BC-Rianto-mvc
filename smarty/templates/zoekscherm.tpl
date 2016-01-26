{* Zoekscherm *}
{include file="xhtml.tpl"}
{include file="header.tpl"}
<body>
{include file="menu.tpl"}
<form id="zoekform" action="{$aData.postlink}" method="POST">
	<input type="hidden" name="sorteer" id="sorteer" value="" />
	{if (isset($aData.zoekterm) && ($aData.zoekterm != '')) }
	zoek: <input type="text" name="zoek" value="{$aData.zoekterm}" />
	{else}
	zoek: <input type="text" name="zoek" value="" />
	{/if}
	<input type="submit" name="submit" value="Zoek" />
	<input type="submit" name="submit" value="Zoek geavanceerd" />
</form>
<div>
<ul>
{foreach from=$aData.categories.lijst item=aCategorie }
<li><a href="{$aData.postlink}{$aCategorie.Id}">{$aCategorie.Naam}</a></li>
{/foreach}
</ul>
</div>
{if (isset($aData.resultaat) && ($aData.resultaat == true)) }
	<table class="lijst">
	<thead><tr>
	{if (isset($aData.magbestellen) && ($aData.magbestellen))}
	<td>Winkelwagen</td>
	{/if}
	{foreach from=$aData.kolommen item=aKolom }
	<td>{$aKolom.naam}</td>
	{/foreach}
	{if (isset($aData.magaanpassen) && ($aData.magaanpassen))}
	<td>Aanpassen</td>
	{/if}
	</tr></thead>
	<tbody>
	{foreach from=$aData.lijst item=aGegevens }
	<tr>
		{if (isset($aData.magbestellen) && ($aData.magbestellen))}
		<td><a href="{$aData.bestelscherm}{$aGegevens.Id}">in winkelwagen</a></td>
		{/if}
		<td><a href="{$aData.detailscherm}{$aGegevens.Id}">{$aGegevens.Naam}</a></td>
		<td>{$aGegevens.KorteOmschrijving}</td>
		<td>{$aGegevens.Prijs}</td>
		{if (isset($aData.magaanpassen) && ($aData.magaanpassen))}
		<td><a href="{$aData.aanpasscherm}{$aGegevens.Id}">aanpassen</a></td>
		{/if}
	</tr>
	{/foreach}
	</tbody>
	</table>
{/if}
{include file="footer.tpl"}
</body>
</html>
