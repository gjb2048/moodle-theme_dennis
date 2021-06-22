define(['jquery', 'core/ajax', 'core/notification', 'core/log'],
    function($, Ajax, Notification, log) {

    log.debug('Dennis Server DateTime AMD');

    return {
        init: function(data) {
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
            log.debug('Dennis Server DateTime AMD init: ' + data.currentdatetime);
        }
    };
});
