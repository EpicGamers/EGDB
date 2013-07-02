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
// Ensure this setting is loaded in admin theme before calling class2
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
$pageid = 'admin_menu_01';

// If the submit button is hit; update the settings in table core, record SitePrefs
// Initial default values of the preferences are set by plugin.php at $eplug_prefs
if (isset($_POST['update_prefs'])) 
{
	$pref['yourfirstplugin_name']        = $tp->toDB($_POST['yourfirstplugin_name']);
	$pref['yourfirstplugin_image_path']  = $tp->toDB($_POST['yourfirstplugin_image_path']);
	$pref['yourfirstplugin_test_01']     = $tp->toDB($_POST['yourfirstplugin_test_01']);
	$pref['yourfirstplugin_test_02']     = $tp->toDB($_POST['yourfirstplugin_test_02']);
	$pref['yourfirstplugin_test_03']     = $tp->toDB($_POST['yourfirstplugin_test_03']);
	$pref['yourfirstplugin_test_04']     = $tp->toDB($_POST['yourfirstplugin_test_04']);
	$pref['yourfirstplugin_test_integer']= intval($_POST['yourfirstplugin_test_integer']);
	save_prefs();
	$message = EGDB_CONF_11;
}
// Displays the update message to confirm data is stored in database
if (isset($message)) 
{
	$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}

// The following form output will be put into variable $text.
// The form will call admin_config_edit for further actions.
// All language dependent text are referring to the language file.
// E.g. .EGDB_CONF_01. will retrieve the accompanying text.
// Remember NOT to put comments in the text as they will be published.
// In the form data is retrieved from table core, record SitePrefs using $pref
$text = '
<div style="text-align:center">
<form id="settings_form" action="'.e_SELF.'" method="post">
	<fieldset>
		<legend>
			'.EGDB_CONF_01.'
		</legend>
		<table border="0" class="tborder" cellspacing="10">
			<tr>
				<td class="tborder" style="width: 200px">
					<span class="smalltext" style="font-weight: bold">
						'.EGDB_CONF_02.'
					</span>
				</td>
				<td class="tborder" style="width: 200px">
					<input class="tbox" size="25" type="text" name="yourfirstplugin_name" value="'.$pref['yourfirstplugin_name'].'" />
				</td>
			</tr>
			<tr>
				<td class="tborder" style="width: 200px">
					<span class="smalltext" style="font-weight: bold">
						'.EGDB_CONF_03.'
					</span>
				</td>
				<td class="tborder" style="width: 200px" valign="top">
					<input class="tbox" size="35" type="text" name="yourfirstplugin_image_path" value="'.$pref['yourfirstplugin_image_path'].'" />
				</td>
			</tr>
			<tr>
				<td colspan="2" class="tborder" style="width: 200px" valign="top">
					<img src="'.e_IMAGE.'admin_images/docs_16.png" alt="" /> '.EGDB_CONF_04.'
				</td>
			</tr>
			<tr>
				<td class="tborder" style="width: 200px">
					<span class="smalltext" style="font-weight: bold">
						'.EGDB_CONF_05.'
					</span>
				</td>
				<td class="tborder" style="width: 200px">
					<input class="tbox" size="25" type="text" name="yourfirstplugin_test_01" value="'.$pref['yourfirstplugin_test_01'].'" />
				</td>
			</tr>
			<tr>
				<td class="tborder" style="width: 200px">
					<span class="smalltext" style="font-weight: bold">
						'.EGDB_CONF_06.'
					</span>
				</td>
				<td class="tborder" style="width: 200px">
					<input class="tbox" size="25" type="text" name="yourfirstplugin_test_02" value="'.$pref['yourfirstplugin_test_02'].'" />
				</td>
			</tr>
			<tr>
				<td class="tborder" style="width: 200px">
					<span class="smalltext" style="font-weight: bold">
						'.EGDB_CONF_07.'
					</span>
				</td>
				<td class="tborder" style="width: 200px">
					<input class="tbox" size="25" type="text" name="yourfirstplugin_test_03" value="'.$pref['yourfirstplugin_test_03'].'" />
				</td>
			</tr>
			<tr>
				<td class="tborder" style="width: 200px">
					<span class="smalltext" style="font-weight: bold">
						'.EGDB_CONF_08.'
					</span>
				</td>
				<td class="tborder" style="width: 200px">
					<input class="tbox" size="25" type="text" name="yourfirstplugin_test_04" value="'.$pref['yourfirstplugin_test_04'].'" />
				</td>
			</tr>
			<tr>
				<td class="tborder" style="width: 200px">
					<span class="smalltext" style="font-weight: bold">
						'.EGDB_CONF_09.'
					</span>
				</td>
				<td class="tborder" style="width: 200px">
					<input class="tbox" size="25" type="text" name="yourfirstplugin_test_integer" value="'.$pref['yourfirstplugin_test_integer'].'" />
				</td>
			</tr>
		</table>
	<br />
	<input class="button" type="submit" name="update_prefs" value="'.EGDB_CONF_10.'" />
	<br />
	</fieldset>
</form>
</div>
';
// Display the $text string into a rendered table with a caption from the language file
$caption = EGDB_CONF_00;
$ns->tablerender($caption, $text);
// Display the footer of the current website
require_once(e_ADMIN.'footer.php');
?>