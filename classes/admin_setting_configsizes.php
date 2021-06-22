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
 * @copyright  &copy; 2021-onwards G J Barnard.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */

namespace theme_dennis;

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot . '/lib/adminlib.php');

/**
 * Class admin_setting_configsizes.
 */
class admin_setting_configsizes extends \admin_setting_configtext {
    /**
     * @var int Lower range point.
     */
    private $lower;

    /**
     * @var int Upper range point.
     */
    private $upper;

    /**
     * Config text constructor
     *
     * @param string $name unique ascii name, either 'mysetting' for settings that in config, or 'myplugin/mysetting' for ones in
     *                     config_plugins.
     * @param string $visiblename localised
     * @param string $description long localised info
     * @param string $defaultsetting
     * @param int $lower Lower range point.
     * @param int $upper Upper range point.
     */
    public function __construct($name, $visiblename, $description, $defaultsetting, $lower, $upper) {
        $this->lower = $lower;
        $this->upper = $upper;
        parent::__construct($name, $visiblename, $description, $defaultsetting, PARAM_INT);
    }

    /**
     * Validate data before storage
     * @param string data
     * @return mixed true if ok string if error found
     */
    public function validate($data) {
        $validated = parent::validate($data); // First validate the data from a text and numbers only point of view.

        if (
            ($validated === true) &&
            ($data < $this->lower) || ($data > $this->upper)
        ) {
            $validated = get_string(
                'sizeserror',
                'theme_dennis',
                ['setting' => $data, 'lower' => $this->lower, 'upper' => $this->upper]
            );
        }

        return $validated;
    }
}
