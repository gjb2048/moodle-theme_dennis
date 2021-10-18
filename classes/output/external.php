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

namespace theme_dennis\output;

defined('MOODLE_INTERNAL') || die();

/**
 * Dennis theme.
 *
 * @package    theme_dennis
 * @copyright  &copy; 2020-onwards G J Barnard.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */
class external extends \core\output\external {

    /**
     * Return server datetime.
     *
     * @return string the datetime.
     */
    public static function server_datetime() {
        return array('datetime' => strftime('%d/%m/%Y %H:%M:%S'));
    }

    /**
     * Returns description of server_datetime() parameters.
     *
     * @return external_function_parameters
     */
    public static function server_datetime_parameters() {
        return new \external_function_parameters([]);
    }

    /**
     * Returns description of method result value.
     *
     * @return external_single_structure
     */
    public static function server_datetime_returns() {
        return new \external_single_structure(
                array(
                    'datetime' => new \external_value(PARAM_TEXT, 'Server datetime'),
                ), 'Server datetime');
    }
}
