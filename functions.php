<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
    }

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/******
Här behandlas gränsen för hur många _ord_ som visas upp i excerpt.
*******/
add_filter('excerpt_length', 'my_excerpt_length');
function my_excerpt_length($length) {
return 80; }
/*****
Slut på excerpt-filter
*****/
 ?>

