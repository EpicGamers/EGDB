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
// Set the active menu option for admin_menu.php
$pageid = 'admin_menu_03';

$text='This section will contain information such as how many items are in the database, the most recently added items added with dates, the oldest few items to recheck, and who the top contribuior is.';
$title='Item Database Stats';
$ns->tablerender($title,$text);
require_once(e_ADMIN.'footer.php');
?>