<?php echo $before_widget; ?>

<div class="photo-gallery ul-li clearfix">
	
	<?php echo $before_title.'' .esc_html( $instance['title'] ).''. $after_title; 
	 ?>
	
	
	<ul class="p-0 widget-gallery">
	<?php 
		foreach ($instance['pg'] as $img) { ?>
			<li class="widget-gallery-item">
		
				
				<?php $img_url = wp_get_attachment_image_src( $img['attachment_id'], 'thumbnail' ); ?>
			
				<a href="<?php echo esc_url( $img['url'] ); ?>">
					<img src="<?php echo esc_url( $img_url[0] ); ?>" alt="Photo">
				</a>
			
		</li>
		<?php }
	?>
		
	</ul>
</div>

<?php 

echo $after_widget; 
wp_enqueue_style( 'magnific-popup' );
wp_enqueue_script( 'magnific-popup' );
wp_add_inline_script( 'magnific-popup', '
jQuery(document).ready(function(){
   jQuery(\'.widget-gallery\').each(function() { 
		jQuery(this).magnificPopup({
			delegate: \'a\', // the selector for gallery item
			type:\'image\',
			gallery: {
			enabled:true
			}
			,
			mainClass: \'mfp-fade\',
			removalDelay: 300,
		});
	});


	
});
' );
?>