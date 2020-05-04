<?php if ( ! defined( 'ABSPATH' ) ) {
 die( 'Die' ); 
}
 
class Fw_PhotoGallery extends WP_Widget {
 
    /**
     * Widget constructor.
     */
    private $options;
    private $prefix;
    function __construct() {
 
        $widget_ops = array( 
            'description' => __( 'Add Photo Gallery', 'fw' ) 
        );
        parent::__construct( false, __( 'Codeixer - Photo Gallery', 'fw' ), $widget_ops );
        
        //Create our options by using Unyson option types
        $this->options = array(
            'title' => array(
                'type' => 'text',
                'label' => __('Widget Title:', 'fw'),
            ),
            'pg' => array(
                'type'  => 'multi-upload',
                'label' => __('Images:', 'fw'),
                'desc'  => __('Add Images for Gallery', 'fw'),
                'images_only' => true,
                
            ),
           
        );
        $this->prefix = 'cix_photo_gallery';
    }
 
    function widget( $args, $instance ) {
        extract( $args );
        $params = array();
 
        foreach ( $instance as $key => $value ) {
            $params[ $key ] = $value;
        }
 
        $filepath = dirname( __FILE__ ) . '/view.php';
 
        $instance = $params;
 
        if ( file_exists( $filepath ) ) {
            include( $filepath );
        }
    }
 
    function update( $new_instance, $old_instance ) {
        return fw_get_options_values_from_input(
            $this->options,
            FW_Request::POST(fw_html_attr_name_to_array_multi_key($this->get_field_name($this->prefix)), array())
        );
    }
 
    function form( $values ) {
 
        $prefix = $this->get_field_id($this->prefix); // Get unique prefix, preventing dupplicated key
        $id = 'fw-widget-options-'. $prefix;
 
        // Print our options
        echo '<div class="fw-force-xs fw-theme-admin-widget-wrap" id="'. esc_attr($id) .'">';
        
        echo fw()->backend->render_options($this->options, $values, array(
            'id_prefix' => $prefix .'-',
            'name_prefix' => $this->get_field_name($this->prefix),
        ));
        echo '</div>';
        $this->print_widget_javascript($id);
        return $values;
    }
    
    /*
     * Initialize options after saving.
     */
    private function print_widget_javascript($id) {
        ?>
        <script type="text/javascript">
          
            jQuery(document).on('widget-added', function(ev, $widget){
               
                $widget . find( 'form input[type="submit"]' ) . removeAttr( "disabled" );
                timeoutAddId = setTimeout(function(){ // wait a few milliseconds for html replace to finish

                  
                    $widget.find('form input[type="submit"]').click();
                }, 1000);
            });

        
            jQuery(document).on('widget-updated', function(ev, $widget){
                
                timeoutUpdateId = setTimeout(function(){ // wait a few milliseconds for html replace to finish
                    fwEvents.trigger('fw:options:init', { $elements: $widget });
                }, 100);
            });
        </script>
        <?php
    }
 
}