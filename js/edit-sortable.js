// 添字を更新
function update_index(){
    (function($) {
        var $change_p = $('ul.change-p');

        var i = 0;
        $change_p.children().each(function(){
            $(this).find('input').each(function(){
                var str = $(this).attr('name');
                $(this).attr('name', str.replace(/form\[([0-9]*)\]/, 'form['+i+']'));
            });
            i++;
        });

        // メール項目確認メッセージ
        i = 0;
        $('*[name$="[type]"][value="email"]').each(function(){
            if(i++ == 0) $(this).prev().html(cfbf_dic['EMAIL ADDRESS']+'（Notice: '+cfbf_dic['This value is the return address of the plugin.']+'）');
            else $(this).prev().html(cfbf_dic['EMAIL ADDRESS']);
        });
    })(jQuery);
}

(function($) {
    var $change_p = $('ul.change-p');

    // 項目順序変更イベント
    $change_p.sortable({
        "update": function(){
            update_index();
            update_preview();
        }
    });

})(jQuery);