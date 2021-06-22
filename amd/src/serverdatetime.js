import $ from 'jquery';
import Ajax from 'core/ajax';
import log from 'core/log';
import Notification from 'core/notification';

export const serverdatetime = (data) => {
    log.debug('Dennis Server DateTime AMD: ' + data.currentdatetime);

    $(document).ready(function() {
        var sdtb = $('#serverdatetimebtn');
        if (sdtb.length) {
            var tsdt = $('#theserverdatetime');
            sdtb.click(function() {
            Ajax.call([{
                methodname: 'theme_dennis_server_datetime',
                args: []
                }])[0].done(function(response) {
                    log.debug('Dennis Server DateTime: ' + response.datetime);
                    // We have the data now update the UI.
                    tsdt.text(response.datetime);
                }).fail(function(ex) {
                    Notification.exception(new Error('Dennis Server DateTime request failed: ' +
                    ex.errorcode + ' - ' + ex.error + ' - ' + ex.debuginfo + ' - ' + ex.stacktrace));
                    return;
                });
            });
        } else {
            log.debug('Dennis Server DateTime: No button.');
        }
    });
};
