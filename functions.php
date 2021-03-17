<?php

// BASIC CONFIG

function load_theme_assets() {
	wp_enqueue_style( 'theme-style', get_stylesheet_uri() , array( 'main' ) );
    wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/css/style.css', array(), time() );
}
add_action( 'wp_enqueue_scripts', 'load_theme_assets' );

register_nav_menu('main', 'Primary Menu');
load_theme_textdomain('mti-test', get_stylesheet_directory() . '/languages');

// REGISTER SIDEBARS

function nova_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Left sidebar', 'mti-test' ),
		'id' => 'sidebar-left',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '',
		'after_title' => '',
	) );

	register_sidebar( array(
		'name' => __( 'Right sidebar', 'mti-test' ),
		'id' => 'sidebar-right',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '',
		'after_title' => '',
	) );

}
add_action( 'widgets_init', 'nova_widgets_init' );

// REGISTER POST TYPE

function nova_post_type() {
    register_post_type('teams',
        array(
            'labels'      => array(
                'name'          => __('Teams', 'mti-test'),
                'singular_name' => __('Team', 'mti-test'),
            ),
                'public'      => true,
                'has_archive' => true,
        )
    );
}
add_action('init', 'nova_post_type');

add_action( 'after_switch_theme', 'nova_rewrite_flush' );
function nova_rewrite_flush() {
    flush_rewrite_rules(); // rewrite rules after switching theme to make post types work
}

?>
