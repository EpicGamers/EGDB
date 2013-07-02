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
$pageid = 'admin_menu_02';

// Define variable $text
$text = "";

// Edit / Maintain existing category
if (intval($_GET['edit_category']) == 1) // Sanatize the value from the form to prevent malicious injections in MySQL select statement
{	// Select the single record from the database
	$sql -> db_Select("yourfirstplugin_categories", "*", "yourfirstplugin_id=".intval($_GET['yourfirstplugin_id']));
	if($row = $sql-> db_Fetch())
	{
	    $yourfirstplugin_id = $row['yourfirstplugin_id'];
	    $yourfirstplugin_name = $row['yourfirstplugin_name'];
    	$yourfirstplugin_image_path = $row['yourfirstplugin_image_path'];
    	$yourfirstplugin_test_01 = $row['yourfirstplugin_test_01'];
    	$yourfirstplugin_test_02 = $row['yourfirstplugin_test_02'];
    	$yourfirstplugin_test_03 = $row['yourfirstplugin_test_03'];
    	$yourfirstplugin_test_04 = $row['yourfirstplugin_test_04'];
    	$yourfirstplugin_test_integer = $row['yourfirstplugin_test_integer'];
    	$yourfirstplugin_active_status = $row['yourfirstplugin_active_status'];
    	$yourfirstplugin_order = $row['yourfirstplugin_order'];
	}
	
	$text .= "
	<br />
	<form method='post' action='admin_categories_edit.php'>
		<class style='text-align: center;'>
			<div style='width:80%'>
				<fieldset>
					<legend>
						".EGDB_CAT_17."
					</legend>
					<table border='0' cellspacing='15' width='100%'>
						<tr>
							<td>
								<b>".EGDB_CAT_04."</b>
							</td>
							<td>
								$yourfirstplugin_id
							</td>
						</tr>
						<tr>
							<td>
								<b>".EGDB_CAT_05."</b>
							</td>
							<td>
								<input class='tbox' size='25' type='text' name='yourfirstplugin_name' value='$yourfirstplugin_name' />
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".EGDB_CAT_06."</b>
							</td>
							<td>
								<input class='tbox' size='25' name='yourfirstplugin_image_path' value='$yourfirstplugin_image_path' />
								<br />
								<img src='".e_IMAGE."admin_images/docs_16.png' alt='' /> ".EGDB_CAT_07."
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".EGDB_CAT_08."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='yourfirstplugin_test_01' value='$yourfirstplugin_test_01' />
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".EGDB_CAT_09."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='yourfirstplugin_test_02' value='$yourfirstplugin_test_02' />
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".EGDB_CAT_10."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='yourfirstplugin_test_03' value='$yourfirstplugin_test_03' />
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".EGDB_CAT_11."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='yourfirstplugin_test_04' value='$yourfirstplugin_test_04' />
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".EGDB_CAT_12."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='yourfirstplugin_test_integer' value='$yourfirstplugin_test_integer' />
							</td>
						</tr>
						<tr>
							<td>
								<b>".EGDB_CAT_15."</b>
							</td>
							<td>";

	// Display the check box for active status (active = 2)
	if ($yourfirstplugin_active_status == 2) 
	{
		$text .= "
								<input type='checkbox' name='yourfirstplugin_active_status' value='2' checked='checked' />";
	} 
	else 
	{
		$text .= "
								<input type='checkbox' name='yourfirstplugin_active_status' value='1' />";
	}

	$text .= "
							</td>
						</tr>
					</table>
					<br />
					<class style='text-align: center;'>
						<input type='hidden' name='yourfirstplugin_id' value='".intval($_GET['yourfirstplugin_id'])."' />
						<input type='hidden' name='edit_category' value='2' />
						<input class='button' type='submit' value='".EGDB_CAT_13."' />
					</class>
					<br /><br />
				</fieldset>
			</div>
		</class>
	</form>";
	
	// Render the value of $text in a table.
	$title = EGDB_CAT_00;
	$ns -> tablerender($title, $text);
} 
else 
{	// Initial screen with Maintain YourFirstPlugin Categories

	// Determine if there are no categories
	if($sql -> db_Count("yourfirstplugin_categories") > 0) 
	{
		$no_categories = 1;
	}

	//  Retrieve the records from the database
	$sql -> db_Select("yourfirstplugin_categories");
	while($row = $sql-> db_Fetch())
	{
		$yourfirstplugin_id = $row['yourfirstplugin_id'];
		$yourfirstplugin_name = $row['yourfirstplugin_name'];
		$yourfirstplugin_image_path = $row['yourfirstplugin_image_path'];
		$yourfirstplugin_test_01 = $row['yourfirstplugin_test_01'];
		$yourfirstplugin_test_02 = $row['yourfirstplugin_test_02'];
		$yourfirstplugin_test_03 = $row['yourfirstplugin_test_03'];
		$yourfirstplugin_test_04 = $row['yourfirstplugin_test_04'];
		$yourfirstplugin_test_integer = $row['yourfirstplugin_test_integer'];
		$yourfirstplugin_active_status = $row['yourfirstplugin_active_status'];
		$yourfirstplugin_order = $row['yourfirstplugin_order'];
	}
	
	$text .= "
	<br />
	<form method='post' action='admin_categories_edit.php'>
		<class style='text-align: center;'>
			<fieldset>
				<legend>
					".EGDB_CAT_01."
				</legend>";
    // Show a message if there are no categories to display
	if ($no_categories == null) 
	{
		$text .= "
				<br />
				<class style='text-align: center;'>
					<span class='smalltext'>
						".EGDB_CAT_02."
					</span>
				</class>
				<br /><br />";
	}
	else 
	{
		$text .= "
				<br />
				<class style='text-align: center;'>
				<table style='".ADMIN_WIDTH."' class='fborder'>
					<tr>
						<td class='fcaption'><b>".EGDB_CAT_04."</b></td>
						<td class='fcaption'><b>".EGDB_CAT_05."</b></td>
						<td class='fcaption'>
							<class style='text-align: center;'>
								<b>".EGDB_CAT_14."</b>
							</class>
						</td>
						<td class='fcaption'>
							<class style='text-align: center;'>
								<b>".EGDB_CAT_15."</b>
							</class>
						</td>
						<td class='fcaption'>
							<b>".EGDB_CAT_16."</b>
						</td>
					</tr>";
		// While there are records available; fill the rows to display them all in the userdefined order (and order same leveled on id)
		$sql -> db_Select("yourfirstplugin_categories", "*", "ORDER BY yourfirstplugin_order,yourfirstplugin_id", "no-where");
		while($row = $sql-> db_Fetch())
		{
			$text .= "
					<tr>
						<td class='forumheader3'>
							<class style='text-align: center;'>
								".$row['yourfirstplugin_id']."
							</class>
						</td>
						<td class='forumheader3'>
							".$row['yourfirstplugin_name']."
						</td>
						<td class='forumheader3'>
							<class style='text-align: center;'>
								<select class='tbox' name='yourfirstplugin_order[]'>";
			// Second query to build the selection list with order numbers
			$sql2 = new db();
			$num_rows = $sql2 -> db_Count("yourfirstplugin_categories", "(*)");
			$count = 1;
			while ($count <= $num_rows) 
			{
				if ($row['yourfirstplugin_order'] == $count) 
				{	// Display option as selected
					$text .= "
								<option value='".$row['yourfirstplugin_id']."~".$count."' selected='selected'>".$count."</option>";
				} 
				else 
				{	// The option is not selected
					$text .= "
								<option value='".$row['yourfirstplugin_id']."~".$count."'>".$count."</option>";
				}
				$count++;
			}
			$text .= "
								</select>
							</class>
						</td>
						<td class='forumheader3'>
							<class style='text-align: center;'>";
			// Display the check box for active status (active = 2)
			if ($row['yourfirstplugin_active_status'] == 2) 
			{
				$text .= "
								<input type='checkbox' name='yourfirstplugin_active_status[]' value='".$row['yourfirstplugin_id']."' checked='checked' />";
			} 
			else 
			{
				$text .= "
								<input type='checkbox' name='yourfirstplugin_active_status[]' value='".$row['yourfirstplugin_id']."' />";
			}
			// Show the edit and delete icons
			$text .= "
							</class>
						</td>
						<td class='forumheader3'>
							<div style='margin-left: auto;margin-right: auto;width: 5em;text-align: left;'>
								<a href='admin_categories.php?edit_category=1&amp;yourfirstplugin_id=".$row['yourfirstplugin_id']."' alt='".EGDB_CAT_18."'>".ADMIN_EDIT_ICON."</a>
								&nbsp;
								<a href='admin_categories_edit.php?delete_category=1&amp;yourfirstplugin_id=".$row['yourfirstplugin_id']."' alt='".EGDB_CAT_19."'>".ADMIN_DELETE_ICON."</a>
							</div>
						</td>
					</tr>";
		}
		// Close the table and display the Apply Changes button
		$text .= "
				</table>
				</class>
				<br />
				<class style='text-align: center;'>
					<input type='hidden' name='change_order' value='1'>
					<input class='button' type='submit' value='".EGDB_CAT_13."'>
				</class>
				<br />";
	}
	$text .= "
			</fieldset>
		</class>
	</form>
	<br />";
	// Display the Create New Category form
	$text .= "
	<form method='post' action='admin_categories_edit.php'>
		<div style='margin-left: auto;margin-right: auto;width: 75em;text-align: left;'>
			<div style='width:80%'>
				<fieldset>
					<legend>
						".EGDB_CAT_03."
					</legend>
					<table border='0' cellspacing='15' width='100%'>
						<tr>
							<td>
								<b>".EGDB_CAT_05."</b>
							</td>
							<td>
								<input class='tbox' size='25' type='text' name='yourfirstplugin_name' />
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".EGDB_CAT_06."</b>
							</td>
							<td>
								<input class='tbox' size='25' type='text' name='yourfirstplugin_image_path'><br />
								<img src='".e_IMAGE."admin_images/docs_16.png' alt='' /> ".EGDB_CAT_07."
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".EGDB_CAT_08."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='yourfirstplugin_test_01' />
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".EGDB_CAT_09."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='yourfirstplugin_test_02' />
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".EGDB_CAT_10."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='yourfirstplugin_test_03' />
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".EGDB_CAT_11."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='yourfirstplugin_test_04' />
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".EGDB_CAT_12."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='yourfirstplugin_test_integer' />
							</td>
						</tr>
						<tr>
							<td>
								<b>".EGDB_CAT_15."</b>
							</td>
							<td>
								<input type='checkbox' name='yourfirstplugin_active_status' value='1' />
							</td>
						</tr>
					</table>
					<br />
					<div style='margin-left: auto;margin-right: auto;width: 10em;text-align: left;'>
						<input type='hidden' name='create_category' value='1' />
						<input class='button' type='submit' value='".EGDB_CAT_03."' />
					</div>
					<br />
				</fieldset>
			</div>
		</div>
	</form>";
	// Render the value of $text in a table.
	$title = EGDB_CAT_00;
	$ns -> tablerender($title, $text);
}
require_once(e_ADMIN.'footer.php');
?>