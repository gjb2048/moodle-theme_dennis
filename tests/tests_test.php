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

/**
 * Core renderer unit tests for the Dennis theme.
 * @group theme_dennis
 */

defined('MOODLE_INTERNAL') || die();

class theme_dennis_tests_testcase extends advanced_testcase {

    protected $outputus;

    protected function setUp(): void {
        set_config('theme', 'dennis');
        $this->resetAfterTest(true);

        global $PAGE;
        $this->outputus = $PAGE->get_renderer('theme_dennis', 'core');
    }

    public function test_withcustomcss() {
        set_config('customcss', '.test { color: #fab; }', 'theme_dennis');
        $us = theme_config::load('dennis');
        $ourcustomcss = '[[setting:customcss]]';
        $ourcustomcss = theme_dennis_process_css($ourcustomcss, $us);

        $this->assertEquals('.test { color: #fab; }', $ourcustomcss);
    }

    public function test_withoutcustomcss() {
        set_config('customcss', '', 'theme_dennis');
        $us = theme_config::load('dennis');
        $ourcustomcss = '[[setting:customcss]]';
        $ourcustomcss = theme_dennis_process_css($ourcustomcss, $us);

        $this->assertEquals('', $ourcustomcss);
    }

    public function test_pix() {
        global $CFG;

        $ouricon = $this->outputus->image_url('icon', 'theme');

        $this->assertEquals($CFG->wwwroot.'/theme/image.php/_s/dennis/theme/1/icon', $ouricon->out(false));
    }
}