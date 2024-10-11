<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Dennis theme.
 *
 * @package    theme_dennis
 * @copyright  &copy; 2020-onwards G J Barnard.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */

$string['choosereadme'] = '<div class="clearfix"><h2>Dennis</h2>'.
'<h3>About</h3>'.
'<p>Dennis is a basic child theme of the Boost theme.</p>'.
'<h3>Theme Credits</h3>'.
'<p>Author: G J Barnard<br>'.
'Contact: <a href="https://moodle.org/user/profile.php?id=442195">Moodle profile</a><br>'.
'Website: <a href="https://gjbarnard.co.uk">gjbarnard.co.uk</a>'.
'</p>'.
'<h3>More information</h3>'.
'<p><a href="dennis/Readme.md">How to use this theme.</a></p>'.
'</div></div>';

$string['configtitle'] = 'Dennis';
$string['pluginname'] = 'Dennis';

$string['region-side-pre'] = 'Right';
$string['region-footer'] = 'Footer';
$string['footerblocks'] = 'Footer blocks';

$string['drawerleftwidth'] = 'Left drawer width';
$string['drawerrightwidth'] = 'Right drawer width';
$string['sizesdesc'] = 'Between {$a->lower} and {$a->upper} pixels.';
$string['sizeserror'] = '{$a->setting} is outside the range {$a->lower} to {$a->upper}';

$string['fontsizes'] = 'Font sizes';
$string['fontsizesdesc'] = 'Set the base font size and heading multiplers.  Defaults of base: {$a->base}, h1: {$a->h1}, h2: {$a->h2}, h3: {$a->h3}, h4: {$a->h4}, h5: {$a->h5} and h6: {$a->h6}.';
$string['fontsizeslabel'] = 'Base<br>H1<br>H2<br>H3<br>H4<br>H5<br>H6';
$string['fontsizesordererror'] = '{$a->current} is greater than {$a->previous}';
$string['fontsizessizeerror'] = 'Not enough values';

$string['serverdatetime'] = 'Server date and time: ';
$string['serverdatetimebutton'] = 'Update the date and time';

$string['clickmebutton'] = 'Click me!';

// Privacy.
$string['privacy:nop'] = 'The Dennis theme stores has settings that pertain to its configuration.  It also may inherit settings and user preferences from the parent Boost theme, please examine the \'Plugin privacy compliance registry\' for \'Boost\' for details.  For the settings, it is your responsibility to ensure that no user data is entered in any of the free text fields.  Setting a setting will result in that action being logged within the core Moodle logging system against the user whom changed it, this is outside of the themes control, please see the core logging system for privacy compliance for this.  When uploading images, you should avoid uploading images with embedded location data (EXIF GPS) included or other such personal data.  It would be possible to extract any location / personal data from the images.  Please examine the code carefully to be sure that it complies with your interpretation of your privacy laws.  I am not a lawyer and my analysis is based on my interpretation.  If you have any doubt then remove the theme forthwith.';
