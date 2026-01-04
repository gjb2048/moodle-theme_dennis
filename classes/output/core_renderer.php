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

/**
 * The core renderer.
 */
class core_renderer extends \theme_boost\output\core_renderer {
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
