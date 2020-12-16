<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    $str = '';
    $str .= '<div class="wrap">';
        $str .= '<h1 class="wp-heading-inline">'.__('Inbox', 'contact-form-by-fulfills').' - Contact Form By FULFILLs</h1>';
        $str .= '<hr class="wp-header-end">';
        $str .= '<ul class="subsubsub">';
            $str .= include 'subsubsub.php';
        $str .= '</ul>';
        $str .= '<table class="wp-list-table widefat fixed striped posts">';
            $str .= '<thead><tr>';
                $str .= 
                    '<th scope="col" class="manage-column">'.__('Operations', 'contact-form-by-fulfills').'</th>
                    <th scope="col" class="manage-column">'.__('Status', 'contact-form-by-fulfills').'</th>
                    <th scope="col" class="manage-column">'.__('The date', 'contact-form-by-fulfills').'</th>
                    <th scope="col" class="manage-column">'.__('Reply-To', 'contact-form-by-fulfills').'</th>
                    <th scope="col" class="manage-column">'.__('inquiry details', 'contact-form-by-fulfills').'</th>';
            $str .= '</tr></thead>';
            $str .= '<tbody id="the-list">';
                $args = array(
                    'post_type' => 'cfbf',
                    'post_status' => 'draft',
                    'posts_per_page' => -1,
                );
                if($_GET['status'] === 'trash') $args['post_status'] = 'trash';
                elseif($_GET['status'] === 'read') {
                    $args['meta_key'] = 'is_read';
                    $args['meta_value'] = 1;
                }
                elseif($_GET['status'] === 'unread') {
                    $args['meta_key'] = 'is_read';
                    $args['meta_value'] = 0;
                }
                $the_query = new WP_Query($args);
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    $str .= '<tr id="post-1" class="iedit author-self level-0 post-1 type-post status-publish format-standard hentry category-1">';
                        $str .= '<td>';
                            if($_GET['status'] !== 'trash') $str .= '<a href="admin.php?page=contact-form-by-fulfills-reply&status=edit&post_id='.get_the_ID().'">'.__('Reply').'</a> | ';
                            $str .= '<a href="admin.php?page=contact-form-by-fulfills-reply&status=change&post_id='.get_the_ID().'">'.($_GET['status'] === 'trash' ? __('Restore') : __('Delete')).'</a>';
                        $str .= '</td>';
                        $str .= '<td class="status">';
                            $str .= '<button'.(get_post_meta(get_the_ID(), 'is_read', true) ? '>'.__('READ', 'contact-form-by-fulfills') : ' class="red">'.__('UNREAD')).'</button>';
                            $str .= '<button'.(get_post_meta(get_the_ID(), 'is_reply', true) ? '>'.__('Already Replied', 'contact-form-by-fulfills') : ' class="red">'.__('Not Replied', 'contact-form-by-fulfills')).'</button>';
                        $str .= '</td>';
                        $str .= '<td>'.get_the_date('Y.m.d H:m:s', $post).'</td>';
                        $str .= '<td>'.get_post_meta(get_the_ID(), 'c_email', true).'</td>';
                        $str .= '<td>'.get_the_content($post).'</td>';
                    $str .= '</tr>';
                }
                wp_reset_postdata();
            $str .= '</tbody>';
            $str .= '<tfoot><tr>';
            $str .= '</tr></tfoot>';
        $str .= '</table>';
    $str .= '</div>';
    $str .= '';
    $str .= '';
    echo $str;