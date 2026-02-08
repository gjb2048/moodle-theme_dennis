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
    // Settings task.
    $settings = new theme_boost_admin_settingspage_tabs('themesettingdennis', get_string('configtitle', 'theme_dennis'));
    $page = new admin_settingpage('theme_dennis_general', get_string('generalsettings', 'theme_boost'));

    $name = 'theme_dennis/drawerleftwidth';
    $title = get_string('drawerleftwidth', 'theme_dennis');
    $lower = 100;
    $upper = 500;
    $description = get_string('sizesdesc', 'theme_dennis', ['lower' => $lower, 'upper' => $upper]);
    $default = 200;
    $setting = new \theme_dennis\admin_setting_configsizes($name, $title, $description, $default, $lower, $upper);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_dennis/drawerrightwidth';
    $title = get_string('drawerrightwidth', 'theme_dennis');
    $lower = 200;
    $upper = 400;
    $description = get_string('sizesdesc', 'theme_dennis', ['lower' => $lower, 'upper' => $upper]);
    $default = 300;
    $setting = new \theme_dennis\admin_setting_configsizes($name, $title, $description, $default, $lower, $upper);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Font sizes.
    $name = 'theme_dennis/fontsizes';
    $title = get_string('fontsizes', 'theme_dennis');
    $base = '1rem';
    $h1 = '2.5';
    $h2 = '2';
    $h3 = '1.75';
    $h4 = '1.5';
    $h5 = '1.25';
    $h6 = '1';
    $default = $base . PHP_EOL . $h1 . PHP_EOL . $h2 . PHP_EOL . $h3 . PHP_EOL . $h4 . PHP_EOL . $h5 . PHP_EOL . $h6;
    $description = get_string(
        'fontsizesdesc',
        'theme_dennis',
        ['base' => $base, 'h1' => $h1, 'h2' => $h2, 'h3' => $h3, 'h4' => $h4, 'h5' => $h5, 'h6' => $h6]
    );
    $setting = new \theme_dennis\admin_setting_configfontsizes($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);
}
