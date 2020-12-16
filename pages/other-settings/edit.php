<?php
    if ( ! defined( 'ABSPATH' ) ) exit;

    function cfbf_add_otherpage_input() {
        $cfbf_other = cfbf_sanitize_for_array($_POST, 1);
        $textarea_array = ['top-message', 'accept-message', 'error-message'];
        foreach($textarea_array as $elem) $cfbf_other[$elem] = cfbf_sanitize_for_array($_POST[$elem], 1);
        update_option('cfbf_other', $cfbf_other);
    }

    function cfbf_add_otherpage() {
        if(!empty($_POST)) cfbf_add_otherpage_input();  // SAVE SETTINGS
        $cfbfs = get_option('cfbf_other');
        $str = '<form class="wrap" method="post">';
            $str .= '<h1>'.__('Other Settings', 'contact-form-by-fulfills').'</h1>';
            $str .= '<table class="form-table"><tbody>';
                $str .= '<tr><th>'.__("Email sender's name", 'contact-form-by-fulfills').'</th><td><input type="text" name="sender-name" value="'.$cfbfs['sender-name'].'" size="100" placeholder="'.__('ex. Customer Center', 'contact-form-by-fulfills').'" required><p class="description">'.__('It will be used as the name of the sender of the reply email.', 'contact-form-by-fulfills').'</p></td></tr>';
                $str .= '<tr><th>'.__('Message', 'contact-form-by-fulfills').'<br>['.__('Inquiry Input Page', 'contact-form-by-fulfills').']</th><td><textarea name="top-message" cols="100" rows="5">'.($cfbfs['top-message'] ?: __('Please fill out the required information below and press the Send button.', 'contact-form-by-fulfills')).'</textarea></td></tr>';
                $str .= '<tr><th>'.__('Message', 'contact-form-by-fulfills').'<br>['.__('Inquiry Completion Page', 'contact-form-by-fulfills').']</th><td><textarea name="accept-message" cols="100" rows="5">'.($cfbfs['accept-message'] ?: __('Your inquiry has been received. Please wait for a reply.', 'contact-form-by-fulfills')).'</textarea></td></tr>';
                $str .= '<tr><th>'.__('Message', 'contact-form-by-fulfills').'<br>['.__('Sending Error Page', 'contact-form-by-fulfills').']</th><td><textarea name="error-message" cols="100" rows="5">'.($cfbfs['error-message'] ?: __('Sorry, your transmission was not successful. Please try again or contact us directly at the following number: &NewLine;00-0000-0000', 'contact-form-by-fulfills')).'</textarea></td></tr>';
            $str .= '</tbody></table>';
            $str .= '<h2>'.__('Email Notification', 'contact-form-by-fulfills').'</h2>';
            $str .= '<table class="form-table"><tbody>';
            $str .= '<tr><th>'.__('Email Address', 'contact-form-by-fulfills').'</th><td><input type="email" name="note-email" value="'.$cfbfs['note-email'].'" size="100"><p class="description">'.__('NOTE: ').__('When the plugin receives an inquiry, a notification is sent to this email address.').'</p><p class="description">'.__('NOTE: ').__("If you don't want to receive email notifications, please leave/change this field blank").'</p></td></tr>';
            $str .= '</tbody></table>';
            $str .= '<h2>'.__('Email Templates', 'contact-form-by-fulfills').'</h2>';
            $str .= '<table class="form-table"><tbody>';
            $str .= '<tr><th>'.__('Reply Email', 'contact-form-by-fulfills').'<p class="description">'.__('NOTE: ').__('This template will be received by inquirer.').'</p></th><td><textarea name="reply-template" cols="100" rows="10">'.($cfbfs['reply-template'] ?: __('[CONTENT]&NewLine;-----&NewLine;&NewLine;To reply to this e-mail, please visit the following URL.&NewLine;[URL]&NewLine;&NewLine;Sorry, but if you reply to this email directly, we will not receive it.', 'contact-form-by-fulfills')).'</textarea><p class="description">'.__('NOTE: ').__('You need to include [CONTENT] AND [URL] in the template. <br>They will be automatically replaced as follows.', 'contact-form-by-fulfills').'<br>'.__('[CONTENT]: Reply Message, sent in Inbox', 'contact-form-by-fulfills').'<br>'.__('[URL]: URL. Inquirer will need this to reply to your message.', 'contact-form-by-fulfills').'</p></td></tr>';
            $str .= '</tbody></table>';
            $str .= '<h2>reCAPTCHA v3</h2>';
            $str .= '<p class="description">'.__('You can use reCAPTCHA in your inquiry form if you enter both "site key" and "secret key".', 'contact-form-by-fulfills').'<br>'.__('To get them, go to the following page:', 'contact-form-by-fulfills').'<br><a href="https://www.google.com/recaptcha/admin/create" target="_blank">https://www.google.com/recaptcha/admin/create</a></p>';
            $str .= '<table class="form-table"><tbody>';
                $str .= '<tr><th>Site key</th><td><input type="text" name="site-key" value="'.$cfbfs['site-key'].'" size="100"></td></tr>';
                $str .= '<tr><th>Secret key</th><td><input type="text" name="secret-key" value="'.$cfbfs['secret-key'].'" size="100"></td></tr>';
            $str .= '</tbody></table>';
            $str .= '<h2>'.__('Permission', 'contact-form-by-fulfills').'</h2>';
            $str .= '<table class="form-table"><tbody>';
            $str .= '<tr><th>'.__('Access Permissions', 'contact-form-by-fulfills').'</th><td><fieldset><label for="permission-author"><input name="permission-author" type="checkbox" value="1" '.($cfbfs['permission-author'] ? 'checked' : '').'>'.__('Allow Author access to the Inbox', 'contact-form-by-fulfills').'</label></fieldset></td></tr>';
            $str .= '</tbody></table>';
            $str .= '<input type="submit" class="button button-primary" value="'.__('Save Changes').'">';
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