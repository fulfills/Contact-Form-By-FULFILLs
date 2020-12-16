<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    // 関数 - メッセージ
    function cfbf_reply_message($c_message, $post_id) {
        $cfbfs = get_option('cfbf_edit');
        $cfbfs_o = get_option('cfbf_other');
        if($temp = $cfbfs_o['reply-template']);
        else $temp = str_replace('&NewLine;', "\n", __('[CONTENT]&NewLine;-----&NewLine;&NewLine;To reply to this e-mail, please visit the following URL.&NewLine;[URL]&NewLine;&NewLine;Sorry, but if you reply to this email directly, we will not receive it.', 'contact-form-by-fulfills'));
        $temp = str_replace('[CONTENT]', $c_message, $temp);
        $temp = str_replace('[URL]', get_page_link($cfbfs['page_id']).'?cfbfid='.$post_id.'&auth1='.get_post_meta($post_id, 'cfbf1', true).'&auth2='.get_post_meta($post_id, 'cfbf2', true), $temp);
        return $temp;
    }

    // メールを送信
    $post_id = cfbf_sanitize_for_array($_GET['post_id']);
    $c_email = get_post_meta($post_id, 'c_email', true);
    $c_subject = cfbf_sanitize_for_array($_POST['replysubject'] ? : __('Answer to your inquiry.', 'contact-form-by-fulfills'));
    $c_message = cfbf_sanitize_for_array($_POST['replymessage'], 1);
    $headers = 'From: '.get_option('cfbf_other')['sender-name'].' <wordpress@'.$_SERVER['SERVER_NAME'].'>'."\r\n";
    if(wp_mail($c_email, $c_subject, cfbf_reply_message($c_message, $post_id), $headers)) {
        // 成功した場合，DBに保存
        if(!empty($i = get_post_meta($post_id, 'timeline', true))) $timeline = $i;
        else $timeline = array();
        $nd = wp_date('Y-m-d H:i:s');
        $timeline[$nd]['message'] = $c_message;
        $timeline[$nd]['is_owner'] = 1;
        update_post_meta($post_id, 'timeline', $timeline);
        update_post_meta($post_id, 'is_reply', 1);
        echo '<div class="notice notice-success settings-error is-dismissible"><p><strong>'.__('Successfully sent.', 'contact-form-by-fulfills').'</strong></p></div>';
    }
    else {
        echo '<div class="notice notice-success settings-error is-dismissible"><p><strong>'.__('Transmission failed.', 'contact-form-by-fulfills').'</strong></p></div>';
    }