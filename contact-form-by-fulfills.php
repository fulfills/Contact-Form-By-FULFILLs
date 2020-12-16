<?php
/*
Plugin Name: Contact Form By FULFILLs
Plugin URI: https://fulfills.jp/
Description: This is an all-in-one plug-in that allows you to not only set up an contact form, but also receive and reply to messages. Easily and Quickly.
Author: FULFILLs
Author URI: https://fulfills.jp/
Domain Path: /languages/
Version: 1.1.0
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$CFBF_MAIN_SLUG = 'contact-form-by-fulfills';

function cfbf_sanitize_for_array($obj, $is_textarea = 0) {
    if(is_array($obj)) {
        foreach($obj as $key => $val) $obj[$key] = cfbf_sanitize_for_array($val, $is_textarea);
        return $obj;
    }
    if($is_textarea) return sanitize_textarea_field($obj);
    return sanitize_text_field($obj);
}

load_plugin_textdomain('contact-form-by-fulfills');

// About Function
include 'pages/about/about.php';

// Inbox Function
include 'pages/inbox/inbox.php';

// Form Settings Function
include 'pages/form-settings/edit.php';

// Other Settings Function
include 'pages/other-settings/edit.php';

// CSS出力
include 'php/css.php';

// JS出力
include 'php/js.php';

// ショートコード 出力
include 'shortcode/shortcode.php';

// 投稿タイプ
include 'php/post_type.php';

// Add Admin Bar Menu
include 'php/admin-bar.php';

function cfbf_add_pages() {
    global $CFBF_MAIN_SLUG;
    $c = count(get_posts(array(
        'post_type' => 'cfbf',
        'post_status' => 'draft',
        'meta_key' => 'is_read',
        'meta_value' => 0,
    )));
    $c = (($c != 0) ? ' <span class="update-plugins">'.$c.'</span>' : '');  // 受信数
    $cfbfs_cap = (get_option('cfbf_other')['permission-author'] ? 'publish_posts' : 'edit_pages');  // ページ表示権限
    add_menu_page( 'page_title', __('Contact Form', 'contact-form-by-fulfills').$c, $cfbfs_cap, $CFBF_MAIN_SLUG, 'cfbf_add_toppage', 'dashicons-email-alt', 8);
    add_submenu_page( $CFBF_MAIN_SLUG, __('About Us'), __('About Us'), $cfbfs_cap, $CFBF_MAIN_SLUG, 'cfbf_add_toppage' );
    add_submenu_page( $CFBF_MAIN_SLUG, __('Inbox', 'contact-form-by-fulfills'), __('Inbox', 'contact-form-by-fulfills').$c, $cfbfs_cap, $CFBF_MAIN_SLUG.'-reply', 'cfbf_add_replypage' );
    add_submenu_page( $CFBF_MAIN_SLUG, __('Form Setting', 'contact-form-by-fulfills'), __('Form Settings', 'contact-form-by-fulfills'), 'edit_pages', $CFBF_MAIN_SLUG.'-edit', 'cfbf_add_editpage' );
    add_submenu_page( $CFBF_MAIN_SLUG, __('Other Setting', 'contact-form-by-fulfills'), __('Other Settings', 'contact-form-by-fulfills'), 'edit_pages', $CFBF_MAIN_SLUG.'-other', 'cfbf_add_otherpage' );
}
add_action('admin_menu', 'cfbf_add_pages');