# ![StatsPlus](https://img15.hostingpics.net/pics/371238barchart1.png "Logo Title Text 1") StatsPlus

StatsPlus est un plugin MyBB qui vous permettra d'afficher les statistiques sur votre forum.

![Image](https://img15.hostingpics.net/pics/673298Screenshot20171231DEVSFORUM.png "Example")

## Variable

Pour modifier le template à votre guise.

- Rendez-vous sur les templates de votre theme.
- Modifier le template ```Global Template\statsplus_tpl``` pour y modifier le contenu.

| Variable         | Resultat                            |
|:---------------- |:----------------------------------- |
| {last user}      | Dernier utilisateur inscrit         |
| {last user uuid} | Uuid du dernier utilisateur inscrit |
| ---------------- | ----------------------------------- |
| {total post}     | Nombre totale de message            |
| {total thread}   | Nombre totale de discussion         |
| {total membre}   | Nombre totale de membre             |

```html
<table border="0" cellspacing="{$theme['borderwidth']}" cellpadding="{$theme['tablespace']}" class="tborder">
    <tr>
		<td class="thead">
			Statistique
		</td>
	</tr>
	<tr>
        <td class="trow2">
	        <span class="smalltext">
		        <div class="float_left">Discussion:</div>   <div class="float_right">{total thread}</div> 
                <br />
		        <div class="float_left">Message:</div>   <div class="float_right">{total post}</div> 
		        <br />
		        <div class="float_left">Membre:</div>   <div class="float_right">{total membre}</div> 
		        <br />
		        <div class="float_left">Dernier membre:</div>   <div class="float_right">{last user}</div> 
		    </span>
		</td>
	</tr>
</table>
```

## Installation

Pour installer le plugin rien de plus simple.

- Deplacer le fichier ```statsplus.php``` vers le dossier ```\inc\plugins\```
- Rendez-vous sur la page administration de votre forum.
- Installer le plugin disponible sur le lien suivant ```/admin/index.php?module=config-plugins```
- Rendez-vous sur les templates de votre theme.
- Modifier le template ```Index Page Templates\index``` pour y ajouter le tag ```{$statsplus}```

```html
<html>
<head>
<title>{$mybb->settings['bbname']}</title>
{$headerinclude}
<script type="text/javascript">
<!--
	lang.no_new_posts = "{$lang->no_new_posts}";
	lang.click_mark_read = "{$lang->click_mark_read}";
// -->
</script>
</head>
<body>
{$header}
    <div class="side" style="float: right; width: 19%">
        {$statsplus}
    </div>
    <div class="forum" style="float: left; width: 80%;">
        {$forums}
    </div>
{$boardstats}

<dl class="forum_legend smalltext">
	<dt><span class="forum_status forum_on" title="{$lang->new_posts}"></span></dt>
	<dd>{$lang->new_posts}</dd>

	<dt><span class="forum_status forum_off" title="{$lang->no_new_posts}"></span></dt>
	<dd>{$lang->no_new_posts}</dd>

	<dt><span class="forum_status forum_offlock" title="{$lang->forum_locked}"></span></dt>
	<dd>{$lang->forum_locked}</dd>

	<dt><span class="forum_status forum_offlink" title="{$lang->forum_redirect}"></span></dt>
	<dd>{$lang->forum_redirect}</dd>
</dl>
<br class="clear" />
{$footer}
</body>
</html>
```

## Configuration

Pour configurer le plugin rendez-vous sur la page d'administration est modifier les parametres du plugin.

La configuration du plugin est simple.

```php
$settings = [
    "statsplus_enabled" => [
        "title"         => "Enabled",
        "description"   => "If the yes box is checked, the plugin will be activated.",
        "optionscode"   => "yesno",
        "value"         => 1,
        "disporder"     => 1
    ]
];
```