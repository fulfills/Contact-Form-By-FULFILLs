<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    function cfbf_subsubsub_len($is_trash = 0, $is_read = -1) {
        $args = array(
            'post_type' => 'cfbf',
            'posts_per_page' => -1,
            'post_status' => 'draft',
        );
        if($is_trash) $args['post_status'] = 'trash';
        if($is_read != -1) {
            $args['meta_key'] = 'is_read';
            $args['meta_value'] = $is_read;
        }
        $the_query = new WP_Query($args);
        $i = $the_query->found_posts;
        wp_reset_postdata();
        return $i;
    }
    $str_l = '';
    $cfbf_status = cfbf_sanitize_for_array($_GET['status']);
    $str_l .= '<li><a href="admin.php?page=contact-form-by-fulfills-reply" class="'.(empty($cfbf_status) || $cfbf_status === 'change' ? 'current' : '').'">'.__('All').' <span class="count">('.cfbf_subsubsub_len().')</span></a> |</li>';
    $str_l .= '<li><a href="admin.php?page=contact-form-by-fulfills-reply&status=unread" class="'.($cfbf_status === 'unread' ? 'current' : '').'">'.__('UNREAD', 'contact-form-by-fulfills').' <span class="count">('.cfbf_subsubsub_len(0, 0).')</span></a> |</li>';
    $str_l .= '<li><a href="admin.php?page=contact-form-by-fulfills-reply&status=read" class="'.($cfbf_status === 'read' ? 'current' : '').'">'.__('READ', 'contact-form-by-fulfills').' <span class="count">('.cfbf_subsubsub_len(0, 1).')</span></a> |</li>';
    $str_l .= '<li><a href="admin.php?page=contact-form-by-fulfills-reply&status=trash" class="'.($cfbf_status === 'trash' ? 'current' : '').'">'.__('Trash', 'contact-form-by-fulfills').' <span class="count">('.cfbf_subsubsub_len(1).')</span></a></li>';
    return $str_l;