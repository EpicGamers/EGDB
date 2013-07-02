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

require_once('../../class2.php');
require_once(e_HANDLER."userclass_class.php");

// Check to see if the current user has admin permissions for this plugin
if ( ! getperms('P')) { header('location:'.e_BASE.'index.php'); exit(); }

// Sanitize all expected incoming integer only variables
// This avoids redundant code and possible security issues due to a forgetten intval
// See security remarks in the readme.txt
$_GET['delete_category'] = intval($_GET['delete_category']);
$_GET['yourfirstplugin_id'] = intval($_GET['yourfirstplugin_id']);

function tokenizeArray($array) 
{	// Used in change category order
    unset($GLOBALS['tokens']);
    $delims = "~";
    $word = strtok( $array, $delims );
    while ( is_string( $word ) ) 
	{
        if ( $word ) 
		{
            global $tokens;
            $tokens[] = $word;
        }
        $word = strtok ( $delims );
    }
}

if ($_POST['create_category'] == '1') 
{    // If checkbox is checked the status will be received from the form
    if (isset($_POST['yourfirstplugin_active_status'])) 
	{
        $catactive_status = 2;
    }
	else 
	{
        $catactive_status = 1;
    }

    // Create new category
    $sql -> db_Insert("yourfirstplugin_categories",
		"0,
		'".$tp->toDB($_POST['yourfirstplugin_name'])."',
		'".$tp->toDB($_POST['yourfirstplugin_image_path'])."',
		'".$tp->toDB($_POST['yourfirstplugin_test_01'])."',
		'".$tp->toDB($_POST['yourfirstplugin_test_02'])."',
		'".$tp->toDB($_POST['yourfirstplugin_test_03'])."',
		'".$tp->toDB($_POST['yourfirstplugin_test_04'])."',
		'".intval($_POST['yourfirstplugin_test_integer'])."',
		'".$tp->toDB($catactive_status)."',
		1");
	header("location: admin_categories.php");
    exit();
}

if (intval($_POST['change_order']) == '1') 
{    // Change category order
	for ($x = 0, $max = count($_POST['yourfirstplugin_order']); $x < $max; $x++)
	{
        tokenizeArray($_POST['yourfirstplugin_order'][$x]);
        $newCategoryOrderArray[$x] = $tokens;
    }
	for ($x = 0; $x < $max; $x++)
	{
        $sql -> db_Update("yourfirstplugin_categories",
            "yourfirstplugin_order=".$tp->toDB($newCategoryOrderArray[$x][1])."
            WHERE yourfirstplugin_id=".intval($newCategoryOrderArray[$x][0]));
    }
    // Change category active status, too
    $sql -> db_Update("yourfirstplugin_categories", "yourfirstplugin_active_status = 1");
    foreach ($_POST['yourfirstplugin_active_status'] as $value) 
	{
    	$sql -> db_Update("yourfirstplugin_categories"," yourfirstplugin_active_status = 2
            WHERE yourfirstplugin_id=".intval($value));
    }
    // Go back to the calling application admin_categories.php
    header("location: admin_categories.php");
    exit();
}
elseif (intval($_POST['edit_category']) == '2') 
{	// Edit category: change an existing record

    // If checkbox is checked the status will be received from the form
    if (isset($_POST['yourfirstplugin_active_status'])) 
	{
        $catactive_status = 2;
    }
	else 
	{
        $catactive_status = 1;
    }
    $sql -> db_Update("yourfirstplugin_categories",
		"yourfirstplugin_name         = '".$tp->toDB($_POST['yourfirstplugin_name'])."',
		yourfirstplugin_image_path    = '".$tp->toDB($_POST['yourfirstplugin_image_path'])."',
		yourfirstplugin_test_01       = '".$tp->toDB($_POST['yourfirstplugin_test_01'])."',
		yourfirstplugin_test_02       = '".$tp->toDB($_POST['yourfirstplugin_test_02'])."',
		yourfirstplugin_test_03       = '".$tp->toDB($_POST['yourfirstplugin_test_03'])."',
		yourfirstplugin_test_04       = '".$tp->toDB($_POST['yourfirstplugin_test_04'])."',
		yourfirstplugin_test_integer  = '".intval($_POST['yourfirstplugin_test_integer'])."',
		yourfirstplugin_active_status = '".$tp->toDB($catactive_status)."'
		WHERE yourfirstplugin_id      = ".intval($_POST['yourfirstplugin_id']));
    // Go back to the calling application admin_categories.php
    header("location: admin_categories.php");
    exit();
}
if (intval($_GET['delete_category']) == '1') 
{	// Delete category, step 1
	// Verify the deletion before actually throwing the record away
	// If a user answers yes, the delete_category is set to value 2
    $text = "
    <br /><br />
    <class style='text-align: center;'>
        ".EGDB_CATEDIT_02."
        <br /><br />
        <table width='100'>
            <tr>
                <td>
                    <a href='admin_categories_edit.php?delete_category=2&amp;yourfirstplugin_id=".$_GET['yourfirstplugin_id']."'>".EGDB_CATEDIT_03."</a>
                </td>
                <td>
                    <a href='admin_categories.php'>".EGDB_CATEDIT_04."</a>
                </td>
            </tr>
        </table>
    </class>";
	
    // Render the value of $text in a table.
    $title = EGDB_CATEDIT_01;
}
elseif (intval($_GET['delete_category']) == '2') 
{	// Delete category, step 2
	// Actual delete action from category record from the table
	$categoryId = intval($_GET['yourfirstplugin_id']); // Already sanatized at the top; but it won't harm to be safe!
	$sql -> db_Delete("yourfirstplugin_categories", "yourfirstplugin_id=$categoryId");
    // Go back to the calling application admin_categories.php
    header("location: admin_categories.php");
    exit();
}
// Make sure that variable $text is created
$text = ($text) ? $text : '';
// Make sure that variable $title is created
$title = ($title) ? $title : '';

require_once(e_ADMIN.'auth.php');
$ns -> tablerender($title, $text);
require_once(e_ADMIN.'footer.php');
?>