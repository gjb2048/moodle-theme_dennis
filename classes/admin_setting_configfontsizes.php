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
     * Class admin_setting_configfontsizes.
     */
class admin_setting_configfontsizes extends \admin_setting_configtext {
    /**
     * Config text constructor
     *
     * @param string $name unique ascii name, either 'mysetting' for settings that in config, or 'myplugin/mysetting' for ones in
     *                     config_plugins.
     * @param string $visiblename localised
     * @param string $description long localised info
     * @param string $defaultsetting
     */
    public function __construct($name, $visiblename, $description, $defaultsetting) {
        parent::__construct($name, $visiblename, $description, $defaultsetting, PARAM_TEXT);
    }

    /**
     * Store new setting values.
     *
     * @param mixed $data string or array, must not be NULL.
     * @return string empty string if ok, string error message otherwise.
     */
    public function write_setting($data) {
        // Trim any spaces to avoid spaces at ends.
        $data = trim($data);
        if ($data === '') {
            // Override parent behaviour and set to default if empty string.
            $data = $this->get_defaultsetting();
        }
        $data = $this->decode_from_form($data);

        return parent::write_setting($data);
    }

    /**
     * Validate data before storage
     * @param string data
     * @return mixed true if ok string if error found
     */
    public function validate($data) {
        $validated = parent::validate($data); // First validate the data from a text and numbers only point of view.

        if ($validated === true) {
            $data = self::decode_from_db($data);
            // Ensure there are enough settings.
            if (count($data) != 7) {
                $validated = get_string('fontsizessizeerror', 'theme_dennis');
            } else {
                // Ensure that heading multipliers decrease.
                $index = 2;
                while (($index < 7) || ($validated != true)) {
                    $previous = $data[($index - 1)];
                    $current = $data[$index];
                    if ($current > $previous) {
                        $validated = get_string(
                            'fontsizesordererror',
                            'theme_dennis',
                            ['current' => $current, 'previous' => $previous]
                        );
                    }
                    $index++;
                }
            }
        }

        return $validated;
    }

    /**
     * Return part of form with setting.
     *
     * @param mixed $data array or string depending on setting.
     * @param string $query.
     * @return string Markup.
     */
    public function output_html($data, $query = '') {
        global $OUTPUT;
        $values = $this->encode_for_form($data);
        $default = $this->get_defaultsetting();
        $context = (object) [
            'cols' => '8',
            'rows' => '7',
            'id' => $this->get_id(),
            'name' => $this->get_full_name(),
            'value' => $values,
            'forceltr' => $this->get_force_ltr(),
            'readonly' => $this->is_readonly(),
        ];
        $element = $OUTPUT->render_from_template('theme_dennis/setting_configfontsizes', $context);

        $warning = '';

        return format_admin_setting($this, $this->visiblename, $element, $this->description, true, $warning, $default, $query);
    }

    /**
     * Decode from database.
     *
     * @param mixed $data string of sizes, comma delimited.
     * @return array Of sizes.
     */
    public static function decode_from_db($data) {
        return explode(',', $data);
    }

    /**
     * Encode for display on the settings form.
     *
     * @param mixed $data string of sizes, comma delimited.
     * @return string Of sizes.
     */
    private function encode_for_form($data) {
        return implode(PHP_EOL, self::decode_from_db($data));
    }

    /**
     * Decode from form.
     *
     * @param mixed $data string of sizes, end of line delimited.
     * @return string Of sizes, comma delimited.
     */
    private function decode_from_form($data) {
        return implode(',', explode(PHP_EOL, $data));
    }
}
