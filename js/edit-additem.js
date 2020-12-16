(function($) {
    var $change_p = $('ul.change-p');

    /*
        各アイテムパーツ START
    */
    function output_input_type(nam, i) {
        var str = '<input type="hidden" name="form['+i+'][type]" value="'+nam+'">';
        if($change_p.children().length == 0)
            str += '<input type="hidden" name="form['+i+'][id]" value="0">';
        else {
            var ids = [];
            $change_p.find('*[name$="[id]"]').each(function(){
                ids.push(Number($(this).val()));
            });
            str += '<input type="hidden" name="form['+i+'][id]" value="'+(Math.max.apply(null, ids)+1)+'">';
        }
        return str;
    }

    function output_input_text(i) {
        var str = '<input type="text" name="form['+i+'][title]" value="" placeholder="'+cfbf_dic['Item Name']+'（例：氏名）">';
        str += '<label><input type="checkbox" name="form['+i+'][req]" value="1"> '+cfbf_dic['Required Field']+'</label>';
        return str;
    }

    function output_input_textarea(i) {
        var str = '<input type="text" name="form['+i+'][title]" value="" placeholder="'+cfbf_dic['Item Name']+'（例：お問い合わせ内容）">';
        str += '<label><input type="checkbox" name="form['+i+'][req]" value="1"> '+cfbf_dic['Required Field']+'</label>';
        return str;
    }

    function output_input_email(i) {
        var str = '<input type="text" name="form['+i+'][title]" value="" placeholder="'+cfbf_dic['Item Name']+'（例：メールアドレス）">';
        str += '<label><input type="checkbox" name="form['+i+'][req]" value="1"> '+cfbf_dic['Required Field']+'</label>';
        return str;
    }

    function output_input_tel(i) {
        var str = '<input type="text" name="form['+i+'][title]" value="" placeholder="'+cfbf_dic['Item Name']+'（例：携帯番号）">';
        str += '<label><input type="checkbox" name="form['+i+'][req]" value="1"> '+cfbf_dic['Required Field']+'</label>';
        return str;
    }

    function output_input_address(i) {
        var str = '<input type="text" name="form['+i+'][title]" value="" placeholder="'+cfbf_dic['Item Name']+'（例：住所）">';
        str += '<label><input type="checkbox" name="form['+i+'][req]" value="1"> '+cfbf_dic['Required Field']+'</label>';
        return str;
    }

    function output_input_radio(i) {
        var str = '<input type="text" name="form['+i+'][title]" value="" placeholder="'+cfbf_dic['Item Name']+'（例：お問い合わせ種別）">';
        str += '<input type="text" name="form['+i+'][radio][]" value="" placeholder="'+cfbf_dic['Button']+'1（例：質問）">';
        str += '<input type="text" name="form['+i+'][radio][]" value="" placeholder="'+cfbf_dic['Button']+'2（例：要望）">';
        str += '<label><input type="checkbox" name="form['+i+'][req]" value="1"> '+cfbf_dic['Required Field']+'</label>';
        str += '<button type="button" class="more-radio">'+cfbf_dic['Add a button']+'</button>';
        str += '<button type="button" class="less-radio">'+cfbf_dic['Remove last button']+'</button>';
    return str;
    }

    function output_input_check(i) {
        var str = '<input type="text" name="form['+i+'][title]" value="" placeholder="'+cfbf_dic['Item Name']+'（例：確認）">';
        str += '<input type="text" name="form['+i+'][check][]" value="" placeholder="'+cfbf_dic['Check Message']+'（例：同意します）">';
        str += '<label><input type="checkbox" name="form['+i+'][req]" value="1"> '+cfbf_dic['Required Field']+'</label>';
    return str;
    }

    function output_input_select(i) {
        var str = '<input type="text" name="form['+i+'][title]" value="" placeholder="'+cfbf_dic['Item Name']+'（例：性別）">';
        str += '<input type="text" name="form['+i+'][select][]" value="" placeholder="'+cfbf_dic['Selector']+'1（例：男性）">';
        str += '<input type="text" name="form['+i+'][select][]" value="" placeholder="'+cfbf_dic['Selector']+'2（例：女性）">';
        str += '<button type="button" class="more-select">'+cfbf_dic['Add a selector']+'</button>';
        str += '<button type="button" class="less-select">'+cfbf_dic['Remove last selector']+'</button>';
        return str;
    }
    /*
        各アイテムパーツ END
    */

    // 項目追加
    $('.form-items .buttons button').click(function(){
        var this_name = $(this).attr('name');
        var i = $change_p.children().length;
        var str = '<li class="'+this_name+'"><div>';
        str += '<button type="button" class="delete">'+cfbf_dic['Delete']+'</button>';
        str += '<div class="float">'+$(this).text().replace('+ ', '')+'</div>'
        str += output_input_type(this_name, i);
        if(this_name === 'text') str += output_input_text(i);
        else if(this_name === 'textarea') str += output_input_textarea(i);
        else if(this_name === 'email') str += output_input_email(i);
        else if(this_name === 'tel') str += output_input_tel(i);
        else if(this_name === 'address') str += output_input_address(i);
        else if(this_name === 'radio') str += output_input_radio(i);
        else if(this_name === 'check') str += output_input_check(i);
        else if(this_name === 'select') str += output_input_select(i);
        str += '</div></li>';
        $change_p.append(str);
        update_preview();    // ロード処理
        return false;
    });

})(jQuery);