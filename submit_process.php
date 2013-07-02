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
// class2.php is the heart of e107, always include it first to give access to e107 constants and variables
require_once('../../class2.php');

// Protect the file from direct access (not really needed when class2.php is called)
if (!defined('e107_INIT')) { exit(); }

// Get language file (assume that the English language file is always present)
include_lan(e_PLUGIN.'EGDB/languages/'.e_LANGUAGE.'.php');

// use HEADERF for USER PAGES and e_ADMIN."auth.php" for admin pages
require_once(HEADERF);

// Take information from the item_submit.php form and place into DB
$sql->db_insert( 'egdb', array(
								'egdb_item_name'  => $_POST['egdb_item_name'],
								'egdb_item_type'  => $_POST['egdb_item_type'],
								'egdb_item_level' => $_POST['egdb_item_level'],
								'egdb_mob_name'   => $_POST['egdb_mob_name'],
								'egdb_mob_level'  => $_POST['egdb_mob_level'],
								'egdb_mob_sector' => $_POST['egdb_mob_sector'],
								'egdb_mob_area'   => $_POST['egdb_mob_area'],
								'egdb_contributor' => $_POST['egdb_contributor']
				));
header("location: egdb.php");
exit();

// Display the footer of the current website
require_once(FOOTERF);
?>