/*
* Description:
* Media uploader via WP 3.5
*
* @method void
* @param  void
* @return false
*/
(function($) {
    $(function() {

        var _custom_media = true,
            _orig_send_attachment = wp.media.editor.send.attachment;

        $(document).on('click', '.suw-button-select.button', function () {
            var send_attachment_bkp = wp.media.editor.send.attachment,
                input = $(this).prev('.suw-input-field');
            _custom_media = true;
            wp.media.editor.send.attachment = function(props, attachment){
                if ( _custom_media ) {
                    input.val(attachment.url);
                } else {
                    return _orig_send_attachment.apply( this, [props, attachment] );
                };
            }
            wp.media.editor.open( $(this) );
            return false;
        });

    });
})(jQuery);
