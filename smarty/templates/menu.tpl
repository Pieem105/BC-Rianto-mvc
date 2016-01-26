{* menu.tpl *}
{if isset($sGebruikerNaam) && (strlen($sGebruikerNaam) > 0)}
<div>Ingelogd als {$sGebruikerNaam}</div>
{/if}
{if (isset($aMenu)) }
	{**************************************************************************************
	Menu onderverdeeld in 2 vakken: Standaard links het hoofdmenu, rechts inlog-formulier.
	**************************************************************************************}

	<div class="container-fluid">
		<div class="row" id="menubar_id">
			<div class="col-sm-12">
				<nav ID="menu_id" class="navbar navbar-default">
				  <div class="container-fluid">
					{******************
					Links het hoofdmenu
					******************}
					<div class="navbar-header">
						<a class="navbar-brand">BC Rianto</a>
					</div>
					<div>
						{foreach $aMenu.hoofdmenu as $aHoofdMenuItem}
							<ul class="nav navbar-nav">
								{if $aHoofdMenuItem.link == "#"}
									<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{$aHoofdMenuItem.titel}<span class="caret"></span></a>
									<ul class="dropdown-menu">
										{foreach $aMenu.submenu as $subMenuKey => $aSubMenuItem}
											{if $aHoofdMenuItem@key == $aSubMenuItem@key}
												{foreach $aMenu.submenu[$subMenuKey] as $subKey => $aSubItem}
													<li><a href="{$aSubItem.link}">{$aSubItem.titel}</a></li>
												{/foreach}
											{/if}
										{/foreach}
									</ul>
								{else}
									<li><a href="{$aHoofdMenuItem.link}">{$aHoofdMenuItem.titel}</a></li>
								{/if}
							</ul>
						{/foreach}
					</div>
				  </div>
				</nav>
			</div>
		</div>
	</div>
{/if}