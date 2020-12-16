(function($) {
    var $change_p = $('ul.change-p');

    // 削除ボタン
    $('ul.change-p').on('click', 'button.delete', function(){
        $(this).parent().parent().remove();
        update_index();
        update_preview();
    });

    // 選択肢を追加
    $('ul.change-p').on('click', 'button.more-select', function(){
        var $exi = $(this).siblings('*[name$="[select][]"]');
        var $clone = $exi.last().clone().val('').attr('placeholder', cfbf_dic['Selector']+($exi.length+1));
        $exi.last().after($clone);
    });

    // 選択肢を削除
    $('ul.change-p').on('click', 'button.less-select', function(){
        var $exi = $(this).siblings('*[name$="[select][]"]');
        var len = Number($exi.length);
        if(len > 2) $exi.last().remove();
    });

    // ラジオボタンを追加
    $('ul.change-p').on('click', 'button.more-radio', function(){
        var $exi = $(this).siblings('*[name$="[radio][]"]');
        var $clone = $exi.last().clone().val('').attr('placeholder', cfbf_dic['Button']+($exi.length+1));
        $exi.last().after($clone);
    });

    // ラジオボタンを削除
    $('ul.change-p').on('click', 'button.less-radio', function(){
        var $exi = $(this).siblings('*[name$="[radio][]"]');
        var len = Number($exi.length);
        if(len > 2) $exi.last().remove();
    });

    // 入力時イベント
    $('ul.change-p').on('click keyup change', 'input', function(){
        update_preview();
    });
})(jQuery);