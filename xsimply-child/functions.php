<?php
/**
 * XSimplyChild Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package XSimplyChild
 * @since 1.0.0
 */

/*
 * Required files
 */
require_once plugin_dir_path(__FILE__).'/inc/authorbox.php';
require_once plugin_dir_path(__FILE__).'/inc/filters/bodyclass.php';
require_once plugin_dir_path(__FILE__).'/inc/filters/postedonby.php';
require_once plugin_dir_path(__FILE__).'/inc/filters/landing.php';

/*
 * Functions mapping
 */
add_action( 'after_setup_theme',  'xsimply_child_setup' );
add_action( 'wp_enqueue_scripts', 'xsimply_child_enqueue_styles' );

/**
 * xsimply setup
 */
if (!function_exists('xsimply_child_setup')):

    /*
     *  Theme setup
     */
    function xsimply_child_setup(){
        
        // This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-2' => esc_html__( 'Footer', 'xsimplychild' ),
		) );
    }

endif;

/**
 * Enqueue styles
 */ 
if (!function_exists('xsimply_child_enqueue_styles')):
    
    function xsimply_child_enqueue_styles() {
        
        $parenthandle = 'xsimply-style';
        
        $theme = wp_get_theme();
        
        wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', 
            array(),  // if the parent theme code has a dependency, copy it to here
            $theme->parent()->get('Version')
        );
        
        wp_enqueue_style( 'xsimply-child-style', get_stylesheet_uri(),
            array( $parenthandle ),
            $theme->get('Version')
        );
    }
endif;

//is_page_template( 'about.php' )





 
