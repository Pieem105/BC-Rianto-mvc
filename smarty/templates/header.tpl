{* header.tpl *}
<head>
	<title>{$sTitel}</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/rianto.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.bcrianto.min.css">
	<link rel="stylesheet" type="text/css" href="css/complete-boek.css" />
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<meta   name="description" content="Op deze website vindt u informatie over BC Rianto, de badmintonclub van Zutphen">
	<meta   name="Keywords" content="badminton; zutphen; badmintonvereniging rianto; badmintonclub; bc rianto">
	{if (isset($aScripts) && (count($aScripts) > 0))}
	{foreach from=$aScripts item=sScriptFile}
	<script type="text/javascript" language="javascript" src="{$sScriptFile}"></script>
	{/foreach}
	{/if}
</head>