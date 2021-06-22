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

import Ajax from 'core/ajax';
import log from 'core/log';
import Notification from 'core/notification';

const serverdatetime = () => {
    var sdtb = document.getElementById('serverdatetimebtn');
    var tsdt = document.getElementById('theserverdatetime');

    if ((sdtb !== null) && (tsdt !== null)) {
        sdtb.addEventListener("click", function() {
            Ajax.call(
                [{
                    methodname: 'theme_dennis_server_datetime',
                    args: []
                }])[0].done(function(response) {
                    log.debug('Dennis Server DateTime: ' + response.datetime);
                    // We have the data now update the UI.
                    tsdt.innerHTML = response.datetime;
                }).fail(function(ex) {
                    Notification.exception(new Error('Dennis Server DateTime request failed: ' +
                    ex.errorcode + ' - ' + ex.error + ' - ' + ex.debuginfo + ' - ' + ex.stacktrace));
                    return;
                }
            );
        });
    } else {
        log.debug('Dennis ServerDateTime: No button on text box.');
    }
};

export const serverdatetimeInit = (currentdatetime) => {
    log.debug('Dennis ServerDateTime AMD: ' + currentdatetime);

    if (document.readyState !== 'loading') {
        log.debug("Dennis ServerDateTime ES6 init DOM content already loaded");
        serverdatetime();
    } else {
        log.debug("Dennis ServerDateTime ES6 init JS DOM content not loaded");
        document.addEventListener('DOMContentLoaded', function () {
            log.debug("Dennis ServerDateTime ES6 init JS DOM content loaded");
            serverdatetime();
        });
    }
};
