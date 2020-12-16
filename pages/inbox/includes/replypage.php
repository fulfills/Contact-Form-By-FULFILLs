<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    if($_POST['replymessage']) include 'sent.php';
    $str = '';
    $post_id = cfbf_sanitize_for_array($_GET['post_id']);
    update_post_meta($post_id, 'is_read', 1);
    // print_r(get_post_meta($post_id));
    $str .= '<div class="wrap">';
        $str .= '<h1 class="wp-heading-inline">'.__('Inbox', 'contact-form-by-fulfills').' - Contact Form By FULFILLs</h1>';
        $str .= '<div><a class="button button-primary" href="admin.php?page=contact-form-by-fulfills-reply">'.__('Back').'</a></div>';
        $str .= '<div class="left">';
            $str .= '<div class="title"><i>Customer</i> （'.get_the_date('Y-m-d H:m:s', $post_id).'）</div>';
            $str .= '<div class="content">'.get_post($post_id)->post_content.'</div>';
        $str .= '</div>';
        foreach(get_post_meta($_GET['post_id'], 'timeline', true) as $date => $arr) {
            $str .= '<div class="'.((int)$arr['is_owner'] ? 'right' : 'left').'">';
                $str .= '<div class="title"><i>'.((int)$arr['is_owner'] ? 'You' : 'Customer').'</i> （'.$date.'）</div>';
                $str .= '<div class="content">'.nl2br($arr['message']).'</div>';
            $str .= '</div>';
        }
        $str .= '<div class="right">';
            $str .= '<form method="POST">';
                $str .= '<div class="title"><i>'.__('Reply to '.get_post_meta($post_id, 'c_email', true), 'contact-form-by-fulfills').'</i></div>';
                $str .= '<input type="text" name="replysubject" value="" placeholder="'.__('Subject').'" required>';
                $str .= '<textarea name="replymessage" placeholder="'.__('Main message', 'contact-form-by-fulfills').'" required></textarea>';
                $str .= '<input type="submit" value="'.__('Reply').'" class="button button-primary">';
            $str .= '</form>';
        $str .= '</div>';
    $str .= '</div>';
    echo $str;