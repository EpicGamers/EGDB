<?php # e_help.php
/*-----------------------------------------------------------------------------+
|     YourFirstPlugin - a plugin skeleton by nlstart
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org<).
+-----------------------------------------------------------------------------*/

// ATTENTION: help.php is obsolete as from e107 version 0.8!
// Protect the file from direct access
if(!defined("e107_INIT")){ exit; }

// Get language file (assume that the English language file is always present)
include_lan(e_PLUGIN.'EGDB/languages/'.e_LANGUAGE.'.php');

$helptitle  = EGDB_ADMIN_HELP_00;

$helpcapt[] = EGDB_ADMIN_HELP_01;
$helptext[] = EGDB_ADMIN_HELP_02;

$helpcapt[] = EGDB_ADMIN_HELP_03;
$helptext[] = EGDB_ADMIN_HELP_04;

$helpcapt[] = EGDB_ADMIN_HELP_05;
$helptext[] = EGDB_ADMIN_HELP_06;

$helpcapt[] = EGDB_ADMIN_HELP_07;
$helptext[] = EGDB_ADMIN_HELP_08;

$helpcapt[] = EGDB_ADMIN_HELP_09;
$helptext[] = EGDB_ADMIN_HELP_10;

$text2 = ''; // Define $text2 variable
for ($i = 0, $max = count($helpcapt); $i < $max; $i++) 
{
	$text2 .= '<b>'.$helpcapt[$i].'</b><br />';
	$text2 .= $helptext[$i].'<br /><br />';
};
$ns -> tablerender($helptitle, $text2);
?>