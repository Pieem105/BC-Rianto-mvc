{* artikeldetail pagina *}
{include file="xhtml.tpl"}
{include file="header.tpl"}
<body>
{include file="menu.tpl"}
<div class="center">
{if (isset($aData.melding) && strlen($aData.melding) > 0) } 
<div class="error">{$aData.melding}</div>
{/if}
<div class="left-block">
{if !(isset($aData.opgeslagen) && ($aData.opgeslagen)) }
{if isset($aData.velden)}
	<form method="POST" action="{$aData.postlink}">
	{if $aData.velden.voorletters.resultaat}
		{assign var="sClass" value="normaal"}
	{else}
		{assign var="sClass" value="error"}
	{/if} {if $aData.velden.voorletters.verplicht} * {/if}
	<span class="{$sClass}">{$aData.velden.voorletters.tekst} </span><input type="text" name="voorletters" value="{$aData.velden.voorletters.waarde}"/><br />

	{if $aData.velden.voornaam.resultaat}
		{assign var="sClass" value="normaal"}
	{else}
		{assign var="sClass" value="error"}
	{/if} {if $aData.velden.voornaam.verplicht} * {/if}
	<span class="{$sClass}">{$aData.velden.voornaam.tekst} </span><input type="text" name="voornaam" value="{$aData.velden.voornaam.waarde}"/><br />

	{if $aData.velden.tussenvoegsel.resultaat}
		{assign var="sClass" value="normaal"}
	{else}
		{assign var="sClass" value="error"}
	{/if} {if $aData.velden.tussenvoegsel.verplicht} * {/if}
	<span class="{$sClass}">{$aData.velden.tussenvoegsel.tekst} </span><input type="text" name="tussenvoegsel" value="{$aData.velden.tussenvoegsel.waarde}"/><br />

	{if $aData.velden.achternaam.resultaat}
		{assign var="sClass" value="normaal"}
	{else}
		{assign var="sClass" value="error"}
	{/if} {if $aData.velden.achternaam.verplicht} * {/if}
	<span class="{$sClass}">{$aData.velden.achternaam.tekst} </span><input type="text" name="achternaam" value="{$aData.velden.achternaam.waarde}"/><br />

	<span class="normaal">{$aData.velden.geslacht.tekst}</span>{html_options name="geslacht" options=$aData.geslachten selected=$aData.velden.geslacht.waarde}<br />

	{if $aData.velden.email.resultaat}
		{assign var="sClass" value="normaal"}
	{else}
		{assign var="sClass" value="error"}
	{/if} {if $aData.velden.email.verplicht} * {/if}
	<span class="{$sClass}">{$aData.velden.email.tekst} </span><input type="text" name="email" value="{$aData.velden.email.waarde}"/><br />

	{if $aData.velden.telefoon.resultaat}
		{assign var="sClass" value="normaal"}
	{else}
		{assign var="sClass" value="error"}
	{/if} {if $aData.velden.telefoon.verplicht} * {/if}
	<span class="{$sClass}">{$aData.velden.telefoon.tekst} </span><input type="text" name="telefoon" value="{$aData.velden.telefoon.waarde}"/><br />

	{if $aData.velden.rekening.resultaat}
		{assign var="sClass" value="normaal"}
	{else}
		{assign var="sClass" value="error"}
	{/if} {if $aData.velden.rekening.verplicht} * {/if}
	<span class="{$sClass}">{$aData.velden.rekening.tekst} </span><input type="text" name="rekening" value="{$aData.velden.rekening.waarde}"/><br />
	<br />
	{if $aData.velden.straat.resultaat}
		{assign var="sClass" value="normaal"}
	{else}
		{assign var="sClass" value="error"}
	{/if} {if $aData.velden.straat.verplicht} * {/if}
	<span class="{$sClass}">{$aData.velden.straat.tekst} </span><input type="text" name="straat" value="{$aData.velden.straat.waarde}"/><br />

	{if $aData.velden.huisnr.resultaat}
		{assign var="sClass" value="normaal"}
	{else}
		{assign var="sClass" value="error"}
	{/if} {if $aData.velden.huisnr.verplicht} * {/if}
	<span class="{$sClass}">{$aData.velden.huisnr.tekst} </span><input type="text" name="huisnr" value="{$aData.velden.huisnr.waarde}"/><br />

	{if $aData.velden.huisnrextra.resultaat}
		{assign var="sClass" value="normaal"}
	{else}
		{assign var="sClass" value="error"}
	{/if} {if $aData.velden.huisnrextra.verplicht} * {/if}
	<span class="{$sClass}">{$aData.velden.huisnrextra.tekst} </span><input type="text" name="huisnrextra" value="{$aData.velden.huisnrextra.waarde}"/><br />

	{if $aData.velden.postcode.resultaat}
		{assign var="sClass" value="normaal"}
	{else}
		{assign var="sClass" value="error"}
	{/if} {if $aData.velden.postcode.verplicht} * {/if}
	<span class="{$sClass}">{$aData.velden.postcode.tekst} </span><input type="text" name="postcode" value="{$aData.velden.postcode.waarde}"/><br />

	{if $aData.velden.woonplaats.resultaat}
		{assign var="sClass" value="normaal"}
	{else}
		{assign var="sClass" value="error"}
	{/if} {if $aData.velden.woonplaats.verplicht} * {/if}
	<span class="{$sClass}">{$aData.velden.woonplaats.tekst} </span><input type="text" name="woonplaats" value="{$aData.velden.woonplaats.waarde}"/><br />
	<br />
	<input type="submit" name="submit" value="Registreren" />
	</form>
{/if}
{/if}
</div></div>

{include file="footer.tpl"}
</body>
</html>
