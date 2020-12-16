<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    // トップページ
    function cfbf_add_toppage() {
        echo '
            <div class="wrap">
                <h1>Contact Form By FULFILLs</h1>
                <h2>■'.__('About this plug-in', 'contact-form-by-fulfills').'</h2>
                <p>
                    '.__('This plugin is developed by FULFILLs, an organization of volunteers.', 'contact-form-by-fulfills').'<br>
                    <a href="https://fulfills.jp">https://fulfills.jp</a>
                </p>
                <p>
                    '.__('We take all possible precautions against defects, but we are not responsible for any damages caused by this plug-in.', 'contact-form-by-fulfills').'
                </p>
                <h2>■'.__('Bug Reports and Improvements', 'contact-form-by-fulfills').'</h2>
                <p>
                    '.__('Opinions from actual users contribute greatly to the development of this plug-in.', 'contact-form-by-fulfills').'<br>
                    '.__('If you have any suggestions or comments, please report them below.', 'contact-form-by-fulfills').'<br>
                </p>
                <p><a class="button button-primary" href="https://fulfills.jp/contact" target="_blank">FULFILLs SUPPORT</a></p>
                <p>'.__('We appreciate your help.', 'contact-form-by-fulfills').'</p>
            </div>
        ';
    }