<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    function cfbf_inputpage_elem_html($arr, $i){
        if($arr['type'] === 'text') 
            return '<input type="text" name="cfbf_input['.$i.']" value="" size="50" '.($arr['req'] ? 'required' : '').'>';
        if($arr['type'] === 'textarea') 
            return '<textarea name="cfbf_input['.$i.']" cols="50" rows="5" '.($arr['req'] ? 'required' : '').'></textarea>';
        if($arr['type'] === 'email') 
            return '<input type="email" name="cfbf_input['.$i.']" value="" size="50" '.($arr['req'] ? 'required' : '').'>';
        if($arr['type'] === 'tel') 
            return '<input type="tel" name="cfbf_input['.$i.']" value="" size="50" '.($arr['req'] ? 'required' : '').'>';
        if($arr['type'] === 'address') return '
            <input type="text" name="cfbf_input['.$i.'][]" value="" placeholder="郵便番号" size="50" '.($arr['req'] ? 'required' : '').'>
            <input type="text" name="cfbf_input['.$i.'][]" value="" placeholder="都道府県" size="50" '.($arr['req'] ? 'required' : '').'>
            <input type="text" name="cfbf_input['.$i.'][]" value="" placeholder="市区町村番地" size="50" '.($arr['req'] ? 'required' : '').'>
            <input type="text" name="cfbf_input['.$i.'][]" value="" placeholder="マンション・ビル名" size="50">
        ';
        $str = '';
        if($arr['type'] === 'radio') {
            foreach($arr['radio'] as $key => $val)
                $str .= '<label><input type="radio" name="cfbf_input['.$i.']" value="'.$key.'" '.($arr['req'] ? 'required' : '').'>'.$val.'</label>';
            return $str;
        }
        if($arr['type'] === 'check') {
            foreach($arr['check'] as $key => $val)
                $str .= '<label><input type="checkbox" name="cfbf_input['.$i.'][]" value="0" '.($arr['req'] ? 'required' : '').'>'.$val.'</label>';
            return $str;
        }
        if($arr['type'] === 'select') {
            $str .= '<select name="cfbf_input['.$i.']">';
            foreach($arr['select'] as $key => $val)
                $str .= '<option value="'.$key.'">'.$val.'</option>';
            $str .= '</select>';
        }
        return $str;
    }

    $str = '';
    $str .= '<p class="cfbf-message">'.nl2br($cfbfs_o['top-message']).'</p>';
    $str .= '<div id="cfbf"><form method="POST"><table class="cfbf-wrapper"><tbody>';
    foreach($cfbfs['form'] as $key => $val) {
        $str .= '<tr>';
        $str .= '<td class="cfbf-title">'.$val['title'].($val['req'] ? '<span class="req">'.__('Required', 'contact-form-by-fulfills').'</span>' : '').'</td>';
        $str .= '<td class="cfbf-inputs">'.cfbf_inputpage_elem_html($val, $key, true, false).'</td>';
        $str .= '</tr>';
    }
    $str .= '</tbody></table>'.wp_nonce_field('cfbf_form', 'cfbf_input[nonce]').'<input type="submit" value="'.__('SEND').'">';
    if(($sitekey = $cfbfs_o['site-key']) && $cfbfs_o['secret-key']) {
        $str .= '
            <script src="https://www.google.com/recaptcha/api.js?render='.$sitekey.'"></script>
            <script>
                grecaptcha.ready(function() {
                    grecaptcha.execute("'.$sitekey.'", {action: "homepage"}).then(function(token) {
                        var recaptchaResponse = document.getElementById("recaptchaResponse");
                            recaptchaResponse.value = token;
                    });
                });
            </script>
        ';
        $str .= '<input type="hidden" name="recaptchaResponse" id="recaptchaResponse" />';
    }
    $str .= '</form></div>';
    return $str;