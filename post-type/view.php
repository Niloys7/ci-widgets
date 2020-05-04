
<?php
// The Query
$args = array(
 			'post_type' => 'post',
 			'order' => $instance['ordr'],  // ASC
 			'ignore_sticky_posts' => $instance['isp'], // true
 			'posts_per_page' => $instance['ppp'], 
 			'cat' => $instance['cat'],//(int) - use category id.'cat' => 5,//(int) - use category id.
);
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {  


echo $before_widget; ?>
		
<div class="news-feeds  ul-li-block clearfix">
	

	<?php echo $before_title.'' .esc_html( $instance['title'] ).''. $after_title;  ?>
	
	<ul class="clearfix">
	<?php
	while ( $the_query->have_posts() ) {
		$the_query->the_post(); ?>
		
		<li>
			<?php if(has_post_thumbnail()) : ?>
			<div class="image-container">
				<?php the_post_thumbnail( $size = 'thumbnail', $attr = '' ); ?>
			</div>
		<?php endif; ?>
			<div class="item-content">
				<a href="<?php the_permalink(); ?>" class="item-title"><?php the_title(); ?></a>
				<small class="post-date"><i class="far fa-clock"></i> <?php echo get_the_date(); ?></small>
			</div>
		</li>
		


	<?php }
	echo '	</ul></div>';
	/* Restore original Post Data */
	wp_reset_postdata();
} else {
	// no posts found
	 esc_html_e( 'Sorry, no posts matched your criteria.' ); 
}

echo $after_widget; 

?>
	
