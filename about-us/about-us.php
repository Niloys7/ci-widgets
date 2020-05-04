<?php if ( ! defined( 'ABSPATH' ) ) {
 die( 'Die' ); 
}
 
class Fw_AboutUs extends WP_Widget {
 
    /**
     * Widget constructor.
     */
    private $options;
    private $prefix;
    function __construct() {
 
        $widget_ops = array( 
            'description' => __( 'Display About us Widget', 'unyson' ) 
        );
        parent::__construct( false, __( 'Codeixer - About Us', 'unyson' ), $widget_ops );
        
        //Create our options by using Unyson option types
        $this->options = array(
           
            
            'logo' => array(
                'type'  => 'upload',
                'label' => __('Logo:', 'unyson'),
                'desc' => __('Add logo', 'unyson'),
                
            ),
            'text' => array(
            'type'  => 'textarea',
            'value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            
            'label' => __('Details:', '{domain}'),
            'desc'  => __('Add Description', '{domain}'),
            
            ),
            
            'fb' => array(
                'type' => 'text',
                'label' => __('Facebook:', 'unyson'),
            ),
            'tw' => array(
                'type' => 'text',
                'label' => __('Twitter:', 'unyson'),
            ),
            'ig' => array(
                'type' => 'text',
                'label' => __('Instagram:', 'unyson'),
            ),
            'yt' => array(
                'type' => 'text',
                'label' => __('Youtube:', 'unyson'),
            ),
            'ld' => array(
                'type' => 'text',
                'label' => __('Linkedin:', 'unyson'),
            ),
          
        );
        $this->prefix = 'cix_about';
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
               
                timeoutAddId = setTimeout(function(){ // wait a few milliseconds for html replace to finish
                 
                    $widget.find('form input[type="submit"]').removeAttr("disabled");
                    $widget.find('form input[type="submit"]').click();
                }, 300);
            });

            jQuery(document).on('widget-updated', function(ev, $widget){
              
                timeoutUpdateId = setTimeout(function(){ // wait a few milliseconds for html replace to finish
                    fwEvents.trigger('fw:options:init', { $elements: $widget });
                }, 100);
            });
        </script><?php
    }
 
}