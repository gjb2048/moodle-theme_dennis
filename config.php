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

defined('MOODLE_INTERNAL') || die;

$THEME->doctype = 'html5';
$THEME->name = 'dennis';
$THEME->parents = ['boost'];
$THEME->sheets = [''];
$THEME->editor_sheets = [];
$THEME->usefallback = true;
$THEME->precompiledcsscallback = 'theme_boost_get_precompiled_css';
$THEME->enable_dock = false;

$THEME->supportscssoptimisation = false;
$THEME->yuicssmodules = [];

$dennisprefooter = ['side-pre', 'footer'];
$THEME->layouts = [
    // Standard layout with blocks.
    'standard' => [
        'file' => 'drawers.php',
        'regions' => $dennisprefooter,
        'defaultregion' => 'side-pre',
    ],
    // Main course page.
    'course' => [
        'file' => 'drawers.php',
        'regions' => $dennisprefooter,
        'defaultregion' => 'side-pre',
        'options' => ['langmenu' => true],
    ],
    'coursecategory' => [
        'file' => 'drawers.php',
        'regions' => $dennisprefooter,
        'defaultregion' => 'side-pre',
    ],
    // Part of course, typical for modules - default page layout if $cm specified in require_login().
    'incourse' => [
        'file' => 'drawers.php',
        'regions' => $dennisprefooter,
        'defaultregion' => 'side-pre',
    ],
    // The site home page.
    'frontpage' => [
        'file' => 'drawers.php',
        'regions' => $dennisprefooter,
        'defaultregion' => 'side-pre',
        'options' => ['nonavbar' => true],
    ],
    // Server administration scripts.
    'admin' => [
        'file' => 'drawers.php',
        'regions' => $dennisprefooter,
        'defaultregion' => 'side-pre',
    ],
    // My courses page.
    'mycourses' => [
        'file' => 'drawers.php',
        'regions' => $dennisprefooter,
        'defaultregion' => 'side-pre',
        'options' => ['nonavbar' => true],
    ],
    // My dashboard page.
    'mydashboard' => [
        'file' => 'drawers.php',
        'regions' => $dennisprefooter,
        'defaultregion' => 'side-pre',
        'options' => ['nonavbar' => true, 'langmenu' => true],
    ],
    // My public page.
    'mypublic' => [
        'file' => 'drawers.php',
        'regions' => $dennisprefooter,
        'defaultregion' => 'side-pre',
    ],
    // The pagelayout used for reports.
    'report' => [
        'file' => 'report.php',
        'regions' => ['footer'],
        'defaultregion' => 'footer',
    ],
];
$THEME->rendererfactory = 'theme_overridden_renderer_factory';

$THEME->prescsscallback = 'theme_dennis_get_pre_scss';
$THEME->scss = function(theme_config $theme) {
    return theme_dennis_get_main_scss_content($theme);
};
$THEME->extrascsscallback = 'theme_dennis_get_extra_scss';

$THEME->requiredblocks = '';
$THEME->addblockposition = BLOCK_ADDBLOCK_POSITION_FLATNAV;
$THEME->iconsystem = \core\output\icon_system::FONTAWESOME;
$THEME->haseditswitch = true;
$THEME->usescourseindex = true;
// By default, all boost themes do not need their titles displayed.
$THEME->activityheaderconfig = [
    'notitle' => true,
];
