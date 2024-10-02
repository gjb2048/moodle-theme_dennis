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

namespace theme_dennis;

use theme_config;

/**
 * Unit tests for the Dennis theme.
 * @group theme_dennis
 */
final class theme_dennis_test extends \advanced_testcase {

    /** @var class $outputus */
    protected $outputus;

    /**
     * Set up.
     */
    protected function setUp(): void {
        set_config('theme', 'dennis');
        $this->resetAfterTest(true);

        global $PAGE;
        $this->outputus = $PAGE->get_renderer('theme_dennis', 'core');
    }

    /**
     * Test drawerleftwidth.
     * @covers ::theme_dennis_get_pre_scss
     */
    public function test_drawerleftwidth(): void {
        set_config('drawerleftwidth', '150', 'theme_dennis');
        $us = theme_config::load('dennis');
        $scsspre = theme_dennis_get_pre_scss($us);

        $this->assertStringContainsString('$drawer-left-width: 150px;', $scsspre);
    }

    /**
     * Test drawerrightwidth.
     * @covers ::theme_dennis_get_pre_scss
     */
    public function test_drawerrightwidth(): void {
        set_config('drawerrightwidth', '240', 'theme_dennis');
        $us = theme_config::load('dennis');
        $scsspre = theme_dennis_get_pre_scss($us);

        $this->assertStringContainsString('$drawer-right-width: 240px;', $scsspre);
    }

    /**
     * Test image_url.
     * @covers ::image_url
     */
    public function test_pix(): void {
        global $CFG;

        $ouricon = $this->outputus->image_url('icon', 'theme');

        $this->assertEquals($CFG->wwwroot.'/theme/image.php/dennis/theme/1/icon', $ouricon->out(false));
    }
}
