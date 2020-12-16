<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    include 'includes/notification.php';

    function cfbf_readpage_elem_html($inpu, $sett, &$c_email){
        if($sett['type'] === 'text') 
            return esc_html($inpu);
        if($sett['type'] === 'textarea') 
            return nl2br($inpu);
        if($sett['type'] === 'email') {
            if(!$c_email) $c_email = sanitize_email($inpu);
            return sanitize_email($inpu);
        }
        if($sett['type'] === 'tel') 
            return esc_html($inpu);
        $str = '';
        if($sett['type'] === 'address') {
            $str .= '郵便番号：'.esc_html($inpu[0]).'<br>';
            $str .= '都道府県：'.esc_html($inpu[1]).'<br>';
            $str .= '市区町村番地：'.esc_html($inpu[2]).'<br>';
            $str .= 'マンション・ビル名：'.esc_html($inpu[3]);
            return $str;
        }
        if($sett['type'] === 'radio') {
            return esc_html($sett['radio'][$inpu]);
        }
        if($sett['type'] === 'check') {
            foreach($inpu as $key => $val)
                $str .= '<div>'.esc_html($sett['check'][$val]).'</div>';
        }
        if($sett['type'] === 'select') {
            return esc_html($sett['select'][$inpu]);
        }
        return $str;
    }

    function cfbf_input_as_data($str, $c_email, $cfbfs_o) {
        $my_post = array(
            'post_title'    => '',
            'post_content'  => $str,
            'post_status'   => 'draft',
            'post_type' => 'cfbf',
            'post_author'   => 1,
            'post_category' => array(),
        );
        $post_id = wp_insert_post( $my_post );
        if($post_id) {
            update_post_meta($post_id, 'is_read', 0);
            update_post_meta($post_id, 'is_reply', 0);
            update_post_meta($post_id, 'cfbf1', hash('ripemd160', date('YmdHis')));
            update_post_meta($post_id, 'cfbf2', substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 8));
            update_post_meta($post_id, 'c_email', $c_email);
        }
        cfbf_input_as_data_notification($post_id, $cfbfs_o);  // 通知メール 送信
    }

    $c_email = '';  // 問い合わせ主のメールアドレス 読み取り用
    $r_arr = cfbf_sanitize_for_array($_POST['cfbf_input'], 1);
    $str = '';
    $str .= '<p class="cfbf-message">'.nl2br($cfbfs_o['accept-message']).'</p>';
    $str .= '<div id="cfbf">';
        $str .= '<div>'.__('The content of your inquiry', 'contact-form-by-fulfills').'</div>';
        $str_t = '<table class="cfbf-wrapper"><tbody>';
        foreach($cfbfs['form'] as $key => $val) {
            $str_t .= '<tr>';
            $str_t .= '<td class="cfbf-title">'.$val['title'].'</td>';
            if(isset($r_arr[$key])) $str_t .= '<td class="cfbf-inputs">'.cfbf_readpage_elem_html($r_arr[$key], $val, $c_email).'</td>';
            else $str_t .= '<td class="cfbf-inputs">'.__('Not Selected.', 'contact-form-by-fulfills').'</td>';
            $str_t .= '</tr>';
        }
        $str_t .= '</tbody></table>';
        $str .= $str_t;
    $str .= '</div>';
    cfbf_input_as_data($str_t, $c_email, $cfbfs_o);
    return $str;