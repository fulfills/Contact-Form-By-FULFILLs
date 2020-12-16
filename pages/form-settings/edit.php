<?php
    if ( ! defined( 'ABSPATH' ) ) exit;

    // POST 読み込み
    function cfbf_read_editpage() {
        update_option('cfbf_edit', cfbf_sanitize_for_array($_POST));
    }

    function cfbf_add_editpage() {
        if(!empty($_POST)) cfbf_read_editpage();
        $cfbfs = get_option('cfbf_edit');
        $b_array = array(
            'text' => __('TEXT', 'contact-form-by-fulfills'),
            'textarea' => __('TEXTAREA', 'contact-form-by-fulfills'),
            'email' => __('EMAIL ADDRESS', 'contact-form-by-fulfills'),
            'tel' => __('PHONE NUMBER', 'contact-form-by-fulfills'),
            'address' => __('ADDRESS(JAPAN)', 'contact-form-by-fulfills'),
            'radio' => __('RADIO BUTTONS', 'contact-form-by-fulfills'),
            'check' => __('CHECK BUTTON', 'contact-form-by-fulfills'),
            'select' => __('OPTIONS', 'contact-form-by-fulfills'),
        );
        $str = '';
        $str .= '<form class="wrap" method="post">';
            $str .= '<h1>'.__('Form Settings', 'contact-form-by-fulfills').'</h1>';
            $str .= '<section style="padding: 20px 10px;background-color: #FFFAF0;">';
                $str .= '<h2>1. '.__('Add/Edit items in the Form', 'contact-form-by-fulfills').'</h2>';
                $str .= '<div class="form-items">';
                    $str .= '<div class="buttons">';
                        $str .= '<div>'.__('Click on the item you want to add and it will be added.', 'contact-form-by-fulfills').'</div>';
                        foreach($b_array as $key => $val) $str .= '<button name="'.$key.'">&#043; '.$val.'</button>';
                    $str .= '</div>';
                    $str .= '<div class="two-side">';
                        $str .= '<div class="title">'.__('Items', 'contact-form-by-fulfills').'</div>';
                        $str .= '<div class="title">'.__('Preview', 'contact-form-by-fulfills').'</div>';
                        $str .= '<ul class="change-p">';
                            $str .= include 'includes/inputs.php';
                        $str .= '</ul>';
                        $str .= '<div class="preview" id="cfbf">';
                        $str .= '</div>';
                    $str .= '</div>';
                $str .= '</div>';
            $str .= '</section>';
            $str .= '<section style="padding: 20px 10px;background-color: #FFF;">';
                $str .= '<h2>2. '.__('Shortcode', 'contact-form-by-fulfills').'</h2>';
                $str .= '<h3>2.1. '.__('Insert a shortcode', 'contact-form-by-fulfills').'</h3>';
                $str .= '<p>'.__('Insert the following shortcode into the page where you place the inquiry form.', 'contact-form-by-fulfills').'</p>';
                $str .= '<input type="text" value="[cfbf-code]" readonly>';
                $str .= '<h3>2.2. '.__('Select the page', 'contact-form-by-fulfills').'</h3>';
                $str .= '<p>'.__('Please select the page where you put the shortcode from the following list.', 'contact-form-by-fulfills').'<br>'.__('Notice: If it does not match, the form is not displayed.', 'contact-form-by-fulfills').'</p>';
                $str .= '<div><select name="page_id">';
                    $str .= '<option value="0">未選択</option>';
                    $arr = get_pages();
                    foreach($arr as $elem)
                        $str .= '<option value="'.$elem->ID.'" '.($cfbfs['page_id'] == $elem->ID ? 'selected' : '').'>'.$elem->post_title.'</option>';
                $str .= '</select></div>';
                $str .= '<input type="submit" class="button button-primary" value="'.__('Save Changes').'">';
            $str .= '</section>';
        $str .= '</form>';
        $str .= '
            <style>
                div#cfbf
                {
                    width: 49%;
                    margin: 0;
                }
            </style>
        ';
        echo $str;
    }