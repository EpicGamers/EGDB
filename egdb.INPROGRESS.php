<?php # egdb.php
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

// class2.php is the heart of e107, always include it first to give access to e107 constants and variables
require_once('../../class2.php');

// Protect the file from direct access (not really needed when class2.php is called)
if (!defined('e107_INIT')) { exit(); }

// Is user signed in? If not, back to index page!
if (USER !== TRUE) {
   header('location:'.e_BASE.'index.php');
	exit();
}

// Get language file (assume that the English language file is always present)
include_lan(e_PLUGIN.'EGDB/languages/'.e_LANGUAGE.'.php');

// We need this function -
function escape_data($data) { # return a safety-filtered copy of $data
   if (ini_get('magic_quotes_gpc')) {
      $data = stripslashes(htmlspecialchars($data)); }
   $data = addslashes(htmlspecialchars(trim($data)));
   return $data;
}
// We need this ... for now
$A_ITyp = array('Ammo','Component','Beam','Device','Engine','Missile','Projectile','Reactor','Shield');

##### Remember: In PHP, we process the previous form input, THEN we output new page.

// We want to save the "sorted" variable between page requests
if (!isset($_SESSION['sorted'])) {
   $sorted = 3; // Item Type
   $_SESSION['sorted'] = $sorted; // save if does not exist
} else {
   $sorted = $_SESSION['sorted']; // retrieve if exists
}

// ...and we want to change it when it comes back in a page request
if (isset($_POST['donow'])) {
   switch ($_POST['donow']) {
      case EGDB_CAT_05: { $sorted = 1; $_SESSION['sorted'] = $sorted; break; }
      case EGDB_CAT_06: { $sorted = 2; $_SESSION['sorted'] = $sorted; break; }
      case EGDB_CAT_08: { $sorted = 3; $_SESSION['sorted'] = $sorted; break; }
      case EGDB_CAT_09: { $sorted = 4; $_SESSION['sorted'] = $sorted; break; }
      case EGDB_CAT_10: { $sorted = 5; $_SESSION['sorted'] = $sorted; break; }
      case EGDB_CAT_11: { $sorted = 6; $_SESSION['sorted'] = $sorted; break; }
      case EGDB_CORE_02: { $sf = 'A'; break; } # Show add form
      case EGDB_CORE_03: {
         // Validate info from the input form and place into DB
         $oops = FALSE;
         $msg = '';

         $INam = escape_data($_POST['egdb_item_name']);
         if (strlen($INam)>2) {
            $msg .= EGDB_CORE_11;
            $oops = TRUE;
         }
         $ITyp = escape_data($_POST['egdb_item_type']);
         if (!in_array($ITyp,$A_ITyp)) {
            if ($oops) { $msg .= ', '; }
            $msg .= EGDB_CORE_12;
            $oops = TRUE;
         }
         $ILvl = escape_data($_POST['egdb_item_level']);
         ##### FUTURE: Verify against table of known items and their levels
         if (($ILvl<1)||($ILvl>9)) {
            if ($oops) { $msg .= ', '; }
            $msg .= EGDB_CORE_13;
            $oops = TRUE;
         }
         $MNam = escape_data($_POST['egdb_mob_name']);
         if (strlen($MNam)>2) {
            $msg .= EGDB_CORE_14;
            $oops = TRUE;
         }
         $MLvl = escape_data($_POST['egdb_mob_level']);
         ##### FUTURE: Verify against table of known mobs and their levels
         if (($ILvl<1)||($ILvl>70)) {
            if ($oops) { $msg .= ', '; }
            $msg .= EGDB_CORE_15;
            $oops = TRUE;
         }
         $MSec = escape_data($_POST['egdb_mob_sector']);
         ##### FUTURE: Verify against table of known sectors
         $A_MSec = array('Glenn','Carpenter','Earth','Mars','Jupiter');
         if (!in_array($MSec,$A_MSec)) {
         if ($oops) { $msg .= ', '; }
            $msg .= EGDB_CORE_16;
            $oops = TRUE;
         }
         $MArea = escape_data($_POST['egdb_mob_area']);
         $Contrib = escape_data($_POST['egdb_contributor']);
         if (!$oops) { // Save it!
            $sql->db_insert( 'egdb', array('egdb_item_name'=>$INam,
               'egdb_item_type'=>$ITyp,'egdb_item_level'=>$ILvl,
               'egdb_mob_name'=>$MNam,'egdb_mob_level'=>$MLvl,
               'egdb_mob_sector'=>$MSec,'egdb_mob_area'=>$MArea,
               'egdb_contributor'=>$Contrib));
         } else {
            $msg = ucfirst($msg).'. '.EGDB_CORE_17; // Caps 1st letter, finish message
            $sf = 'A'; // Stay in Add mode
         }
         break; } # Processed Add
      case EGDB_CORE_06: { $sf = 'S'; break; } # Show search form
      case EGDB_CORE_07: {
         // Search for item in database
         break; } # Process Search
      default: { break; } # Never trust the user!
   } # end switch
}

