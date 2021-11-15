<?php

class XsimplyChild_AuthorBoxWidget extends WP_Widget {

    /*
     * Constructor
     */
    public function __construct() {
            parent::__construct(
                'xsimply_author_widget',
                esc_html__( 'Author Info', 'xsimplychild' ),
                array( 'description' => esc_html__( 'Displays Author infos', 'xsimplychild' ), )
            );
    }
    
    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        
        // setting default vars
        $strAuthorId    = false;
        $strDisplayName = false;
        $strDescription = false;
        
        // do we have an author id
        if(isset($instance['author_id']) && !empty($instance['author_id'])){
            // yes
            $strAuthorId = $instance['author_id']; 
        }
        else{
            // no we have to use the post author
            // getting global var
            global $post;
            
            // Are we on a post with author infos available
            if (!is_single() || !isset($post->post_author)) {
                // no
                return;
            }
            
            // extracting post author
            $strAuthorId = $post->post_author;
        }
        
        // do we have a display name
        if(isset($instance['author_display_name']) && !empty($instance['author_display_name'])){
            $strDisplayName = $instance['author_display_name'];
        }
        
        // do we have a description
        if(isset($instance['author_description']) && !empty($instance['author_description'])){
            $strDescription = $instance['author_description'];
        }
    
        echo $args['before_widget'];
        echo xsimply_child_author_box_html($strAuthorId, $strDisplayName, $strDescription);
        echo $args['after_widget'];
    }
    
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
    
        // author
        // getting author list
        $arrAuthors = get_users(array(
            'orderby' => 'display_name',
        ));
    
        // setting author list
        $strAuthorsList= '<option value="0">Default Post Author</option>';
    
        foreach($arrAuthors as $oAuthor){
                // default selected value
                $strSelected = '';
                // do we have to preselect the author
                if(isset($instance['author_id']) && !empty($instance['author_id']) && $instance['author_id'] == $oAuthor->ID){
                    $strSelected = 'selected="selected"';
                }
                
                $strAuthorsList.= '<option value="'.$oAuthor->ID.'" '.$strSelected.'>'.$oAuthor->display_name.'</option>';
        }
    
        // finalising author list
        $strAuthorsList = '<select class="widefat" id="'.esc_attr($this->get_field_id('author_id')).'" name="'.esc_attr($this->get_field_name('author_id')).'">'.$strAuthorsList.'</select>';
        
        // extracting other fields
        $strDisplayName = (!empty($instance['author_display_name'])) ? $instance['author_display_name'] : '';
        $strDescription = (!empty($instance['author_description'])) ? $instance['author_description'] : '';
        
        // setting main html
        $strForm = '<p>';
        $strForm.= '<label for="'.esc_attr($this->get_field_id('author_id')).'">'.esc_attr('author', 'xsimplychild').':</label> ';
        $strForm.= $strAuthorsList;
        $strForm.= '</p>';
        
        $strForm.= '<p>';
        $strForm.= '<label for="'.esc_attr($this->get_field_id('author_display_name')).'">'.esc_attr('Personalized name to display', 'xsimplychild').':</label>';
        $strForm.= '<input class="widefat" id="'.esc_attr($this->get_field_id('author_display_name')).'" name="'.esc_attr($this->get_field_name('author_display_name')).'" type="text" value="'.esc_attr($strDisplayName).'">';
        $strForm.= '</p>';
        
        $strForm.= '<p>';
        $strForm.= '<label for="'.esc_attr($this->get_field_id('author_description')).'">'.esc_attr('Personalized description', 'xsimplychild').':</label>';
        $strForm.= '<textarea class="widefat" id="'.esc_attr($this->get_field_id('author_description')).'" name="'.esc_attr($this->get_field_name('author_description')).'" type="text" cols="30" rows="10">'.esc_attr($strDescription).'</textarea>';
        $strForm.= '</p>';
        
        // done
        echo $strForm;
    }
    
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        
        $instance = array();
 
        $instance['author_id']           = (!empty($new_instance['author_id']))? strip_tags($new_instance['author_id']) : '';
        $instance['author_display_name'] = (!empty($new_instance['author_display_name']))? strip_tags($new_instance['author_display_name']) : '';
        $instance['author_description']  = (!empty($new_instance['author_description']))? $new_instance['author_description'] : '';
 
        return $instance;
    }
} 
