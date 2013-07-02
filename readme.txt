#==============================================================================+
#   YourFirstPlugin v1.4 - an e107 Plugin skeleton by nlstart
#
#   Plugin Support Website: [link=external=http://e107.webstartinternet.com/]e107.webstartinternet.com[/link]
#
#   A plugin template for the e107 Website System; visit [link=external=http://e107.org/]e107.org[/link]
#   For more plugins visit: [link=external=http://plugins.e107.org/]plugins.e107.org[/link]
#   or [link=external=http://www.e107coders.org/]e107coders.org[/link]
#
#==============================================================================+
Thank you for using YourFirstPlugin. You can show your appreciation and support future development by [link=https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=nlstart%40webstartinternet%2ecom&item_name=NLSTART%20Plugins&no_shipping=0&no_note=1&tax=0&currency_code=EUR&lc=EN&bn=PP%2dDonationsBF&charset=UTF%2d8]donate via PayPal[/link] to NLSTART.
Alternatively, send me something from [link=https://www.amazon.com/gp/registry/wishlist/KA5YB4XJZYCW/]my Amazon wishlist[/link] to keep me motivated!

Purpose of the YourFirstPlugin plugin
=====================================
GOAL: Make an easy start on developing an e107 Plugin.
NOTE: Technically this is not a real plugin, but a skeleton that can be used as a framework to quickly start building your plugin.
The YourFirstPlugin is also meant as an example. Actually, you could see it as an complex way of saying 'Hello World' in e107! Even if you wouldn't change the code it will still work and can be installed (and uninstalled) as any regular plugin.
Better and more examples can be found e.g. in Bugrain's e107 Helper Developer or in the e107 Core modules themselves.

Prerequisites:
==============
* E107 core v0.7.7 (or newer) installed.
* Preferably a proper developer editor installed (e.g. [link=http://notepad-plus.sourceforge.net/]Notepad++[/link])

Installation:
=============
1. Flying Kickstart:
====================
a. Upload the Locator plugin files into your 'e107_plugins' folder. Although 'Upload plugin' from the Admin section might work, uploading your plugin files by using an FTP client program is recommended.
b. When working on Linux or Unix based server set the CHMOD settings of directories to 755 and set CHMOD of all .php files to 644.
c. Login as an administrator into e107, go to Plugin Manager, install YourFirstPlugin and happy hacking!

2. For a more prepared start of your Plugin development (adviced):
==================================================================
a. Unzip the files, rename the YourFirstPlugin directory in what you would like to call your Plugin.
b. Replace the images of the \images folder with appropriate logo's for your plugin (respectively 32 by 32 pixels and 16 by 16 pixels)
c. Edit file \includes\config.php. Here is where you define all your table names.
d. Edit file admin_config.php: change the language folder names
e. Edit file admin_config_edit.php: change the language folder names
f. admin_menu.php: change the language folder names
g. help.php: change the language folder names
   ATTENTION: help.php is obsolete as from e107 version 0.8
h. admin_readme.php: change the language folder names
i. rename YourFirstPlugin.php to your liking
j. plugin.php: change the appropriate settings
k. Upload YourFirstPlugin files into your 'e107_plugins' folder. Although 'Upload plugin' from the Admin section might work, uploading your files by using an FTP client program is recommended.
l. When working on Linux or Unix based server set the CHMOD settings of all .php files to 644.
m. Login as an administrator into e107, go to Plugin Manager, install YourFirstPlugin and you can start coding!

3. Updates:
===========
Not applicable; no database updates since v1.0!


Important background information
================================
General Preferences are saved in the MySQL database in file 'e107_core' (file names my vary depending on your database preference), in field 'Siteprefs'. The fields are stored in an array (as all e107 preferences are in here) starting with 'yourfirstplugin_'.
The categories are saved in the MySQL database in file 'e107_yourfirstplugin_categories').
General advice: if you copy this plugin into your own development plugin folder, do not forget to apply the following:
1. change $eplug_folder = "yourfirstplugin"; in plugin.php
2. change $eplug_menu_name = "yourfirstplugin"; in plugin.php
3. search and replace for all language files yourfirstplugin/languages/ in all files
4. rename in \includes\config.php the 'yourfirstplugin_categories' file name into your own plugin filename.
If you want a specific readme file you can just copy the readme.txt; the file that is read by admin_readme.php is defined by the setting YOURFIRSTPLUGIN_ADMIN_HELP_99 from the language file.
You can even use [b]BBcode[/b] in the readme.txt. It will be displayed by the admin_readme.php as default BBcode text styles in e107.
Additional information can be found at the [link=external=http://wiki.e107.org/?title=YourFirstPlugin]e107.org Wiki 'YourFirstPlugin' page[/link].

Troubleshooting
===============
If you've changed the Plugin code and/or directory structure(s) and/or (file)names and it does not work... Please uninstall and use the 'Flying Kickstart' method. If the module is not working without modifications something else might be wrong.

If you changed or added a line to your program; try to test the program immediately. It is better to do things step by step than to insert a big new part and trying to puzzle afterwards.
When you receive a HTTP 500 error after you changed or added something; look if you forgot a closing ";" character. Otherwise, Undo, Save and test just until your code is working again.

Sometimes when programming your own module it might be handy to have some debug information. Once activated, you'll see SQL Traffic counters, SQL query analysis and PHP errors all at the bottom of your page. Here's how:
Activate debug option in Admin area > Preferences > Advanced Features > Developer Mode: On
Switch debug on with yourfirstplugin.php?[debug=all+]
Switch debug off with yourfirstplugin.php?[debug=all-]
De-activate debug option in Admin area > Preferences > Advanced Features > Developer Mode: Off
NOTE: developer mode should only switched to 'On' in a test environment!

Writing safe plugins
====================
Software is as strong as the weakest link.
Some plugins are vulnerable because hackers use their exploits. There are two basic rules for avoiding sql-injections in your plugins:
1. any (int) vars in sql-queries which users/admin send to you php script ($_POST, $_GET, $_COOKIES, e107 e_Query) must be used with intval.
Examples:
 very bad(!) $sql->db_Select_gen("SELECT * FROM #user WHERE user_id=".$_POST['u']);
 still bad(!!) $sql->db_Select_gen("SELECT * FROM #user WHERE user_id='".$_POST['u']."'"); //bad only if magic_quotes_gpc=off - but this is not very rare situation
 good - $sql->db_Select_gen("SELECT * FROM #user WHERE user_id=".intval($_POST['u']));

2. any (varchar) vars in sql-queries which users/admin send to you php script must be used with $tp->toDB().
Examples:
 bad(!) $sql->db_Select_gen("SELECT * FROM #user WHERE user_name = '".$_GET['uname']."'");
 good - $sql->db_Select_gen("SELECT * FROM #user WHERE user_name = '".$tp->toDB($_GET['uname'])."'");

This applies not only for "SELECT" queries, but also for "DELETE", "INSERT" and "UPDATE".
If you will stick to these simple rules, there will be no danger for any sql-injection at all!

Demonstration
=============
The back end program to create categories is all ready for you to use. You can see an example how to present active categories to your audience in the example of yourfirstplugin.php

Changelog:
==========
Version 1.4 (June 27, 2009)
 * Sub-goals for release 1.4:
   - improvements
 * New/Added Features:
  - admin_categories_edit.php: introduced sanatizing hints at top
 * Altered Features:
   - placed check for admin users above require_once auth.php; thanks marj
   - admin_categories_edit; code optimisation to prevent double count; thanks marj
   - admin_categories; order same leveled categories on id number
   - plugin.php: introduced yourfirstplugin_upgrade function to perform only at upgrade moment
 * Bugs Fixed:
   - plugin.php: removed DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; thanks marj
   - plugin.php: changed ENGINE=MyISAM into TYPE=MyISAM
   - general: exit; changed to exit(); thanks marj
   - general: XHTML compliancy: (a giant thank you to marj)
		* proper escaping of br-tag and input-tag
		* lower cased POST in form-tag
		* col attribute in input-tag changed to size
		* name attribute in form-tag changed to id
		* alt attribute in a-tag
		* center-tag is not valid in XHTML 1.1 replaced by proper class or div
		* colspan=2 must be colspan="2"
 * Minor Changes:
   - plugin.php: changed for 1.4 version
   - a few comment lines extra
 * Known bugs:
   - none
 * Alerts:
   - ATTENTION: help.php is obsolete as from e107 version 0.8

Version 1.3 (June 16, 2009)
 * Sub-goals for release 1.3:
   - improvements
 * New/Added Features:
  - yourfirstplugin.php: demonstration on how to present categories
 * Altered Features:
   - includes/config.php: made obsolete
   - plugin.php: used e_PLUGIN_ABS instead of making a global variable
 * Bugs Fixed:
   - none
 * Minor Changes:
   - general: improved code readability
   - general: changed/added comments
   - languages/English.php: added YOURFIRSTPLUGIN_CORE_03 to YOURFIRSTPLUGIN_CORE_05
   - plugin.php: changed to delete obsolete config.php
 * Known bugs:
   - none


Version 1.2 (November 23, 2008):
 * Sub-goals for release 1.2:
   - improvements
 * New/Added Features:
  - admin_programs ensured to be loaded in admin theme by setting $eplug_admin = true before calling class2
 * Altered Features:
   - admin_categories.php: replaced & sign in url for XHTML compliancy
   - admin_categories_edit.php: replaced & sign in url for XHTML compliancy
 * Bugs Fixed:
   - admin_categories.php: security improvements
   - admin_categories_edit.php: security improvements
   - yourfirstplugin.php: activated protect from direct access
 * Minor Changes:
   - readme.txt: advice for writing safe plugins
 * Wishlist:
   -
 * Known bugs:
   -


Version 1.1 (November 06, 2007):
 * Sub-goals for release 1.1:
   - improvements
 * New/Added Features:
 * Altered Features:
   - adjusted active checkbox to new category and change category
 * Bugs Fixed:
   - admin_categories_edit: adjusted storage of category interval into intval($tp->toDB($_POST['yourfirstplugin_test_integer'])).
     It's good practice to do something like this when the value must be an integer and is coming from 'user input' to
     prevent possible SQL injection problems.
   - admin_categories.php: changed language file approach from require_once into include_lan
   - admin_config.php: changed language file approach from require_once into include_lan
   - admin_config.php: changed storage of variables with right database parsers
   - admin_menu.php: changed language file approach from require_once into include_lan
   - admin_readme.php: changed language file approach from require_once into include_lan
   - help.php: changed language file approach from require_once into include_lan
   - plugin.php: changed language file approach from require_once into include_lan
   - yourfirstplugin.php: added correct php tag on top of file
 * Minor Changes:
   - comment text change in plugin.php
   - made some small textual changes to the readme.txt
 * Wishlist:
   -
 * Known bugs:
   -

Version 1.0 (January 25, 2007):
 * Sub-goals for release 1.0: 
   - make plugin fully e107 compliant
   - make plugin language independent 
   - initial version
 * New/Added Features:
   - made plugin also language file dependent
 * Altered Features:
   -
 * Bugs Fixed:
   - replaced mysql_real_escape_string to $tp->toDB when saving variables.
     This respects various e107 (rights) settings and also avoids XSS and other injection vulnerabilities.
   - admin_readme.php: changed read of file to lowercase for Unix compatability (RC 2)
 * Minor Changes:
   - changed language file access into smaller coding
 * Wishlist:
   - 
 * Known bugs:
   - in admin_config.php a directory with \ will double the preference input into \\.
     [link=external=http://e107.org/e107_plugins/forum/forum_viewtopic.php?100499]See e107.org topic 100499[/link]


Future roadmap
==============
* actually monitor the buglist on [link=external=http://e107.webstartinternet.com]e107.webstartinternet.com[/link]
* monitor what features end users want

License
=======
YourFirstPlugin is distributed as free open source code released under the terms and conditions of the [link=external=http://gnu.org/]GNU General Public License[/link].