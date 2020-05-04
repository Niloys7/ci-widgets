<?php echo $before_widget; ?>
<div class="contact-info ul-li-block clearfix">
	
	<?php echo $before_title.'' .esc_html( $instance['title'] ).''. $after_title;  ?>
	<?php
	if($instance['contact_us']['enable'] == 'style2') { ?>

	<ul class="clearfix">
		<li>
			<div class="contact-item">
				<span class="icon"><i class="fa fa-phone"></i></span>
				<div class="item-content">
					<h3 class="title-text mb-0"><?php echo esc_html__( 'phone number', 'fw' );?></h3>
					<span class="contact-text"><?php echo esc_html( $instance['pn'] ); ?></span>
				</div>
			</div>
		</li>
		<li>
			<div class="contact-item">
				<span class="icon"><i class="fa fa-map-marker-alt"></i></span>
				<div class="item-content">
					<h3 class="title-text mb-0"><?php echo esc_html__( 'office address', 'fw' );?></h3>
					<span class="contact-text"><?php echo esc_html( $instance['oa'] ); ?></span>
				</div>
			</div>
		</li>
		<li>
			<div class="contact-item">
				<span class="icon"><i class="fa fa-envelope"></i></span>
				<div class="item-content">
					<h3 class="title-text mb-0"><?php echo esc_html__( 'Email Address', 'fw' );?></h3>
					<span class="contact-text"><?php echo esc_html( $instance['em'] ); ?></span>
				</div>
			</div>
		</li>
	</ul>
	<?php } else {
	$items= $instance['contact_us']['style1']['social_links'];  ?>
	<ul class="contact-info-style1">
	<?php foreach ($items as $item) { ?>
		<li class="list-item">
			<i class="<?php echo $item['option_1']['icon-class'] ;?>"></i>
				<p class="mb-0"><?php echo $item['option_2'] ;?></p>
		</li>
	<?php } ?>
	</ul>


	<?php } ?>
</div>
<?php echo $after_widget; ?>