<?php echo $before_widget; ?>
	<?php echo $before_title.'' .esc_html( $instance['title'] ).''. $after_title;  ?>

		<?php if($instance['fb'] || $instance['tw'] || $instance['pr'] || $instance['yt'] || $instance['ld']): ?>
		<div class="social-links ul-li-center clearfix">
			<ul class="clearfix">
				<?php if($instance['fb']): ?>
					<li><a href="<?php echo esc_url($instance['fb']); ?>"><i class="fab fa-facebook-f"></i></a></li>
				<?php endif; ?>

				<?php if($instance['tw']): ?>
					<li><a href="<?php echo esc_url($instance['tw']); ?>"><i class="fab fa-twitter"></i></a></li>
					
				<?php endif; ?>

				<?php if($instance['yt']): ?>	
				<li><a href="<?php echo esc_url($instance['yt']); ?>"><i class="fab fa-youtube"></i></a></li>
				<?php endif; ?>

				<?php if($instance['ig']): ?>
					
				<li><a href="<?php echo esc_url($instance['ig']); ?>"><i class="fab fa-instagram"></i></a></li>
				<?php endif; ?>

				<?php if($instance['ld']): ?>
					
				<li><a href="<?php echo esc_url($instance['ld']); ?>"><i class="fab fa-linkedin"></i></a></li>
				<?php endif; ?>

				
				
			</ul>
		</div>
		<?php endif; ?>
<?php echo $after_widget; ?>
