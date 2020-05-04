<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

class FW_Extension_Widgets extends FW_Extension {
	
	/**
	 * @internal
	 */
	public function _init() {
        
		add_action( 'widgets_init', [$this,'bariel_widget_reg'] );
		add_action( 'fw_init', [$this,'_cix_theme_widgets'] );

	}

	public function bariel_widget_reg()
	{
		register_widget('Fw_AboutUs');
		register_widget('Fw_PhotoGallery');
		register_widget('Fw_PostType');
		register_widget('Fw_Social');
		register_widget('Widget_CixContactInfo');
	}

	public function _cix_theme_widgets()
	{


	require_once dirname(__FILE__) . '/about-us/about-us.php';
	require_once dirname(__FILE__) . '/photo-gallery/photo-gallery.php';
	require_once dirname(__FILE__) . '/post-type/post-type.php';
	require_once dirname(__FILE__) . '/social/social.php';
	require_once dirname(__FILE__) . '/contact-info/widget-contact-info.php';

		
		
	}

	/**
	 * {@inheritdoc}
	 */
	public function _get_link() {
		return self_admin_url( 'widgets.php' );
	}


}
    