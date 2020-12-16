<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    function cfbf_add_shortcode() {

        $cfbfs = get_option('cfbf_edit');
        $cfbfs_o = get_option('cfbf_other');
        // 設置ページ設定の確認
        if(get_the_ID() != $cfbfs['page_id']) {
            if(is_user_logged_in()) return '
            <p>設置ページの選択が正しく行われていません．設定ページの「2.2.ショートコード設置ページの選択」よりこのページを選択してください．</p>
            ';
        }
        // 読み込みページ
        if(isset($_POST['cfbf_input'])) {
            if(include 'includes/check.php') return include 'shortcode-read.php';
            else return include 'shortcode-error.php';
        }
        else if(isset($_POST['cfbf_reinput'])) {
            if(include 'includes/re-check.php') return include 'shortcode-re-read.php';
            else return include 'shortcode-error.php';
        }
        // 返信時入力ページ
        else if(isset($_GET['cfbfid'])) return require 'shortcode-re-input.php';
        // 初回入力ページ
        else return require 'shortcode-input.php';
    }
    add_shortcode('cfbf-code', 'cfbf_add_shortcode' );