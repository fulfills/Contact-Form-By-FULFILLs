<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    function cfbf_input_as_data_notification($p_id, $cfbfs_o) {
        if($c_email = $cfbfs_o['note-email']) {
            $r_url = admin_url('admin.php?page=contact-form-by-fulfills-reply&status=edit&post_id='.$p_id);
            $c_email = sanitize_email($c_email);
            $c_subject = __('Inquiry received', 'contact-form-by-fulfills');
            $c_message = __("Contact Form By FULFILLs has received 1 new inquiry.\n\nYou can check it at the following URL:\n", 'contact-form-by-fulfills').$r_url;
            $headers = 'From: Contact Form By FULFILLs <wordpress@'.$_SERVER['SERVER_NAME'].'>'."\r\n";
            wp_mail($c_email, $c_subject, $c_message, $headers);
        }
        
    }