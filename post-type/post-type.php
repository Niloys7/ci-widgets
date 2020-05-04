<?php if ( ! defined( 'ABSPATH' ) ) {
 die( 'Die' ); 
}
 
class Fw_PostType extends WP_Widget {
 
    /**
     * Widget constructor.
     */
    private $options;
    private $prefix;
    function __construct() {
 
        $widget_ops = array( 
            'description' => __( 'Display Posts', 'fw' ) 
        );
        parent::__construct( false, __( 'Codeixer - Posts', 'fw' ), $widget_ops );
        
        //Create our options by using Unyson option types
        $this->options = array(
            'title' => array(
                'type' => 'text',
                'label' => __('Widget Title:', 'fw'),
            ),
            'ppp' => array(
                'type' => 'short-text',
                'value' => '4',
                'label' => __('Post Count:', 'fw'),
            ),
            'cat' => array(
                'type'  => 'multi-select',
                'label' => __('Categories:', 'fw'),
                'population' => 'taxonomy',
                'source' => 'category',
                'desc'=> __('Display Posts only from selected category', 'fw'),
            ),
            'isp' => array(
                'type'  => 'checkbox',
                'value' => false, // checked/unchecked
                'label' => __('Ignore Sticky Posts:', 'fw'),
                
                'text'  => __('Yes', 'fw'),
            ),
            'ordr' => array(
                 'type'  => 'select',
                 'value' => 'DESC',
                 'label' => __('Post Order:', 'fw'),
                 'choices' => array(
                    'DESC' => 'DESC',
                    'ASC' => 'ASC',
                 ),
               
            ),
            
         
        );
        $this->prefix = 'cix_post_type';
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
        <style>
            /* This CSS need to force display option after saving */
            .fw-theme-admin-widget-wrap .fw-backend-option, .fw-theme-admin-widget-wrap .fw-postbox {
                opacity: 1;
                padding: 10px 0px;
                border-bottom: 0px;
            }
            .fw-backend-option-design-default > .fw-backend-option-label label {
                    font-weight: normal; 
                    font-size: 13px;
                }
                .fw-force-xs .fw-backend-option-design-default > .fw-backend-option-label > .fw-inner{
                    padding: 0 0 5px;
                }
        </style>
        <script type="text/javascript">
            jQuery(function($) {
                var selector = '#<?php echo esc_js($id) ?>', timeoutId;
 
                $(selector).on('remove', function(){ // ReInit options on html replace (on widget Save)
                    clearTimeout(timeoutId);
                    timeoutId = setTimeout(function(){ // wait a few milliseconds for html replace to finish
                        fwEvents.trigger('fw:options:init', { $elements: $(selector) });
                    }, 100);
                });
            });
        </script><?php
    }
 
}