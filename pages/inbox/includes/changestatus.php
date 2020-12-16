<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    $post_id = cfbf_sanitize_for_array($_GET['post_id']);
    if(get_post_status($post_id) === 'trash')
        wp_update_post( array( 'ID' => (int)$post_id, 'post_status' => 'draft' ) );
    else 
        wp_trash_post($post_id);