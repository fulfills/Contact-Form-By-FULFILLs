<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    $ckeck_message = '';
    $cfbf_POST = cfbf_sanitize_for_array($_POST['cfbf_reinput']);

    // reCAPTCHA v3
    if(($i = $cfbfs_o['site-key']) && ($j = $cfbfs_o['secret-key'])) {
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$j.'&response='.$_POST['recaptchaResponse']);
        $reCAPTCHA = json_decode($verifyResponse);
        if ($reCAPTCHA->success) {
            ;
        } else {
            $ckeck_message = __('Failed to authenticate the reCAPTCHA.');
            return 0;
        }
    }

    // WPNONCE
    if(isset($cfbf_POST['nonce']) && wp_verify_nonce(sanitize_text_field($cfbf_POST['nonce']), 'cfbf_form'));
    else {
        $ckeck_message = __('Incorrect transmission.');
        return 0;
    }

    // AUTH チェック
    if(get_post($cfbf_id = $cfbf_POST['cfbfid']) && get_post_meta($cfbf_id, 'cfbf1', true) == $cfbf_POST['auth1'] && get_post_meta($cfbf_id, 'cfbf2', true) == $cfbf_POST['auth2']);
    else {
        $ckeck_message = __('This URL is not valid.');
        return 0;
    }

    return 1;