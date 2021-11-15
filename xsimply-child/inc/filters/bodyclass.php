<?php
/**
 * XSimplyChild Body class filter
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package XSimplyChild
 * @since 1.0.0
 */

/*
 * Functions mapping
 */
add_filter('body_class', 'xsimply_child_body_class_filter');

/**
 * Inserts classes in body following conditions
 */
if (!function_exists( 'xsimply_child_body_class_filter')):

    function xsimply_child_body_class_filter( $arrClasses ) {
    
        // how is the main menu aligned
        $strMainMenuAlign = get_theme_mod( 'xsimply_theme_layout_menu_align', 'left' );
        switch($strMainMenuAlign){
            case 'right':
                $arrClasses[] = 'header-menu-align-right';
                break;
            case 'center':
                $arrClasses[] = 'header-menu-align-center';
                break;
            case 'left':
            default:
                $arrClasses[] = 'header-menu-align-left';
        }

        // do we have to display header text
        $arrClasses[] = (display_header_text())? 'header-display_header_text':'header-hide_header_text';
        
        // do we have a custom header
        $obj = get_custom_header();

        if(!empty( $obj->url ) ) {
            // yes
            $arrClasses[] = 'header-has-custom-header-img';
        }
        
        // done
        return $arrClasses;
    }
endif;

