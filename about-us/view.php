<?php

echo $before_widget;
?>
	<div class="brand-logo">
		<div class="brand-link mb-15">
			<img src="<?php echo esc_url($instance['logo']['url']); ?>" alt="<?php bloginfo( 'name' ); ?>">
		</div>
		<p class="mb-30">
			<?php echo esc_html($instance['text']); ?>
		</p>
		<?php if($instance['fb'] || $instance['tw'] || $instance['pr'] || $instance['yt'] || $instance['ld']): ?>
		<?php endif; ?>
		<div class="social-links ul-li clearfix">
			<ul class="clearfix">
				<?php if($instance['fb']): ?>
					<li><a href="<?php echo esc_url($instance['fb']); ?>"><i class="fa fa-facebook-f"></i></a></li>
				<?php endif; ?>

				<?php if($instance['tw']): ?>
					<li><a href="<?php echo esc_url($instance['tw']); ?>"><i class="fa fa-twitter"></i></a></li>
					
				<?php endif; ?>

				<?php if($instance['yt']): ?>	
				<li><a href="<?php echo esc_url($instance['yt']); ?>"><i class="fa fa-youtube"></i></a></li>
				<?php endif; ?>

				<?php if($instance['ig']): ?>
					
				<li><a href="<?php echo esc_url($instance['ig']); ?>"><i class="fa fa-instagram"></i></a></li>
				<?php endif; ?>

				<?php if($instance['ld']): ?>
					
				<li><a href="<?php echo esc_url($instance['ld']); ?>"><i class="fa fa-linkedin"></i></a></li>
				<?php endif; ?>

				
				
			</ul>
		</div>
	</div>
<?php echo $after_widget; ?>