// Now, time to output the page
require_once(HEADERF);

// $text will have XHTML of what we want on the page
$text = "\r\n<form name='main' method='POST' action='egdb.php'>";

// What to show?
if (isset($sf)) { // we could test in here for admin priviledges if needed
 switch ($sf) {
  case 'A': { // the "Add Item" screen
   $text = "<a href='".e_PLUGIN."egdb/egdb.php'>".EGDB_CORE_08."</a> | ".EGDB_CORE_10.
    "<p>&nbsp;</p><form name='main' method='POST' action='egdb.php'>".
    "<input type='hidden' value=".USERNAME." name='egdb_contributor' />".
/// "<div style='margin-left:auto; margin-right:auto; width:auto; '>".
    "<center><table border='0' width='100%'><tr>";
   if ($oops) { $text .= "<td style='color:red; text-align:center;' colspan='2'>$msg</td></tr><tr>"; }
   $text .= "<td style='text-align:right;' ><b>".EGDB_CAT_05."</b>: &nbsp; </td>".
    "<td style='padding:5px;' ><input class='tbox' size='25' type='text' name='egdb_item_name";
   if (isset($INam)) $text .= "' value='".$INam;
   $text .= "'' /></td></tr><tr>".
    "<td style='text-align:right;' ><b>".EGDB_CAT_06."</b>: &nbsp; </td>".
    "<td style='padding:5px;' ><select name='egdb_item_type'><option value='default'>Select Type</option>";
   ##### FUTURE: Need to read from DB and insert here
   foreach ($A_ITyp as $v) {
     $text .= "<option value='".$v; // Yes, quote is missing, see next 2 lines
     if ($ITyp==$v) { $text .= "' selected='selected"; }
     $text .= "'>".$v."</option>";
   }
   $text .= "</select></td></tr><tr>".
    "<td style='text-align:right;' ><b>".EGDB_CAT_08." (1-9)</b>: &nbsp; </td>".
    "<td style='padding:5px;' ><input type='number' name='egdb_item_level' min='1' max='9";
   if (isset($ILvl)) $text .= "' value='".$ILvl;
   $text .= "' /></td></tr><tr>".
    "<td style='text-align:right;' ><b>".EGDB_CAT_09."</b>: &nbsp; </td>".
    "<td style='padding:5px;' ><input class='tbox' size='25' type='text' name='egdb_mob_name";
   if (isset($MNam)) $text .= "' value='".$MNam;
   $text .= "'' /></td></tr><tr>".
    "<td style='text-align:right;' ><b>".EGDB_CAT_10." (0-70)</b>: &nbsp; </td>".
    "<td style='padding:5px;' ><input type='number' name='egdb_mob_level' min='0' max='70";
   if (isset($MLvl)) $text .= "' value='".$MLvl;
   $text .= "'' /></td></tr><tr>".
    "<td style='text-align:right;' ><b>".EGDB_CAT_11."</b>: &nbsp; </td>".
    "<td style='padding:5px;' ><input class='tbox' size='25' type='text' name='egdb_mob_sector";
   if (isset($MSec)) $text .= "' value='".$MSec;
   $text .= "'' /></td></tr><tr>".
    "<td style='text-align:right;' ><b>".EGDB_CAT_12."</b>: &nbsp; </td>".
    "<td style='padding:5px;' ><input class='tbox' size='25' type='text' name='egdb_mob_area' /></td>".
    "</tr><tr><td style='text-align:center; ' colspan='2'>".
    "<input class='button' type='submit' name='donow' value='".EGDB_CORE_03."' />".
    "</td></tr></table></center><!-- /div --></form>\r\n";
   $title = EGDB_CAT_04;
   break;
  }
  case 'S': { // the "Search For" screen
   break;
  }
 } # end switch
} else { // show the current items
 $text .= "<input class='button' type='submit' name='donow' value='".EGDB_CORE_02."' /> | ".
  "<input class='button' type='submit' name='donow' value='".EGDB_CORE_07."' /> | ".
  EGDB_CORE_09."<br /><table class='fborder'><tr>".
  "<td class='fcaption' style='width:20%; text-align:center;'>";
 if ($sorted==1) { $text .= "<span style='color:cyan; font-size:16px'>Item Name</span>"; }
  else { $text .= "<input class='button' type='submit' name='donow' value='".EGDB_CAT_05."' />"; }
 $text .= "</td><td class='fcaption' style='width:10%; text-align:center;'>";
 if ($sorted==2) { $text .= "<span style='color:cyan; font-size:16px'>Type</span>"; }
  else { $text .= "<input class='button' type='submit' name='donow' value='".EGDB_CAT_06."' />"; }
 $text .= "</td></td><td class='fcaption' style='width:4%; text-align:center;'>";
 if ($sorted==3) { $text .= "<span style='color:cyan; font-size:16px'>Level</span>"; }
  else { $text .= "<input class='button' type='submit' name='donow' value='".EGDB_CAT_08."' />"; }
 $text .= "</td><td class='fcaption' style='width:20%; text-align:center;'>";
 if ($sorted==4) { $text .= "<span style='color:cyan; font-size:16px'>Mob Name</span>"; }
  else { $text .= "<input class='button' type='submit' name='donow' value='".EGDB_CAT_09."' />"; }
 $text .= "</td><td class='fcaption' style='width:8%; text-align:center;'>";
 if ($sorted==5) { $text .= "<span style='color:cyan; font-size:16px'>Mob Level</span>"; }
  else { $text .= "<input class='button' type='submit' name='donow' value='".EGDB_CAT_10."' />"; }
 $text .= "</td><td class='fcaption' style='width:20%; text-align:center;'>";
 if ($sorted==6) { $text .= "<span style='color:cyan; font-size:16px'>Mob Sector</span>"; }
  else { $text .= "<input class='button' type='submit' name='donow' value='".EGDB_CAT_11."' />"; }
 $text .= "</td><td class='fcaption' style='width:18%; text-align:center;'>Area / Coords.</td>".
  "</tr>\r\n";
 $num_categories = $sql -> db_Count("egdb", "(*)", "WHERE egdb_id");
 if ($num_categories) {
  switch ($sorted) {
   case 1: { $sql->db_Select("egdb","*","ORDER BY egdb_item_name, egdb_item_level",FALSE); break; }
   case 2: { $sql->db_Select("egdb","*","ORDER BY egdb_item_type, egdb_item_name",FALSE); break; }
   case 3: { $sql->db_Select("egdb","*","ORDER BY egdb_item_level, egdb_item_name",FALSE); break; }
   case 4: { $sql->db_Select("egdb","*","ORDER BY egdb_mob_name, egdb_mob_level",FALSE); break; }
   case 5: { $sql->db_Select("egdb","*","ORDER BY egdb_mob_level, egdb_mob_name",FALSE); break; }
   case 6: { $sql->db_Select("egdb","*","ORDER BY egdb_mob_sector, egdb_mob_name",FALSE); }
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
 $text .= "</table></form>\r\n"; // stop the table
 $title = EGDB_CORE_01;
}

// Render the value of $text in a table.
$ns -> tablerender($title, $text);

// === End of BODY ===
// use FOOTERF for USER PAGES and e_ADMIN.'footer.php' for admin pages
require_once(FOOTERF);
?> 