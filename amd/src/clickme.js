import $ from 'jquery';
import log from 'core/log';

export const clickme = () => {
    log.debug('Dennis ClickMe AMD');

    $(document).ready(function() {
        var cmb = $('#clickmebtn');
        if (cmb.length) {
                var cmt = $('#clickmetext');
                cmb.click(function() {
                alert(cmt.val());
            });
        } else {
            log.debug('Dennis ClickMe: No button.');
        }
    });
};
