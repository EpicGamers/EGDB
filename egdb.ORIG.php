<?php
/*-----------------------------------------------------------------------------+
|	This is the main item database file. It should display about 30 items 
|	at a time to the user, like recently added ones, display a submit/search
|   option, and would be nice to implement a screen for users to see their 
|	submitted items so they can update and edit them as needed. Eventually 
|	we will have the images for the items.
|
|	The main function of this item database is to have loot locations, not 
|	so much the item details.
+-----------------------------------------------------------------------------*/

// class2.php is the heart of e107, always include it first to give access to e107 constants and variables
require_once('../../class2.php');

// Protect the file from direct access (not really needed when class2.php is called)
if (!defined('e107_INIT')) { exit(); }

// Get language file (assume that the English language file is always present)
include_lan(e_PLUGIN.'EGDB/languages/'.e_LANGUAGE.'.php');

// We want to save the "sorted" variable between page requests
session_start();
if (!isset($_SESSION['sorted'])) {
  $sorted = 3; // Item Type
  $_SESSION['sorted'] = $sorted;
} else {
  $sorted = $_SESSION['sorted'];
}
// and we want to change it when it comes back in a page request
if (isset($_GET['dosort'])) {
 $sorted = intval($_GET['dosort']);
 $_SESSION['sorted'] = $sorted; }
elseif (isset($_POST['dosort'])) {
 $sorted = intval($_POST['dosort']);
 $_SESSION['sorted'] = $sorted; }

##### REMEMBER: we need the modified "user.js" for this to work!

require_once(HEADERF);

// Build the page to be displayed
$text = "\r\n<form name='main' method='GET' action='egdb.php'>".
 "Sorted By <select name='dosort'><option value='1'"; # onchange='DoResort();'
if ($sorted==1) $text .= " selected='selected'";
$text .=">Item Name</option><option value='2'";
if ($sorted==2) $text .= " selected='selected'";
$text .=">Item Type</option><option value='3'";
if ($sorted==3) $text .= " selected='selected'";
$text .=">Item Level</option><option value='4'";
if ($sorted==4) $text .= " selected='selected'";
$text .=">Mob Name</option><option value='5'";
if ($sorted==5) $text .= " selected='selected'";
$text .=">Mob Level</option><option value='6'";
if ($sorted==6) $text .= " selected='selected'";
$text .=">Mob Sector</option></select> &nbsp; <input type='submit' name='nowdo' value='Resort' />\r\n".
 " | <a href='".e_PLUGIN."egdb/item_submit.php'>Submit Item</a> | ".
 "<a href='".e_PLUGIN."egdb/item_search.php'>Search Item</a> | ".
 "<table class='fborder'><tr>".
 "<td class='fcaption' style='width:20%; text-align:center;'>Item Name</td>".
 "<td class='fcaption' style='width:10%; text-align:center;'>Type</td>".
 "<td class='fcaption' style='width:5%; text-align:center;'>Level</td>".
 "<td class='fcaption' style='width:20%; text-align:center;'>Mob Name</td>".
 "<td class='fcaption' style='width:5%; text-align:center;'>Mob Level</td>".
 "<td class='fcaption' style='width:20%; text-align:center;'>Sector</td>".
 "<td class='fcaption' style='width:20%; text-align:center;'>Area / Coords.</td>".
 "</tr>\r\n";
$num_categories = $sql -> db_Count("egdb", "(*)", "WHERE egdb_id");			
if ($num_categories) {
 switch ($sorted) {
  case 1: $sql -> db_Select("egdb","*","ORDER BY egdb_item_name",FALSE);
   break;
  case 2: $sql -> db_Select("egdb","*","ORDER BY egdb_item_type",FALSE);
   break;
  case 3: $sql -> db_Select("egdb","*","ORDER BY egdb_item_level",FALSE);
   break;
  case 4: $sql -> db_Select("egdb","*","ORDER BY egdb_mob_name",FALSE);
   break;
  case 5: $sql -> db_Select("egdb","*","ORDER BY egdb_mob_level",FALSE);
   break;
  case 6: $sql -> db_Select("egdb","*","ORDER BY egdb_mob_sector",FALSE);
   break;
 } // end Switch
 while($row = $sql-> db_Fetch()) {
  // Loop through the active categories and show each category
  $text .= "<tr><td class='forumheader3' style='width:20%; text-align:left;'>".$row['egdb_item_name'].
   "</td><td class='forumheader3' style='width:12%; text-align:left;'>".$row['egdb_item_type'].
   "</td><td class='forumheader3' style='width:5%; text-align:center;'>".$row['egdb_item_level'].
   "</td><td class='forumheader3' style='width:20%; text-align:left;'>".$row['egdb_mob_name'].
   "</td><td class='forumheader3' style='width:5%; text-align:center;'>".$row['egdb_mob_level'].
   "</td><td class='forumheader3' style='width:19%; text-align:left;'>".$row['egdb_mob_sector'].
   "</td><td class='forumheader3' style='width:19%; text-align:left;'>".$row['egdb_mob_area'].
   "</td></tr>";
 }
}
$text .= "</table></form>\r\n"; // stop the table, force a line-break in source

// Render the value of $text in a table.
$title = EGDB_CORE_01;
$ns -> tablerender($title, $text);

// === End of BODY ===
// use FOOTERF for USER PAGES and e_ADMIN.'footer.php' for admin pages
require_once(FOOTERF);
?> 