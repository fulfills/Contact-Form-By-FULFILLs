<?php
  if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

  function cfbf_register_post_type() {
    $args = array(
      'public' => false,
    );
    register_post_type( 'cfbf', $args );
  }
  add_action( 'init', 'cfbf_register_post_type' );