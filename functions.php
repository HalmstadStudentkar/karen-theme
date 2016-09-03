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

// Disable the default coloring stuff, the green is not great together
// with the purple =)
function magazino_apply_color() {
	 return true;
}



function magazino_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Footer Sidebar', 'magazino' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );

	register_sidebar(array(
		'name' => 'Main Sidebar',
		'id' => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	));

	register_sidebar(array(
		'name'=> 'Right Sidebar',
		'id' => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="right-widget">',
		'after_title' => '</div>',
	));

}
