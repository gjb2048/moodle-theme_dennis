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
 * @author     G J Barnard - {@link https://moodle.org/user/profile.php?id=442195}
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot.'/theme/boost/lib.php');

/**
 * Get SCSS to prepend.
 *
 * Not always required in a child theme of Boost but here so we can add our own pre SCSS easily.
 *
 * @param theme_config $theme The theme config object.
 * @return string SCSS.
 */
function theme_dennis_get_pre_scss($theme) {
    global $CFG;

    static $boosttheme = null;
    if (empty($boosttheme)) {
        $boosttheme = theme_config::load('boost'); // Needs to be the Boost theme so that we get its settings.
    }
    $scss = theme_boost_get_pre_scss($boosttheme);

    $scss .= file_get_contents($CFG->dirroot.'/theme/dennis/scss/dennis_pre.scss');

    if (!empty($theme->settings->drawerleftwidth)) {
        $scss .= '$drawer-left-width: '.$theme->settings->drawerleftwidth.'px;'.PHP_EOL;
    }

    if (!empty($theme->settings->drawerrightwidth)) {
        $scss .= '$drawer-right-width: '.$theme->settings->drawerrightwidth.'px;'.PHP_EOL;
    }

    // Test.
    /*$scss .= '$font-size-base: 1.5rem;';
    $scss .= '$h1-font-size: $font-size-base * 2.5;';
    $scss .= '$h2-font-size: $font-size-base * 2;';
    $scss .= '$h3-font-size: $font-size-base * 1.75;';
    $scss .= '$h4-font-size: $font-size-base * 1.5;';
    $scss .= '$h5-font-size: $font-size-base * 1.25;';
    $scss .= '$h6-font-size: $font-size-base * 1;';*/
    if (!empty($theme->settings->fontsizes)) {
        $sizes = \theme_dennis\admin_setting_configfontsizes::decode_from_db($theme->settings->fontsizes);
        $scss .= '$font-size-base: '.$sizes[0].';';
        $scss .= '$h1-font-size: $font-size-base * '.$sizes[1].';';
        $scss .= '$h2-font-size: $font-size-base * '.$sizes[2].';';
        $scss .= '$h3-font-size: $font-size-base * '.$sizes[3].';';
        $scss .= '$h4-font-size: $font-size-base * '.$sizes[4].';';
        $scss .= '$h5-font-size: $font-size-base * '.$sizes[5].';';
        $scss .= '$h6-font-size: $font-size-base * '.$sizes[6].';';
    }

    return $scss;
}

/**
 * Returns the main SCSS content.
 *
 * Not always required in a child theme of Boost but here so we can add our own SCSS easily.
 *
 * @param theme_config $theme The theme config object.
 * @return string SCSS.
 */
function theme_dennis_get_main_scss_content($theme) {
    global $CFG;

    static $boosttheme = null;
    if (empty($boosttheme)) {
        $boosttheme = theme_config::load('boost'); // Needs to be the Boost theme so that we get its settings.
    }
    $scss = theme_boost_get_main_scss_content($boosttheme);

    $scss .= file_get_contents($CFG->dirroot.'/theme/dennis/scss/dennis.scss');

    return $scss;
}

/**
 * Inject additional SCSS.
 *
 * Not always required in a child theme of Boost but here so we can add our own additional SCSS easily.
 *
 * @param theme_config $theme The theme config object.
 * @return string SCSS.
 */
function theme_dennis_get_extra_scss($theme) {
    static $boosttheme = null;
    if (empty($boosttheme)) {
        $boosttheme = theme_config::load('boost'); // Needs to be the Boost theme so that we get its settings.
    }
    $scss = theme_boost_get_extra_scss($boosttheme);

    return $scss;
}
