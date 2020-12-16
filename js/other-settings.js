(function($) {
    $('input[type="submit"]').click(function(e){
        str = $('textarea[name="reply-template"]').val();
        if(str.indexOf('[CONTENT]') < 0 || str.indexOf('[URL]') < 0) {
            window.alert(cfbf_dic['Please include [CONTENT] and [URL] in Reply Email.']);
            return false;
        }
    });
})(jQuery);