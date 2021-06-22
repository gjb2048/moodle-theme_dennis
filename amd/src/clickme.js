//
// This file is part of Adaptable theme for moodle
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
//

//
// Dennis theme.
//
// @package    theme_dennis
// @copyright  &copy; 2020-onwards G J Barnard.
// @author     G J Barnard - {@link https://moodle.org/user/profile.php?id=442195}
// @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
//

import log from 'core/log';

const clickme = () => {
    var cmb = document.getElementById('clickmebtn');
    var cmt = document.getElementById('clickmetext');
    if ((cmb !== null) && (cmt !== null)) {
        cmb.addEventListener("click", function() {
            alert(cmt.value);
        });
    } else {
        log.debug('Dennis ClickMe: No button or text box.');
    }
};

export const clickmeInit = () => {
    log.debug('Dennis ClickMe AMD');

    if (document.readyState !== 'loading') {
        log.debug("Dennis ClickMe ES6 init DOM content already loaded");
        clickme();
    } else {
        log.debug("Dennis ClickMe ES6 init JS DOM content not loaded");
        document.addEventListener('DOMContentLoaded', function () {
            log.debug("Dennis ClickMe ES6 init JS DOM content loaded");
            clickme();
        });
    }
};
