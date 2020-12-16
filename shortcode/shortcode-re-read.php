<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    include 'includes/notification.php';

    function cfbf_input_as_data($str, $c_email, $cfbfs_o, $post_id) {
        update_post_meta($post_id, 'is_read', 0);
        update_post_meta($post_id, 'is_reply', 0);
        // 成功した場合，DBに保存
        $timeline = get_post_meta($post_id, 'timeline', true);
        $nd = wp_date('Y-m-d H:i:s');
        $timeline[$nd]['message'] = $str;
        $timeline[$nd]['is_owner'] = 0;
        update_post_meta($post_id, 'timeline', $timeline);
        cfbf_input_as_data_notification($post_id, $cfbfs_o);  // 通知メール 送信
    }

    $c_email = '';  // 問い合わせ主のメールアドレス 読み取り用
    $r_arr = cfbf_sanitize_for_array($_POST['cfbf_reinput'], 1);
    $str = '';
    $str .= '<p class="cfbf-message">'.nl2br($cfbfs_o['re-accept-message']).'</p>';
    $str .= '<div id="cfbf">';
        $str .= '<div>'.__('The content of your inquiry', 'contact-form-by-fulfills').'</div>';
        $str = '<table class="cfbf-wrapper"><tbody>';
        $str .= '<tr>';
        $str .= '<td class="cfbf-title">'.__('Message', 'contact-form-by-fulfiis').'</td>';
        $str .= '<td class="cfbf-inputs">'.($str_t = $r_arr['message']).'</td>';
        $str .= '</tr>';
        $str .= '</tbody></table>';
    $str .= '</div>';
    cfbf_input_as_data($str_t, $c_email, $cfbfs_o, $r_arr['cfbfid']);
    return $str;