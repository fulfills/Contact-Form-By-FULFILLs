<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    // フォーム編集 ページ
    if($_GET['page'] === $CFBF_MAIN_SLUG.'-edit') {
        function cfbf_add_scripts_to_admin() {
            global $CFBF_MAIN_SLUG;
            // $ver = date('His');
            $ver = false;
            wp_enqueue_script( 'jquery-ui-sortable' );
            wp_enqueue_script( 'cfbf-edit-preview', plugins_url( $CFBF_MAIN_SLUG.'/js/edit-preview.js'), array(), $ver, true );
            wp_enqueue_script( 'cfbf-edit-additem', plugins_url( $CFBF_MAIN_SLUG.'/js/edit-additem.js'), array(), $ver, true );
            wp_enqueue_script( 'cfbf-edit-sortable', plugins_url( $CFBF_MAIN_SLUG.'/js/edit-sortable.js'), array(), $ver, true );
            wp_enqueue_script( 'cfbf-edit-change', plugins_url( $CFBF_MAIN_SLUG.'/js/edit-change.js'), array(), $ver, true );
            wp_enqueue_script( 'cfbf-edit-check', plugins_url( $CFBF_MAIN_SLUG.'/js/edit-check.js'), array(), $ver, true );
            
        }
        add_action('admin_enqueue_scripts', 'cfbf_add_scripts_to_admin');

        // JS用 辞書
        include 'js-dictionary.php';
        add_action( 'admin_head', 'cfbf_add_js_dictionary' );
    }
    elseif($_GET['page'] === $CFBF_MAIN_SLUG.'-other') {
        function cfbf_add_scripts_to_admin() {
            global $CFBF_MAIN_SLUG;
            $ver = date('His');
            wp_enqueue_script( 'cfbf-edit-other-settings', plugins_url( $CFBF_MAIN_SLUG.'/js/other-settings.js'), array(), $ver, true );
        }
        add_action('admin_enqueue_scripts', 'cfbf_add_scripts_to_admin');

        // JS用 辞書
        include 'js-dictionary.php';
        add_action( 'admin_head', 'cfbf_add_js_dictionary' );
    }

    function cfbf_add_scripts_to_public() {
        $cfbfs = get_option('cfbf_edit');
        if(is_page($cfbfs['page_id']))
            wp_enqueue_style( 'cfbf-design', 'https://www.google.com/recaptcha/api.js', array() );
    }
    add_action('wp_enqueue_scripts', 'cfbf_add_scripts_to_public');