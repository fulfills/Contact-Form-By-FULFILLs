<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    function cfbf_add_replypage() {
        $cfbf_status = cfbf_sanitize_for_array($_GET['status']);
        if(empty($cfbf_status) || $cfbf_status !== 'edit') {
            if($cfbf_status === 'change') include 'includes/changestatus.php';
            include 'includes/listpage.php';
        }
        else
            include 'includes/replypage.php';
    }