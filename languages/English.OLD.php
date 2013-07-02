<?php
/*
+------------------------------------------------------------------------------+
|     YourFirstPlugin - a plugin skeleton by nlstart
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+------------------------------------------------------------------------------+
*/
// NOTE: Maximum multi language define name is 24 characters!
// module plugin.php
define("EGDB_NAME", "Epic Gamers Database");
define("EGDB_DESC", "Item Database for Earth and Beyond");
define("EGDB_MENU", "Item Database");
define("EGDB_LINK_NAME", "Item Database"); // To demonstrate your link name can be different than plugin name
define("EGDB_CAPTION", "Configure EGDB");
define("EGDB_DONE1", "Installation ");
define("EGDB_DONE2", "successful...");
define("EGDB_DONE3","Thank you for upgrading to"); // Plugin version will be added automatically

// module admin_menu.php
define("EGDB_MENU_00", "EGDB Administration");
define("EGDB_MENU_01", "Item Maintenance");
define("EGDB_MENU_02", "EGDB Stats");
define("EGDB_MENU_03", "*");
define("EGDB_MENU_04", "*");
define("EGDB_MENU_05", "*");
define("EGDB_MENU_06", "*");
define("EGDB_MENU_07", "*");
define("EGDB_MENU_08", "*");
define("EGDB_MENU_09", "Readme");

// module admin_config.php
define("EGDB_CONF_00", "YourFirstPlugin Configuration");
define("EGDB_CONF_01", "Maintain YourFirstPlugin Settings");
define("EGDB_CONF_02", "YourFirstPlugin Title field");
define("EGDB_CONF_03", "YourFirstPlugin Image Directory");
define("EGDB_CONF_04", "Help text for Image directory: remind the trailing slash!");
define("EGDB_CONF_05", "Test Field One");
define("EGDB_CONF_06", "Test Field Two");
define("EGDB_CONF_07", "Test Field Three");
define("EGDB_CONF_08", "Test Field Four");
define("EGDB_CONF_09", "Test Field Integer");
define("EGDB_CONF_10", "Apply Changes");
define("EGDB_CONF_11", "Your settings have been saved.");

// module admin_categories.php
define("EGDB_CAT_00", "Maintain Categories");
define("EGDB_CAT_01", "Maintain YourFirstPlugin Categories");
define("EGDB_CAT_02", "No categories defined");
define("EGDB_CAT_03", "Enter new item");
define("EGDB_CAT_04", "EGDB Enter New Item");
define("EGDB_CAT_05", "Item Name:");
define("EGDB_CAT_06", "Item Catagory:");
define("EGDB_CAT_07", "#");
define("EGDB_CAT_08", "Item Level:");
define("EGDB_CAT_09", "MOB Name:");
define("EGDB_CAT_10", "MOB Level:");
define("EGDB_CAT_11", "MOB Sector:");
define("EGDB_CAT_12", "MOB Area or Coords.:");
define("EGDB_CAT_13", "#");
define("EGDB_CAT_14", "Sort Order");
define("EGDB_CAT_15", "Active");
define("EGDB_CAT_16", "Actions");
define("EGDB_CAT_17", "Change Category");
define("EGDB_CAT_18", "Edit");
define("EGDB_CAT_19", "Delete");

// module admin_categories_edit.php
define("EGDB_CATEDIT_01", "Delete Category");
define("EGDB_CATEDIT_02", "Are you sure you want to delete this category?");
define("EGDB_CATEDIT_03", "Yes");
define("EGDB_CATEDIT_04", "No");

// module egdb.php
define("EGDB_CORE_00", "EGDB Main Module");
define("EGDB_CORE_01", "Epic Gamers Item Database");
define("EGDB_CORE_02", "Item Database");
define("EGDB_CORE_03", "*");
define("EGDB_CORE_04", "*");
define("EGDB_CORE_05", "*");

// module help.php
define("EGDB_ADMIN_HELP_00", "EGDB Help");
define("EGDB_ADMIN_HELP_01", "Item Maintenance");
define("EGDB_ADMIN_HELP_02", "Used to edit and remove entries");
define("EGDB_ADMIN_HELP_03", "EGDB Stats");
define("EGDB_ADMIN_HELP_04", "Shows information about the Database");
define("EGDB_ADMIN_HELP_05", "");
define("EGDB_ADMIN_HELP_06", "");
define("EGDB_ADMIN_HELP_07", "ReadMe.txt");  // Also used in admin_readme.php
define("EGDB_ADMIN_HELP_08", "View the Readme text file for detailed release information and version history.<br/><br/>For additional help on this plugin view the <a href='http://wiki.e107.org/?title=YourFirstPlugin'>e107 Wiki pages</a>.");
define("EGDB_ADMIN_HELP_99", "readme.txt"); // Actual helpfile called by admin_readme.php to allow for multi-langual helpfiles
?>