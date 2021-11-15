<?php
/**
 * XSimplyChild Authorbox and widget
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package XSimplyChild
 * @since 1.0.0
 */

/*
 * Loading required files
 */
require_once plugin_dir_path(__FILE__).'/classes/AuthorBoxWidget.php';

/*
 * Functions mapping
 */
add_action('the_content',  'xsimply_child_author_info_box');
add_action('widgets_init', 'register_xsimply_author_box_widget');

// Allow HTML in author bio section 
remove_filter('pre_user_description', 'wp_filter_kses');


if (!function_exists('xsimply_child_author_box_html')):
    
    /*
    * Returns Author Box HTML
    */
    function xsimply_child_author_box_html($strAuthorId, $strDisplayName = false, $strDescription = false){

            // do we have an author id
            if(!$strAuthorId){
                // no
                return "";
            }
        
            // do we need to get author display name
            if(!is_string($strDisplayName) || empty($strDisplayName)){
                $strDisplayName = get_the_author_meta( 'display_name', $strAuthorId);
            }
            
            // If display name is not available then use nickname as display name
            if(empty($strDisplayName)) {
                $strDisplayName = get_the_author_meta( 'nickname', $post_author);
            }
            
            // is display name still empty
            if(empty($strDisplayName)){
                // yes
                // nothing to display
                return "";
            }
            
            // do we need to get author display name
            if(!is_string($strDescription) || empty($strDescription)){
                $strDescription = get_the_author_meta('user_description', $strAuthorId);
            }
            
            $strAuthorBox = '<div class="author_bio_body">';
            $strAuthorBox.= '   <div class="author-meta">';
            $strAuthorBox.= get_avatar(get_the_author_meta('user_email'), 64);
            $strAuthorBox.= '       <b class="fn">'.$strDisplayName.'</b>';
            $strAuthorBox.= '   </div>';
            $strAuthorBox.= '   <p class="author_about">'.$strDescription.'</p>';
            $strAuthorBox.= '</div>';
            
            return $strAuthorBox;
    }
endif;
 
/*
 * Author box at the bottom of articles 
 */
if (!function_exists('xsimply_child_author_info_box')) :
    
    function xsimply_child_author_info_box($strContent) {  
        global $post;
        
        // Are we on a post with author infos available
        if (!is_single() || !isset($post->post_author)) {
            // no
            return $strContent;
        }
        
        $strAuthorBox = '<footer class="author_bio_section" >';
        $strAuthorBox.= xsimply_child_author_box_html($post->post_author);
        $strAuthorBox.= '</footer>';
        
        // adding Author box to the content  
        $strContent.= $strAuthorBox;
            
        // done
        return $strContent;
    }
endif;
  
/*
 * Widget Author Box
 */
function register_xsimply_author_box_widget() {
    register_widget( 'XsimplyChild_AuthorBoxWidget' );
}
