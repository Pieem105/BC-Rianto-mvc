{* Homepage *}
{include file="xhtml.tpl"}
{include file="header.tpl"}
<body>
<div class="error">
<h1>Fatale fout</h1>
<h2>{$aData.exception.message}</h2>
<h3>{$aData.exception.trace}</h3>
</div>
{include file="footer.tpl"}
</body>
</html>
