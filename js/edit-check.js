(function($) {
    var $change_p = $('ul.change-p');

    // 保存ボタンクリック時チェック
    $('form.wrap').on('click', 'input[type="submit"]', function(e){
        console.log($(this));
        if($change_p.children('.email').length == 0) {
            window.alert(cfbf_dic['There must be at least one email address field.']);
            return false;
        }
    });

})(jQuery);