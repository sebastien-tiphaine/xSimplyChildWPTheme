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
add_filter('render_block_data', 'xsimply_child_landing_block_filter');

/**
 * Inserts classes in body following conditions
 */
if (!function_exists('xsimply_child_landing_block_filter')):
    
    function xsimply_child_landing_block_filter($arrParsedBlock){
        
        // do we have to filter the block
        if(!is_page_template('landing.php') || empty($arrParsedBlock['blockName'])){
            // no
            return $arrParsedBlock;
        }
       
        // extracting block name
        $strBlockName = trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', $arrParsedBlock['blockName'])));
        // setting function name
        $strFunc      = 'xsimply_child_landing_filter_'.$strBlockName;
        
        // do we have a filter function
        if(function_exists($strFunc)){
            // yes
            return $strFunc($arrParsedBlock);
        }

        return $arrParsedBlock;
    }
endif;

/**
 * Inserts classes in body following conditions
 */
if (!function_exists('xsimply_child_landing_block_wrapper')):

    function xsimply_child_landing_block_wrapper($strHTML, $strClasses = false, $strStyles = false){
        
        // do we have a content
        if(!is_string($strHTML) || empty($strHTML)){
            // no
            return $strHTML;
        }
        
        // do we have styles
        if(is_string($strStyles) && !empty($strStyles)){
            // yes
            $strStyles = 'style="'.trim($strStyles).'"';
        }
        else{
            // no
            $strStyles = '';
        }
        
        // do we have classes
        if(!is_string($strClasses) || empty($strClasses)){
            // no
            $strClasses = '';
        }
        
        $strWrapper = '<div class="landing-block-wrapper '.trim($strClasses).'" '.$strStyles.'>';
        $strWrapper.= '     <div class="landing-block-content-container">'.$strHTML.'</div>';
        $strWrapper.= '</div>';
        
        return $strWrapper;
    }

endif;

/**
 * Filter core paragraph
 */
if (!function_exists('xsimply_child_landing_filter_core_paragraph')):
    
    /*
     * Filters core_paragraph
     */
    function xsimply_child_landing_filter_core_paragraph($arrParsedBlock){
        
        // setting default style
        $strStyles  = '';
        $strClasses = '';
        
        if(isset($arrParsedBlock['attrs']['backgroundColor']) && 
           is_string($arrParsedBlock['attrs']['backgroundColor']) &&
           !empty($arrParsedBlock['attrs']['backgroundColor'])){
                $strClasses.= 'has-'.strtolower(trim($arrParsedBlock['attrs']['backgroundColor'])).'-background-color has-background';
        }
        
        if(isset($arrParsedBlock['attrs']['style']['color']['background']) && 
           is_string($arrParsedBlock['attrs']['style']['color']['background']) &&
           !empty($arrParsedBlock['attrs']['style']['color']['background'])){
                $strStyles.= ' background-color:'.$arrParsedBlock['attrs']['style']['color']['background'].';';
                $strClasses.= ' has-background';
        }
        
        //print_r($arrParsedBlock['attrs']);
        
        // updating html
        $arrParsedBlock['innerHTML'] = xsimply_child_landing_block_wrapper($arrParsedBlock['innerHTML'], $strClasses, $strStyles);
        $arrParsedBlock['innerContent'][0] = $arrParsedBlock['innerHTML'];
        
        // done
        return $arrParsedBlock;
    }

endif;

/**
 * Filter core paragraph
 */
if (!function_exists('xsimply_child_landing_filter_core_heading')):
    
    /*
     * Filters core_paragraph
     */
    function xsimply_child_landing_filter_core_heading($arrParsedBlock){
        return xsimply_child_landing_filter_core_paragraph($arrParsedBlock);
    }
endif;

/**
 * Filter core image
 */
if (!function_exists('xsimply_child_landing_filter_core_image')):

    /*
     * Filters core_image
     */
    function xsimply_child_landing_filter_core_image($arrParsedBlock){

        // setting default classes
        $strClasses = '';

        if(isset($arrParsedBlock['attrs']['id']) &&
           !empty($arrParsedBlock['attrs']['id'])){
                $strClasses.= ' image-block-id-'.$arrParsedBlock['attrs']['id'];
        }

        if(isset($arrParsedBlock['attrs']['className']) &&
           is_string($arrParsedBlock['attrs']['className']) &&
           !empty($arrParsedBlock['attrs']['className'])){

                $arrClasses = explode(' ', $arrParsedBlock['attrs']['className']);

                if(is_array($arrClasses) && !empty($arrClasses)){
                    foreach($arrClasses as $strClass){
                        $strClasses.= ' block-wrapper-'.$strClass;
                    }
                }
        }

        // updating html
        $arrParsedBlock['innerHTML'] = xsimply_child_landing_block_wrapper($arrParsedBlock['innerHTML'], $strClasses);
        $arrParsedBlock['innerContent'][0] = $arrParsedBlock['innerHTML'];

        // done
        return $arrParsedBlock;
    }
endif;

/**
 * Filter core columns
 */
/*if (!function_exists('xsimply_child_landing_filter_core_columns')):*/

    /*
     * Filters core_columns
     */
   /* function xsimply_child_landing_filter_core_columns($arrParsedBlock){
        // updating html
        $arrParsedBlock['innerHTML'] = xsimply_child_landing_block_wrapper($arrParsedBlock['innerHTML']);
        $arrParsedBlock['innerContent'][0] = $arrParsedBlock['innerHTML'];

        // done
        return $arrParsedBlock;
    }
endif;*/


