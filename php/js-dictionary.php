<?php 
    function cfbf_add_js_dictionary() { 
        $dict = array(
            'Item Name',
            'Required Field',
            'Add a button',
            'Remove last button',
            'Add a selector',
            'Remove last selector',
            'Delete',
            'Button',
            'Check Message',
            'Selector',
            'There must be at least one email address field.',
            'Required',
            'SEND',
            'EMAIL ADDRESS',
            'This value is the return address of the plugin.',
            'Please include [CONTENT] and [URL] in Reply Email.',
        );
        $str = '';
        $str .= '<script type="text/javascript">';
        $str .= 'var cfbf_dic = {';
        foreach($dict as $elem) $str .= '"'.$elem.'": "'.__($elem, 'contact-form-by-fulfills').'",';
        $str .= '};';
        $str .= '</script>';
        echo $str;
    }
?>