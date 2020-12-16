<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    return '<p>'.nl2br($cfbfs_o['error-message']).'</p><p>'.__('Details: ').$ckeck_message.'</p>';