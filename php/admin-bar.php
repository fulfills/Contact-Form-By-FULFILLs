<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    add_action( 'admin_bar_menu', 'my_admin_bar_menu', 75);
    function my_admin_bar_menu( $wp_admin_bar ) {
        $args = array(
            'post_type' => 'cfbf',
            'posts_per_page' => -1,
            'post_status' => 'draft',
            'meta_key' => 'is_read',
            'meta_value' => 0,
        );
        $the_query = new WP_Query($args);
        $i = $the_query->found_posts;
        wp_reset_postdata();
        if($i >= 1) $wp_admin_bar->add_menu( array(
            'id'     => 'cfbf',
            'title'  => '<span class="ab-icon dashicons-email-alt"></span><span class="ab-label">'.$i.'</span>',
            'href'   => admin_url('admin.php?page=contact-form-by-fulfills-reply&status=unread'),
        ) );
    }