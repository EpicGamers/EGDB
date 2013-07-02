<?php
/*
+------------------------------------------------------------------------------+
|	This page allows users to search for items. Users can search by item name,
|
|	item level, MOB name, and sector. It should allow users is choose how many
|
|	results to display per page, and how to sort the data.
|
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

$text =" This part is in the works check back SOON!!<br><a href='".e_PLUGIN."egdb/egdb.php'>Back</a>";

$title = EGDB_CORE_01;
$ns -> tablerender($title, $text);

require_once(FOOTERF);

?>