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
// class2.php is the heart of e107, always include it first to give access to e107 constants and variables
require_once('../../class2.php');

// Protect the file from direct access (not really needed when class2.php is called)
if (!defined('e107_INIT')) { exit(); }

// Get language file (assume that the English language file is always present)
include_lan(e_PLUGIN.'EGDB/languages/'.e_LANGUAGE.'.php');

// use HEADERF for USER PAGES and e_ADMIN."auth.php" for admin pages
require_once(HEADERF);

$text = "
	 	Please fill out the form below. If you need to edit the data, PM Damuras with the correction. Do NOT abuse this system.<br>
		<a href='".e_PLUGIN."egdb/egdb.php'>Back</a>
	 	<br>
	 	<br>
		<form method='post' action='submit_process.php'>
		<div style='margin-left: auto;margin-right: auto;width: auto;text-align: left;'>
		<div style='width:80%'>
		<fieldset>
			<table border='0' cellspacing='15' width='100%'>
				<tr>
					<td>
					<b>".EGDB_SUBMIT_2."</b>
					</td>
					<td>
					<input class='tbox' size='25' type='text' name='egdb_item_name'/>
					</td>
				</tr>
				<tr>
					<td valign='top'>
					<b>".EGDB_SUBMIT_3."</b></td>
					<td>
					<select name='egdb_item_type' >
						<option value='default'>Select Type</option>
 					 	<option value='Ammo'>Ammo</option>
						<option value='Base'>Base</option>
						<option value='Beam'>Beam Weapon</option>
						<option value='Device'>Device</option>
						<option value='Engine'>Engine</option>
						<option value='Missile'>Missile Launcher</option>
						<option value='Projectile'>Projectile Weapon</option>
						<option value='Reactor'>Reactor</option>
						<option value='Shield'>Shield</option>
					</select>
					<br />
					</td>
				</tr>
				<tr>
					<td valign='top'>
					<b>".EGDB_SUBMIT_4."</b>
					</td>
					<td valign='top'>
					<select name='egdb_item_level' >
 					 <option value='1'>1</option>
					 <option value='2'>2</option>
					 <option value='3'>3</option>
					 <option value='4'>4</option>
					 <option value='5'>5</option>
					 <option value='6'>6</option>
					 <option value='7'>7</option>
					 <option value='8'>8</option>
					 <option value='9'>9</option>
					</select>
					</td>
				</tr>
				<tr>
					<td valign='top'>
					<b>".EGDB_SUBMIT_5."</b>
					</td>
					<td valign='top'>
					<input class='tbox' size='25' type='text' name='egdb_mob_name' />
					</td>
				</tr>
				<tr>
					<td valign='top'>
					<b>".EGDB_SUBMIT_6."</b>
					</td>
					<td valign='top'>
					<select name='egdb_mob_level' >
 					 <option value='1'>1</option>
					 <option value='2'>2</option>
					 <option value='3'>3</option>
					 <option value='4'>4</option>
					 <option value='5'>5</option>
					 <option value='6'>6</option>
					 <option value='7'>7</option>
					 <option value='8'>8</option>
					 <option value='9'>9</option>
					 <option value='10'>10</option>
					 <option value='11'>11</option>
					 <option value='12'>12</option>
					 <option value='13'>13</option>
					 <option value='14'>14</option>
					 <option value='15'>15</option>
					 <option value='16'>16</option>
					 <option value='17'>17</option>
					 <option value='18'>18</option>
					 <option value='19'>19</option>
					 <option value='20'>20</option>
					 <option value='21'>21</option>
					 <option value='22'>22</option>
					 <option value='23'>23</option>
					 <option value='24'>23</option>
					 <option value='25'>25</option>
					 <option value='26'>26</option>
					 <option value='27'>27</option>
					 <option value='28'>28</option>
					 <option value='29'>29</option>
					 <option value='30'>30</option>
					 <option value='31'>31</option>
					 <option value='32'>32</option>
					 <option value='33'>33</option>
					 <option value='34'>34</option>
					 <option value='35'>35</option>
 					 <option value='36'>36</option>
					 <option value='37'>37</option>
					 <option value='38'>38</option>
					 <option value='39'>39</option>
					 <option value='40'>40</option>
					 <option value='41'>41</option>
					 <option value='42'>42</option>
					 <option value='43'>43</option>
					 <option value='44'>44</option>
					 <option value='45'>45</option>
					 <option value='46'>46</option>
					 <option value='47'>47</option>
					 <option value='48'>48</option>
					 <option value='49'>49</option>
					 <option value='50'>50</option>
					 <option value='51'>51</option>
					 <option value='52'>52</option>
					 <option value='53'>53</option>
					 <option value='54'>54</option>
					 <option value='55'>55</option>
					 <option value='56'>56</option>
					 <option value='57'>57</option>
					 <option value='58'>58</option>
					 <option value='59'>59</option>
					 <option value='60'>60</option>
					 <option value='61'>61</option>
					 <option value='62'>62</option>
					 <option value='63'>63</option>
					 <option value='64'>64</option>
					 <option value='65'>65</option>
					 <option value='66'>66</option>
					 <option value='67'>67</option>
					 <option value='68'>68</option>
					 <option value='69'>69</option>
					 <option value='70'>70</option>
					</select>
					</td>
				</tr>
				<tr>
					<td valign='top'>
					<b>".EGDB_SUBMIT_7."</b>
					</td>
					<td valign='top'>
					<input class='tbox' size='25' type='text' name='egdb_mob_sector' />
					</td>
				</tr>
				<tr>
					<td valign='top'>
					<b>".EGDB_SUBMIT_8."</b>
					</td>
					<td valign='top'>
					<input class='tbox' size='25' type='text' name='egdb_mob_area' />
					</td>
				</tr>
				<tr>
					<td valign='top'>
					
					</td>
					<td valign='top'>
					<input type='hidden' value=". USERNAME ." name='egdb_contributor' />
					</td>
				</tr>
					</table>
					
					<br />
					
					<div style='margin-left: auto;margin-right: auto;width: 10em;text-align: left;'>
						<input type='hidden' name='create_item' value='1' />
						<input class='button' type='submit' value='".EGDB_SUBMIT_9."' />
					</div>
					
					<br />
				</fieldset>
			</div>
		</div>
	</form>";

$title = EGDB_SUBMIT_1;
$ns -> tablerender($title, $text);

require_once(FOOTERF);

?>