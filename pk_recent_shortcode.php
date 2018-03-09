<?php
/* Shortcode to List Post based on Parameters */
add_shortcode( 'blog', 'post_list' );
function post_list( $atts ) {
	ob_start();
	
	// Define attributes and their defaults
	extract( shortcode_atts( array (
	'type' => 'post',
	'order' => 'ASC',
	'orderby' => 'title',
	'posts' => -1
	), $atts ) );
	
	// Define query parameters based on attributes
	$options = array(
	'post_type' => $type,
	'order' => $order,
	'orderby' => $orderby,
	'posts_per_page' => $posts,
	'category_name' => $category,
	);
	
	/* Query For Most Recent Posts */
	$query = new WP_Query( $options );
	if ( $query->have_posts() ) { ?>
	<div class="row post-list">
		<?php $m=1; while ( $query->have_posts() ) : $query->the_post(); 
			?>
		<div class="col-md-4" id="post-<?php the_ID(); ?>">
			<div class="card">
				<?php the_post_thumbnail( 'thumbnail', ['class' => 'card-img-top'] ); ?>
				<div class="card-body">
					<?php the_title('<h4 class="card-title">', '</h4>'); 
					$cats = get_the_category(); 
					$cat_name = $cats[0]->name; 
					$posttags = get_the_tags();
					if( $cats )
					{
						echo '<p>Category: '.$cat_name.'</p>';	
					}
					if ($posttags) {
						echo 'Tags: ';
						$tag_count = 1;
						foreach($posttags as $tag) {
							if($tag_count == count($posttags))
							{
								echo $tag->name; 	
							}
							else
							{
								echo $tag->name . ','; 	
							}
							$tag_count++;
						}
					}
					?>
					<p class="card-text"><?php the_excerpt(); ?></p>
					<a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More >></a>
				</div>
			</div>
		</div>
		<?php 
			if ( $m % 3 === 0 ) { echo '</div><div class="row">'; }
			$m++;
			endwhile;
		/* Reset the Query */	
		wp_reset_postdata(); ?>
	</div>
	<?php
	$myvariable = ob_get_clean();
	return $myvariable; // Return the data to function
	}
}
?>