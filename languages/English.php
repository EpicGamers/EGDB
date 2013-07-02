<?php # language/English.php
/*-----------------------------------------------------------------------------+
|     YourFirstPlugin - a plugin skeleton by nlstart
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+-----------------------------------------------------------------------------*/

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
define("EGDB_MENU_00", "EGDB Options");
define("EGDB_MENU_01", "EGDB Settings");
define("EGDB_MENU_02", "Maintain Categories");
define("EGDB_MENU_03", "Add/Edit/Delete Items");
define("EGDB_MENU_04", "Export List to PDF file");
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

// module admin_categories.php ( removed colons! )
define("EGDB_CAT_00", "Maintain Categories");
define("EGDB_CAT_01", "Maintain YourFirstPlugin Categories");
define("EGDB_CAT_02", "No categories defined");
define("EGDB_CAT_03", "Enter new item");
define("EGDB_CAT_04", "EGDB Enter New Item");
define("EGDB_CAT_05", "Item Name");
define("EGDB_CAT_06", "Item Catagory");
define("EGDB_CAT_07", "#");
define("EGDB_CAT_08", "Item Level");
define("EGDB_CAT_09", "MOB Name");
define("EGDB_CAT_10", "MOB Level");
define("EGDB_CAT_11", "MOB Sector");
define("EGDB_CAT_12", "MOB Area or Coords.");
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
define("EGDB_CORE_02", "Add an Item"); ##### NEW!
define("EGDB_CORE_03", "Perform Add"); ##### NEW!
define("EGDB_CORE_04", "Maintain the categories");
define("EGDB_CORE_05", "No active categories present");
define("EGDB_CORE_06", "Search Database"); ##### NEW!
define("EGDB_CORE_07", "Perform Search"); ##### NEW!
define("EGDB_CORE_08", "Back"); ##### NEW!
define("EGDB_CORE_09", "Click on column title below to sort by that column!"); ##### NEW!
define("EGDB_CORE_10", "Please fill out the form below. If you need to edit the data, ".
                       "PM Damuras with the correction. PLEASE DO NOT abuse this system!"); ##### NEW!
define("EGDB_CORE_11", "item name too short"); ##### NEW!
define("EGDB_CORE_12", "not valid item type"); ##### NEW!
define("EGDB_CORE_13", "not valid item level"); ##### NEW!
define("EGDB_CORE_14", "mob name too short"); ##### NEW!
define("EGDB_CORE_15", "not valid mob level"); ##### NEW!
define("EGDB_CORE_16", "not valid sector name"); ##### NEW!
define("EGDB_CORE_17", "Please correct and re-submit."); ##### NEW!

// module help.php
define("EGDB_ADMIN_HELP_00", "EGDB Help");
define("EGDB_ADMIN_HELP_01", "Menu 1");
define("EGDB_ADMIN_HELP_02", "edit me in english.php admin_help");
define("EGDB_ADMIN_HELP_03", "Menu 2");
define("EGDB_ADMIN_HELP_04", "edit me");
define("EGDB_ADMIN_HELP_05", "Item Maintenance");
define("EGDB_ADMIN_HELP_06", "Maintain the items in the database");
define("EGDB_ADMIN_HELP_07", "Export List to PDF file");
define("EGDB_ADMIN_HELP_08", "Copy the item list contents to a printable PDF file");
define("EGDB_ADMIN_HELP_09", "ReadMe.txt");  // Also used in admin_readme.php
define("EGDB_ADMIN_HELP_10", "View the read me for additional information about the item database");
define("EGDB_ADMIN_HELP_99", "readme.txt"); // Actual helpfile called by admin_readme.php to allow for multi-langual helpfiles
?>