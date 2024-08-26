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
require_once($CFG->dirroot . '/theme/boost/lib.php');

/**
 * Get SCSS to prepend.
 *
 * Not always required in a child theme of Boost but here so we can add our own pre SCSS easily.
 *
 * @param theme_config $theme The theme config object.
 * @return string SCSS.
 */
function theme_dennis_get_pre_scss($theme) {
    static $boosttheme = null;
    if (empty($boosttheme)) {
        $boosttheme = theme_config::load('boost'); // Needs to be the Boost theme so that we get its settings.
    }
    $scss = theme_boost_get_pre_scss($boosttheme);

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
    static $boosttheme = null;
    if (empty($boosttheme)) {
        $boosttheme = theme_config::load('boost'); // Needs to be the Boost theme so that we get its settings.
    }
    $scss = theme_boost_get_main_scss_content($boosttheme);

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

/**
 * Parses CSS before it is cached.
 *
 * This function can make alterations and replace patterns within the CSS.
 *
 * @param string $css The CSS
 * @param theme_config $theme The theme config object.
 * @return string The parsed CSS The parsed CSS.
 */
function theme_dennis_process_css($css, $theme) {

    // Set the header background image.
    $headerbackgroundimage = (empty($theme->settings->headerbackgroundimage)) ? '' :
        'background-image: url("' . $theme->setting_file_url('headerbackgroundimage', 'headerbackgroundimage') . '");';
    $css = theme_dennis_set_setting($css, '[[setting:headerbackgroundimage]]', $headerbackgroundimage);

    return $css;
}

/**
 * Adds replaces a given setting (tag) in the CSS before it is cached.
 *
 * @param string $css The original CSS.
 * @param string $tag The tag to replace.
 * @param string $customcss The custom CSS to add.
 * @return string The CSS which now contains our custom CSS.
 */
function theme_dennis_set_setting($css, $tag, $customcss) {
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 */
function theme_dennis_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = []) {
    static $theme = null;
    if (empty($theme)) {
        $theme = theme_config::load('dennis');
    }
    if ($context->contextlevel == CONTEXT_SYSTEM) {
        // By default, theme files must be cache-able by both browsers and proxies.  From 'More' theme.
        if (!array_key_exists('cacheability', $options)) {
            $options['cacheability'] = 'public';
        }
        if ($filearea === 'headerbackgroundimage') {
            return $theme->setting_file_serve('headerbackgroundimage', $args, $forcedownload, $options);
        } else {
            send_file_not_found();
        }
    } else {
        send_file_not_found();
    }
}
