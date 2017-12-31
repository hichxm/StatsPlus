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


}