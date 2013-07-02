<?php
/*
+------------------------------------------------------------------------------+
|	This page allows admins of the db to search, edit, and remove any entries.
|
|	Should display 30ish of the most recently added items and the contributors
|
|	and the other usual information.
|
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
$pageid = 'admin_menu_02';

// Define variable $text
$text = "This page will allow an assigned class to edit the database entries, or remove old ones. This page would be similar to the search page, but can also see who contributed and when. The admin class CANNOT edit who contributed or when it was added. The admin class should be able to PM the contribuitor if needed with the PM being prefilledish out.";


// Render the value of $text in a table.
$title = EGDB_CAT_00;
$ns -> tablerender($title, $text);

require_once(e_ADMIN.'footer.php');
?>