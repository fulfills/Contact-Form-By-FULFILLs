<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    $ckeck_message = '';

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
    if(isset($_POST['cfbf_input']['nonce']) && wp_verify_nonce(sanitize_text_field($_POST['cfbf_input']['nonce']), 'cfbf_form'));
    else {
        $ckeck_message = __('Incorrect transmission.');
        return 0;
    }

    return 1;