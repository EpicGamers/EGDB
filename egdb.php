<?php # egdb.php
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

// Remember: In PHP, we process the previous form input, THEN we output new page.

// We want to save the "sorted" variable between page requests
session_start();
if (!isset($_SESSION['sorted'])) {
  $sorted = 3; // Item Type
  $_SESSION['sorted'] = $sorted; // save if does not exist
} else {
  $sorted = $_SESSION['sorted']; // retrieve if exists
}

// and we want to change it when it comes back in a page request
if (isset($_POST['donow'])) {
 switch ($_POST['donow']) {
  case 'Item Name': { $sorted = 1; $_SESSION['sorted'] = $sorted; break; }
  case 'Type': { $sorted = 2; $_SESSION['sorted'] = $sorted; break; }
  case 'Level': { $sorted = 3; $_SESSION['sorted'] = $sorted; break; }
  case 'Mob Name': { $sorted = 4; $_SESSION['sorted'] = $sorted; break; }
  case 'Mob Level': { $sorted = 5; $_SESSION['sorted'] = $sorted; break; }
  case 'Mob Sector': { $sorted = 6; $_SESSION['sorted'] = $sorted; break; }
  case 'Submit Item': { break; } ##### FUTURE
  case 'Search Item': { break; } ##### FUTURE
  default: { break; } # Never trust the user!
 } # end switch
}

// Now, time to output the page
require_once(HEADERF);

// We COULD combine several types of pages to output,
// we just need to know which one to show! $_POST could do that!

// $text has HTML of what we want on the page
$text = "\r\n<form name='main' method='POST' action='egdb.php'>".
 "<a href='".e_PLUGIN."egdb/item_submit.php'>Submit Item</a> | ".
 "<a href='".e_PLUGIN."egdb/item_search.php'>Search Item</a> | ".
 "Click on column title below to sort by that column!<br /><table class='fborder'><tr>".
 "<td class='fcaption' style='width:20%; text-align:center;'>";
if ($sorted==1) { $text .= "<span style='color:cyan; font-size:12px'>Item Name</span>"; }
 else { $text .= "<input class='button' type='submit' name='donow' value='Item Name' />"; }

$text .= "</td><td class='fcaption' style='width:10%; text-align:center;'>";
if ($sorted==2) { $text .= "<span style='color:cyan; font-size:12px'>Type</span>"; }
 else { $text .= "<input class='button' type='submit' name='donow' value='Type' />"; }

$text .= "</td></td><td class='fcaption' style='width:5%; text-align:center;'>";
if ($sorted==3) { $text .= "<span style='color:cyan; font-size:12px'>Level</span>"; }
 else { $text .= "<input class='button' type='submit' name='donow' value='Level' />"; }

$text .= "</td><td class='fcaption' style='width:20%; text-align:center;'>";
if ($sorted==4) { $text .= "<span style='color:cyan; font-size:12px'>Mob Name</span>"; }
 else { $text .= "<input class='button' type='submit' name='donow' value='Mob Name' />"; }

$text .= "</td><td class='fcaption' style='width:7%; text-align:center;'>";
if ($sorted==5) { $text .= "<span style='color:cyan; font-size:12px'>Mob Level</span>"; }
 else { $text .= "<input class='button' type='submit' name='donow' value='Mob Level' />"; }

$text .= "</td><td class='fcaption' style='width:20%; text-align:center;'>";
if ($sorted==6) { $text .= "<span style='color:cyan; font-size:12px'>Mob Sector</span>"; }
 else { $text .= "<input class='button' type='submit' name='donow' value='Mob Sector' />"; }

$text .= "</td><td class='fcaption' style='width:18%; font-size:12px; text-align:center;'>Area / Coords.</td>".
 "</tr>\r\n";
$num_categories = $sql -> db_Count("egdb", "(*)", "WHERE egdb_id");			
if ($num_categories) {
 switch ($sorted) {
  case 1: $sql -> db_Select("egdb","*","ORDER BY egdb_item_name, egdb_item_level",FALSE);
   break;
  case 2: $sql -> db_Select("egdb","*","ORDER BY egdb_item_type, egdb_item_name",FALSE);
   break;
  case 3: $sql -> db_Select("egdb","*","ORDER BY egdb_item_level, egdb_item_name",FALSE);
   break;
  case 4: $sql -> db_Select("egdb","*","ORDER BY egdb_mob_name, egdb_mob_level",FALSE);
   break;
  case 5: $sql -> db_Select("egdb","*","ORDER BY egdb_mob_level, egdb_mob_name",FALSE);
   break;
  case 6: $sql -> db_Select("egdb","*","ORDER BY egdb_mob_sector, egdb_mob_name",FALSE);
 } # end switch
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
 } # end while
}
$text .= "</table></form>\r\n"; // stop the table, force a line-break in source

// Render the value of $text in a table.
$title = EGDB_CORE_01;
$ns -> tablerender($title, $text);

// === End of BODY ===
// use FOOTERF for USER PAGES and e_ADMIN.'footer.php' for admin pages
require_once(FOOTERF);
?> 