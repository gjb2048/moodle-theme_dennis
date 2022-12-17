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

use block_contents;
use block_move_target;
use coding_exception;
use html_writer;
use stdClass;

/**
 * The core renderer.
 */
class core_renderer extends \theme_boost\output\core_renderer {
    /**
     * Get the blocks in the given region, horizontal if '$blocksperrow' is greater than 0.
     *
     * @param string $region The region to get HTML for.
     * @param array $classes Wrapping tag classes.
     * @param string $tag Wrapping tag.
     * @param boolean $fakeblocksonly Include fake blocks only.
     * @param int $blocksperrow Number of blocks per row.
     * @param boolean $addblockbutton Add the 'Add a block' button.
     *
     * @return string HTML.
     */
    public function dennisblocks(
        $region,
        $classes = [],
        $tag = 'aside',
        $fakeblocksonly = false,
        $blocksperrow = 0,
        $addblockbutton = false
    ) {

        $output = '';
        $displayregion = $this->page->apply_theme_region_manipulations($region);
        $editing = $this->page->user_is_editing();
        if (($this->page->blocks->region_has_content($displayregion, $this)) || ($editing)) {
            $classes = (array)$classes;
            $classes[] = 'block-region';
            $attributes = [
                'id' => 'block-region-' . preg_replace('#[^a-zA-Z0-9_\-]+#', '-', $displayregion),
                'class' => join(' ', $classes),
                'data-blockregion' => $displayregion,
                'data-droptarget' => '1',
            ];

            $hblockscontext = new stdClass();

            $regioncontent = '';
            if ($editing) {
                if ($blocksperrow > 0) {
                    $attributes['class'] .= ' colly-container editing';
                }
                $hblockscontext->title = get_string('region-' . $region, 'theme_dennis');

                if ($addblockbutton) {
                    $hblockscontext->addblockbutton = $this->addblockbutton($region);
                    $hblockscontext->hasaddblockbutton = (!empty($hblockscontext->addblockbutton));
                }
            }
            if ($this->page->blocks->region_has_content($region, $this)) {
                if ($blocksperrow > 0) {
                    $regioncontent = $this->dennis_blocks_for_region($region, $blocksperrow, $editing, $fakeblocksonly);
                } else {
                    $regioncontent = $this->blocks_for_region($region, $fakeblocksonly);
                }
            }

            $hblockscontext->regioncontent = html_writer::tag($tag, $regioncontent, $attributes);

            $output = $this->render_from_template('theme_dennis/hblocks', $hblockscontext);
        }

        return $output;
    }

    /**
     * Output all the blocks horizontally in a particular region.
     *
     * @param string $region the name of a region on this page.
     * @param int $blocksperrow Number of blocks per row.
     * @param boolean $editing Editing?
     * @param boolean $fakeblocksonly Output fake block only.
     * @return string the HTML to be output.
     */
    protected function dennis_blocks_for_region($region, $blocksperrow, $editing, $fakeblocksonly = false) {
        $blockcontents = $this->page->blocks->get_content_for_region($region, $this);
        $output = '';

        $blockcount = count($blockcontents);
        if ($blockcount >= 1) {
            if (!$editing) {
                $output .= html_writer::start_tag('div', ['class' => 'colly-container']);
            }
            $lastblock = null;
            $zones = [];
            foreach ($blockcontents as $bc) {
                if ($bc instanceof block_contents) { // MDL-64818.
                    $zones[] = $bc->title;
                }
            }

            // When editing we want all the blocks to be the same for ease of editing.
            if (($blocksperrow > 4) || ($editing)) {
                $blocksperrow = 4; // Will result in a 'colly-4' when more than one row.
            }
            $rows = $blockcount / $blocksperrow; // Maximum blocks per row.

            if (!$editing) {
                if ($rows <= 1) {
                    $colly = $blockcount;
                    if ($colly < 1) {
                        // Should not happen but a fail safe.  Will look intentionally odd.
                        $colly = 4;
                    }
                } else {
                    $colly = $blocksperrow;
                }
            }

            $currentblockcount = 0;
            $currentrow = 0;
            $currentrequiredrow = 1;
            foreach ($blockcontents as $bc) {
                if ($bc instanceof block_contents) {
                    if ($fakeblocksonly && !$bc->is_fake()) {
                        // Skip rendering real blocks if we only want to show fake blocks.
                        continue;
                    }
                } else if ($bc instanceof block_move_target) {
                    if ($fakeblocksonly) {
                        continue;
                    }
                } else {
                    throw new coding_exception('Unexpected type of thing (' . get_class($bc) . ') found in list of block contents.');
                }

                if (!$editing) { // Fix to four columns only when editing - done in CSS.
                    $currentblockcount++;
                    if ($currentblockcount > ($currentrequiredrow * $blocksperrow)) {
                        // Tripping point.
                        $currentrequiredrow++;
                        // Break...
                        $output .= html_writer::end_tag('div');
                        $output .= html_writer::start_tag('div', ['class' => 'colly-container']);
                        // Recalculate colly if needed...
                        $remainingblocks = $blockcount - ($currentblockcount - 1);
                        if ($remainingblocks < $blocksperrow) {
                            $colly = $remainingblocks;
                            if ($colly < 1) {
                                // Should not happen but a fail safe.  Will look intentionally odd.
                                $colly = 4;
                            }
                        }
                    }

                    if ($currentrow < $currentrequiredrow) {
                        $currentrow = $currentrequiredrow;
                    }

                    $bc->attributes['class'] .= ' colly-' . $colly;
                }

                if ($bc instanceof block_contents) {
                    $output .= $this->block($bc, $region);
                    $lastblock = $bc->title;
                } else if ($bc instanceof block_move_target) {
                    $output .= $this->block_move_target($bc, $zones, $lastblock, $region);
                }
            }
            if (!$editing) {
                $output .= html_writer::end_tag('div');
            }
        }

        return $output;
    }
}
