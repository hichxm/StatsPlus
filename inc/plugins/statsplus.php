<?php

/**
 * @function Return plugin information
 * @return array
 */
function noteplus_info()
{
    return [
        "name"          => "StatsPlus",
        "description"   => "Display more stats for user.",
        "author"        => "volca780",
        "authorsite"    => "https://github.com/volca780",
        "version"       => "1.0",
        "compatibility" => "18*"
    ];
}

/**
 * @function Plugin installation
 * @return mixed
 */
function noteplus_install()
{
    global $db;

    $gid = $db->insert_query("settinggroups", [
        "name"          => "statsplus_sg",
        "title"         => "StatsPlus",
        "description"   => "Configuration of StatsPlus",
        "disporder"     => 1,
        "isdefault"     => 0
    ]);

    $settings = [
        "statsplus_enabled" => [
            "title"         => "Enabled",
            "description"   => "If the yes box is checked, the plugin will be activated.",
            "optionscode"   => "yesno",
            "value"         => 1,
            "disporder"     => 1
        ]
    ];

    foreach ($settings as $name => $setting) {
        $setting["name"]    = $name;
        $setting["gid"]     = $gid;

        $db->insert_query("settings", $setting);
    }

    $templates = [
        "statsplus_tpl" => [
            "template"  => $db->escape_string('
<table border="0" cellspacing="{$theme[\'borderwidth\']}" cellpadding="{$theme[\'tablespace\']}" class="tborder">
    <tr>
		<td class="thead">
				Statistique
		</td>
	</tr>
	<tr>
        <td class="trow2">
	        <span class="smalltext">
		        <div class="float_left">Discussion:</div>   <div class="float_right">{$stats[\'numthreads\']}</div> 
                <br />
		        <div class="float_left">Message:</div>   <div class="float_right">{$stats[\'numposts\']}</div> 
		        <br />
		        <div class="float_left">Membre:</div>   <div class="float_right">{$stats[\'numusers\']}</div> 
		        <br />
		        <div class="float_left">Record de connexion:</div>   <div class="float_right">{$mostonline[\'numusers\']}</div> 
		        <br />
		        <div class="float_left">Dernier membre:</div>   <div class="float_right">{$stats[\'lastusername\']}</div> 
			</span>
		</td>
	</tr>
</table>
            '),
            "sid"       => "-1",
            "version"   => ""
        ]
    ];

    foreach ($templates as $title => $template){
        $template["title"]      = $title;
        $template["dateline"]   = time();

        $db->insert_query("templates", $template);
    }

    rebuild_settings();
}

/**
 * @function Plugin is installed
 * @return bool
 */
function statsplus_is_installed()
{
    global $mybb;

    return isset($mybb->settings['statsplus_enabled']);
}

/**
 * @function Plugin uninstall
 * @return mixed
 */
function statsplus_uninstall()
{
    global $db;

    $db->delete_query("settinggroups", "name=\"statsplus_sg\"");
    $db->delete_query("settings", "name LIKE \"statsplus_%\"");
    $db->delete_query("templates", "title LIKE \"statsplus_%\"");

    rebuild_settings();
}