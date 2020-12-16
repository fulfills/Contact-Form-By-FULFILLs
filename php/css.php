<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    // CSS出力

    function cfbf_add_stylesheet_to_admin() {
        global $CFBF_MAIN_SLUG;
        $ver = date('His');
        if($_GET['page'] === $CFBF_MAIN_SLUG)
            wp_enqueue_style( 'cfbf-top', plugins_url( $CFBF_MAIN_SLUG.'/css/top.css'), array(), $ver );
        if($_GET['page'] === $CFBF_MAIN_SLUG.'-edit') {
            wp_enqueue_style( 'cfbf-edit', plugins_url( $CFBF_MAIN_SLUG.'/css/edit.css'), array(), $ver );
            wp_enqueue_style( 'cfbf-design', plugins_url( $CFBF_MAIN_SLUG.'/css/cfbf-design.css'), array(), $ver );
        }
        if($_GET['page'] === $CFBF_MAIN_SLUG.'-reply') {
            if($_GET['status'] !== 'edit') wp_enqueue_style( 'cfbf-edit', plugins_url( $CFBF_MAIN_SLUG.'/css/reply-list.css'), array(), $ver );
            else wp_enqueue_style( 'cfbf-edit', plugins_url( $CFBF_MAIN_SLUG.'/css/reply-edit.css'), array(), $ver );
        }
    }
    add_action('admin_enqueue_scripts', 'cfbf_add_stylesheet_to_admin');

    function cfbf_add_stylesheet_to_public() {
        global $CFBF_MAIN_SLUG;
        $cfbfs = get_option('cfbf_edit');
        $ver = date('His');
        if(is_page($cfbfs['page_id']))
            wp_enqueue_style( 'cfbf-design', plugins_url( $CFBF_MAIN_SLUG.'/css/cfbf-design.css'), array(), $ver );
    }
    add_action('wp_enqueue_scripts', 'cfbf_add_stylesheet_to_public');