<?php
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
// Protect the file from direct access (not really needed when class2.php is called)
if(!defined("e107_INIT")){ exit; }

// Ensure this program is loaded in admin theme before calling class2
// Strictly taken this is not really needed when the file name begins with admin_
$eplug_admin = true;

// class2.php is the heart of e107, always include it first to give access to e107 constants and variables
require_once('../../class2.php');

// Check to see if the current user has admin permissions for this plugin
if ( ! getperms('P')) { header('location:'.e_BASE.'index.php'); exit(); }

// Include auth.php rather than header.php ensures an admin user is logged in
require_once(e_ADMIN.'auth.php');

// Get language file (assume that the English language file is always present)
include_lan(e_PLUGIN.'EGDB/languages/'.e_LANGUAGE.'.php');

// Set the pageid for the menu as global variable (first pageid is set by admin_config.php)
global $pageid;

$action = basename($_SERVER['PHP_SELF'], '.php');

$var['admin_menu_01']['text'] = EGDB_MENU_01;
$var['admin_menu_01']['link'] = 'admin_config.php';

$var['admin_menu_02']['text'] = EGDB_MENU_02;
$var['admin_menu_02']['link'] = 'admin_categories.php';

$var['admin_menu_03']['text'] = EGDB_MENU_03;
$var['admin_menu_03']['link'] = 'admin_egdb.php';

$var['admin_menu_04']['text'] = EGDB_MENU_04;
$var['admin_menu_04']['link'] = 'admin_egdb_pdf.php';

// Put the readme.txt at the end of the list
$var['admin_menu_09']['text'] = EGDB_MENU_09;
$var['admin_menu_09']['link'] = 'admin_readme.php';

// Show the admin menu with a caption from the language file
$caption = EGDB_MENU_00;
show_admin_menu($caption, $pageid, $var);
?>