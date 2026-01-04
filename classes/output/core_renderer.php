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
 * @copyright  &copy; 2022-onwards G J Barnard.
 * @author     G J Barnard - {@link https://moodle.org/user/profile.php?id=442195}
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */

namespace theme_dennis\output;

use html_writer;
use stdClass;

/**
 * The core renderer.
 */
class core_renderer extends \theme_boost\output\core_renderer {
    /**
     * Wrapper for header elements.
     *
     * @return string HTML to display the main header.
     */
    public function full_header() {
        global $USER;

        $hour = intval(userdate(time(), '%H')); // Convert UTC time to user timezone hour.

        if ($hour < 11) {
            $timeofday = get_string('morning', 'theme_dennis');
        } else if ($hour < 18) {
            $timeofday = get_string('afternoon', 'theme_dennis');
        } else {
            $timeofday = get_string('evening', 'theme_dennis');
        }
        // Note: User timestamp attributes are in UTC.
        $loggedinduration = get_string(
            'loggedin',
            'theme_dennis',
            ['duration' => gmdate(get_string('durationformat', 'theme_dennis'), time() - $USER->currentlogin)]
        );

        $pagetype = $this->page->pagetype;
        $homepage = get_home_page();
        $homepagetype = null;
        // Add a special case since /my/courses is a part of the /my subsystem.
        if ($homepage == HOMEPAGE_MY || $homepage == HOMEPAGE_MYCOURSES) {
            $homepagetype = 'my-index';
        } else if ($homepage == HOMEPAGE_SITE) {
            $homepagetype = 'site-index';
        }
        if (
            $this->page->include_region_main_settings_in_header_actions() &&
            !$this->page->blocks->is_block_present('settings')
        ) {
            // Only include the region main settings if the page has requested it and it doesn't already have
            // the settings block on it. The region main settings are included in the settings block and
            // duplicating the content causes behat failures.
            $this->page->add_header_action(html_writer::div(
                $this->region_main_settings_menu(),
                'd-print-none',
                ['id' => 'region-main-settings-menu']
            ));
        }

        $header = new stdClass();
        $header->settingsmenu = $this->context_header_settings_menu();
        $header->contextheader = $this->context_header();
        $header->hasnavbar = empty($this->page->layout_options['nonavbar']);
        $header->navbar = $this->navbar();
        $header->pageheadingbutton = $this->page_heading_button();
        $header->courseheader = $this->course_header();
        $header->headeractions = $this->page->get_header_actions();
        if (!empty($pagetype) && !empty($homepagetype) && $pagetype == $homepagetype) {
            $header->welcomemessage = \core_user::welcome_message();
        }
        $header->timeofday = $timeofday;
        $header->firstname = $USER->firstname;
        $header->loggedinduration = $loggedinduration;
        $header->hasbackgroundimage = (!empty($this->page->theme->settings->headerbackgroundimage));

        return $this->render_from_template('theme_dennis/full_header', $header);
    }

    /**
     * Get the HTML for blocks in the given region.
     *
     * @since Moodle 2.5.1 2.6
     * @param string $region The region to get HTML for.
     * @param array $classes Wrapping tag classes.
     * @param string $tag Wrapping tag.
     * @param boolean $fakeblocksonly Include fake blocks only.
     * @return string HTML.
     */
    public function blocks($region, $classes = [], $tag = 'aside', $fakeblocksonly = false) {
        $displayregion = $this->page->apply_theme_region_manipulations($region);
        $editing = $this->page->user_is_editing();
        $classes = (array)$classes;
        $classes[] = 'block-region';
        $attributes = [
            'id' => 'block-region-' . preg_replace('#[^a-zA-Z0-9_\-]+#', '-', $displayregion),
            'class' => join(' ', $classes),
            'data-blockregion' => $displayregion,
            'data-droptarget' => '1',
        ];
        $content = '';
        if ($editing) {
            $content = $this->block_region_title($region);
        }

        if ($this->page->blocks->region_has_content($displayregion, $this)) {
            $content .= html_writer::tag('h2', get_string('blocks'), ['class' => 'sr-only']) .
                $this->blocks_for_region($displayregion, $fakeblocksonly);
        } else {
            $content .= html_writer::tag('h2', get_string('blocks'), ['class' => 'sr-only']);
        }
        return html_writer::tag($tag, $content, $attributes);
    }

    /**
     * Get the HTML for block title in the given region.
     *
     * @param string $region The region to get HTML for.
     *
     * @return string HTML.
     */
    protected function block_region_title($region) {
        return html_writer::tag(
            'h2',
            get_string('region-' . $region, 'theme_dennis'),
            ['class' => 'block-region-title col-12 text-center font-italic font-weight-bold']
        );
    }
}
