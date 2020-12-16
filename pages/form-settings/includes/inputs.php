<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    ##### INPUT 出力関係 START #####
    function cfbf_output_input_text($arr, $i) {
        $str = '<input type="text" name="form['.$i.'][title]" value="'.$arr['title'].'" placeholder="'.__('Item Name', 'contact-form-by-fulfills').'（例：氏名）">';
        $str .= '<label><input type="checkbox" name="form['.$i.'][req]" value="1" '.($arr['req'] ? 'checked' : '').'> '.__('Required Field', 'contact-form-by-fulfills').'</label>';
        return $str;
    }

    function cfbf_output_input_textarea($arr, $i) {
        $str = '<input type="text" name="form['.$i.'][title]" value="'.$arr['title'].'" placeholder="'.__('Item Name', 'contact-form-by-fulfills').'（例：お問い合わせ内容）">';
        $str .= '<label><input type="checkbox" name="form['.$i.'][req]" value="1" '.($arr['req'] ? 'checked' : '').'> '.__('Required Field', 'contact-form-by-fulfills').'</label>';
        return $str;
    }

    function cfbf_output_input_email($arr, $i) {
        $str = '<input type="text" name="form['.$i.'][title]" value="'.$arr['title'].'" placeholder="'.__('Item Name', 'contact-form-by-fulfills').'（例：メールアドレス）">';
        $str .= '<label><input type="checkbox" name="form['.$i.'][req]" value="1" '.($arr['req'] ? 'checked' : '').'> '.__('Required Field', 'contact-form-by-fulfills').'</label>';
        return $str;
    }

    function cfbf_output_input_tel($arr, $i) {
        $str = '<input type="text" name="form['.$i.'][title]" value="'.$arr['title'].'" placeholder="'.__('Item Name', 'contact-form-by-fulfills').'（例：携帯番号）">';
        $str .= '<label><input type="checkbox" name="form['.$i.'][req]" value="1" '.($arr['req'] ? 'checked' : '').'> '.__('Required Field', 'contact-form-by-fulfills').'</label>';
        return $str;
    }

    function cfbf_output_input_address($arr, $i) {
        $str = '<input type="text" name="form['.$i.'][title]" value="'.$arr['title'].'" placeholder="'.__('Item Name', 'contact-form-by-fulfills').'（例：住所）">';
        $str .= '<label><input type="checkbox" name="form['.$i.'][req]" value="1" '.($arr['req'] ? 'checked' : '').'> '.__('Required Field', 'contact-form-by-fulfills').'</label>';
        return $str;
    }

    function cfbf_output_input_radio($arr, $i) {
        $str = '<input type="text" name="form['.$i.'][title]" value="'.$arr['title'].'" placeholder="'.__('Item Name', 'contact-form-by-fulfills').'（例：お問い合わせ種別）">';
        foreach($arr['radio'] as $key => $val)
            $str .= '<input type="text" name="form['.$i.'][radio][]" value="'.$val.'" placeholder="'.__('Button', 'contact-form-by-fulfills').($key+1).'">';
        $str .= '<label><input type="checkbox" name="form['.$i.'][req]" value="1" '.($arr['req'] ? 'checked' : '').'> '.__('Required Field', 'contact-form-by-fulfills').'</label>';
        $str .= '<button type="button" class="more-radio">'.__('Add a button', 'contact-form-by-fulfills').'</button>';
        $str .= '<button type="button" class="less-radio">'.__('Remove last button', 'contact-form-by-fulfills').'</button>';
        return $str;
    }

    function cfbf_output_input_check($arr, $i) {
        $str = '<input type="text" name="form['.$i.'][title]" value="'.$arr['title'].'" placeholder="'.__('Item Name', 'contact-form-by-fulfills').'（例：確認）">';
        foreach($arr['check'] as $key => $val)
            $str .= '<input type="text" name="form['.$i.'][check][]" value="'.$val.'" placeholder="'.__('Check Message', 'contact-form-by-fulfills').'（例：同意します）">';
        $str .= '<label><input type="checkbox" name="form['.$i.'][req]" value="1" '.($arr['req'] ? 'checked' : '').'> '.__('Required Field', 'contact-form-by-fulfills').'</label>';
        return $str;
    }

    function cfbf_output_input_select($arr, $i) {
        $str = '<input type="text" name="form['.$i.'][title]" value="'.$arr['title'].'" placeholder="'.__('Item Name', 'contact-form-by-fulfills').'（例：性別）">';
        foreach($arr['select'] as $key => $val)
            $str .= '<input type="text" name="form['.$i.'][select][]" value="'.$val.'" placeholder="'.__('Selector', 'contact-form-by-fulfills').($key+1).'">';
        $str .= '<button type="button" class="more-select">'.__('Add a selector', 'contact-form-by-fulfills').'</button>';
        $str .= '<button type="button" class="less-select">'.__('Remove last selector', 'contact-form-by-fulfills').'</button>';
        return $str;
    }

    function cfbf_return_my_inputs($cfbfs, $b_array) {
        $str = '';
        foreach($cfbfs['form'] as $key => $val) {
            $str .= '<li class="'.$val['type'].'"><div>';
            $str .= '<button type="button" class="delete">'.__('Delete', 'contact-form-by-fulfills').'</button>';
            $str .= '<div class="float">'.$b_array[$val['type']].'</div>';
            $str .= '<input type="hidden" name="form['.$key.'][type]" value="'.$val['type'].'">';
            $str .= '<input type="hidden" name="form['.$key.'][id]" value="'.$val['id'].'">';
            if($val['type'] === 'text') $str .= cfbf_output_input_text($val, $key);
            else if($val['type'] === 'textarea') $str .= cfbf_output_input_textarea($val, $key);
            else if($val['type'] === 'email') $str .= cfbf_output_input_email($val, $key);
            else if($val['type'] === 'tel') $str .= cfbf_output_input_tel($val, $key);
            else if($val['type'] === 'address') $str .= cfbf_output_input_address($val, $key);
            else if($val['type'] === 'radio') $str .= cfbf_output_input_radio($val, $key);
            else if($val['type'] === 'check') $str .= cfbf_output_input_check($val, $key);
            else if($val['type'] === 'select') $str .= cfbf_output_input_select($val, $key);
            $str .= '</div></li>';
        }
        return $str;
    }
    ##### INPUT 出力関係 FINISH #####
    
    return cfbf_return_my_inputs($cfbfs, $b_array);