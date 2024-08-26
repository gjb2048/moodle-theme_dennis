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

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $settings = new theme_boost_admin_settingspage_tabs('themesettingdennis', get_string('configtitle', 'theme_dennis'));
    $page = new admin_settingpage('theme_dennis_general', get_string('generalsettings', 'theme_boost'));

    // Header background image.
    $name = 'theme_dennis/headerbackgroundimage';
    $title = get_string('headerbackgroundimage', 'theme_dennis');
    $description = get_string('headerbackgroundimagedesc', 'theme_dennis');
    $setting = new admin_setting_configstoredfile(
        $name,
        $title,
        $description,
        'headerbackgroundimage',
        0,
        ['accepted_types' => ['jpg', 'png', 'webp']]
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Must add the page after defining all the settings.
    $settings->add($page);
}
