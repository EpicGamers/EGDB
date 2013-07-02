<?php
/*
+------------------------------------------------------------------------------+
|-- General set-up of e107 plugin to tell e107 Plugin Manager where files reside, which logo to use, etc.
+------------------------------------------------------------------------------+
*/
// If e107 is not running we won't run this plugin program
if( ! defined('e107_INIT')){ exit(); }

// Use this folder during install
$eplug_folder = "EGDB";

// Get language file (assume that the English language file is always present)
include_lan(e_PLUGIN.'EGDB/languages/'.e_LANGUAGE.'.php');

// To keep plugin name multilangual: store the constant name in the plugin table
// Plugin name is multi-language (from included language file)
// Otherwise for a fixed language term use the language constant name without the quotes
$eplug_name = 'EGDB_NAME';
$eplug_version = "0.1";
$eplug_author = "Damuras";
$eplug_url = "http://www.epicgamers.com";
$eplug_email = "webmaster@epicgamers.com";
$eplug_description = EGDB_DESC;
$eplug_compatible = "e107v0.7+";
$eplug_compliant = TRUE; // indicator if plugin is XHTML compliant, shows icon
$eplug_readme = "readme.txt";

$eplug_menu_name = 'EGDB_MENU';
$eplug_conffile = "admin_Stats.php";
$eplug_icon = $eplug_folder."/images/logo_32.png";
$eplug_icon_small = $eplug_folder."/images/logo_16.png";
$eplug_caption = EGDB_CAPTION;

// List of preferences ---------------------------------------------------------
// this stores a default value(s) in the preferences. 0 = Off , 1= On
// Preferences are saved with plugin folder name as prefix to make preferences unique and recognisable
$eplug_prefs = array(
	$eplug_folder."_name" => "Epic Gamers Item Database",
    $eplug_folder."_image_path" => "images/",
    $eplug_folder."_test_01" => "Test field 01",
    $eplug_folder."_test_02" => "Test field 02",
    $eplug_folder."_test_03" => "Test field 03",
    $eplug_folder."_test_04" => "Test field 04",
    $eplug_folder."_test_integer" => 1000
);

// List of table names ---------------------------------------------------------
$eplug_table_names = array(
    "egdb"
);

// List of sql requests to create tables ---------------------------------------
// MPREFIX must be used because database prefix can be customized instead of default e107_
$eplug_tables = array(
"CREATE TABLE ".MPREFIX."egdb"." (
	`egdb_id` int(10) unsigned NOT NULL auto_increment,
	`egdb_item_name` varchar(255) NOT NULL default '',
	`egdb_item_type` varchar(255) NOT NULL default '',
	`egdb_item_level` int(10) NOT NULL default '0',
	`egdb_mob_name` varchar(30) NOT NULL default '',
	`egdb_mob_level` int(10) NOT NULL default '0',
	`egdb_mob_sector` varchar(30) NOT NULL default '',
	`egdb_mob_x` int(10) NOT NULL default '0',
	`egdb_mob_y` int(10) NOT NULL default '0',
	PRIMARY KEY  (`egdb_id`)
) TYPE=MyISAM;",

// As an option: fill the database on first installation with default values,
// otherwise slash out INSERT INTO line just to create an empty database file structure.
// In case you comment out line 79, also place two slashes // before the comma at the end of line 75.
"INSERT INTO ".MPREFIX."egdb"." VALUES ('1', 'sample beam', 'beam', '9', 'Belter', '25', 'Glenn', '50', '-14')"
);

// Create a link in main menu (yes=TRUE, no=FALSE) ---------------------------
$eplug_link = TRUE;

// To keep link multilangual: store the constant name in the links table
$eplug_link_name = 'EGDB_LINK_NAME';
// $plugins_directory can be named differently than the default e107_plugins in the e107_config
$eplug_link_url = e_PLUGIN."EGDB/egdb.php";
$eplug_done = EGDB_DONE1." ".EGDB_NAME." v".$eplug_version." ".EGDB_DONE2;

// upgrading ... //
$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";

// Demonstration on how to remove redundant files only at upgrade
// This separate function is useful as the plugin.php file is read on many occassions, 
// so this prevents upgrade only functionality from running when it shouldn't. 
if ( ! function_exists('yourfirstplugin_upgrade')) 
{  // The above line prevents the plugin from being declared twice
	function yourfirstplugin_upgrade() 
	{ // This function is executed by the e107 Plugin Manager before any upgrading action
		$path = e_PLUGIN.'EGDB/';
		if (file_exists($path.'includes/config.php'))
		{   // Remove the file if it still exists              
			// unlink() is not allowed on all hosts - avoid error reporting
			@unlink($path.'includes/config.php');
		}
		if (file_exists($path.'help.php'))
		{ 	// help.php has been replaced by e_help.php
			unlink($path.'help.php');
		}
	} 
}

$eplug_upgrade_done = EGDB_DONE3." ".EGDB_NAME." v".$eplug_version.".";
?>