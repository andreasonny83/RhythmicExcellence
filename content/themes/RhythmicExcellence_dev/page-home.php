<?php
/*
Template Name: HomePage
*/
get_header();
get_template_part( 'nav', 'home' );
get_template_part( 'logo' );
get_template_part( 'verify' );
?>
<section id="news">
	<div class="container">
			<h1>News</h1>
			<article>
				<?php
				query_posts( array ( 'category_name' => 'news', 'posts_per_page' => 1 ) );
				while ( have_posts() ) : the_post();
					echo '<h3>';
					the_title();
					echo '</h3>';
					the_content();
				?>
				<a href="<?php bloginfo( 'url' ); ?>/news/">Read older news</a>
			</article>
			<?php
			endwhile;
			wp_reset_query();
			?>
	</div>
</section>
<section id="disciplines">
	<div class="container">
		<div class="row text-center">
			<?php
			$args = array( 'posts_per_page' => 10, 'category_name' => 'Disciplines', 'order' => 'ASC', 'orderby' => 'meta_value', 'meta_query' => array( array( 'key' => 'order_in_archive' ) ) );
			$myposts = get_posts( $args );
			foreach ( $myposts as $post ) : setup_postdata( $post );
				$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
			?>
				<div class="col-xs-6 col-md-4 col-lg-3 disciplines responsive">
					<a class="boxed" href="<?php echo get_permalink(); ?>">
						<h5 class="higlighted"><?php the_title(); ?></h5>
						<div class="avatar">
							<img src="<?php echo $image_url[0]; ?>" alt="" class="img-responsive img-circle">
						</div>
					</a>
				</div>
			<?php endforeach;
			wp_reset_postdata(); ?>
		</div>
	</div>
</section>

<section id="aboutus" class="text-center">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-heading">
					<h3>Our Team</h3>
				</div>
			</div>
		</div>
	</div>

	<div class="container section">
		<div class="row text-center">
			<?php
			$args = array( 'posts_per_page' => 10, 'category_name' => 'Team', 'order' => 'ASC', 'orderby' => 'meta_value', 'meta_query' => array( array( 'key' => 'order_in_archive' ) ) );
			$myposts = get_posts( $args );
			foreach ( $myposts as $post ) : setup_postdata( $post );
				$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
				?>
				<div class="col-xs-6 col-md-4 responsive">
					<div>
						<a href="#" class="boxed">
							<div>
								<h5 class="higlighted"><?php the_title(); ?></h5>
								<div class="avatar">
									<img src="<?php echo $image_url[0]; ?>" alt="" class="img-responsive img-circle">
								</div>
								<span class="accordion"><?php the_content(); ?></span>
							</div>
						</a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div> <!-- our team  -->

	<div class="container section">
		<div class="row">
			<div class="col-lg-12">
				<?php
				$content_post = get_post( 28 );
				$content = $content_post->post_content;
				?>
				<div class="section-heading">
					<h2><?php echo $content_post->post_title; ?></h2>
				</div>
				<p><?php echo $content; ?></p>
			</div>
		</div>
	</div>
</section>

<div id="location" class="map-container">
	<div id="map-canvas"></div>
</div>

<a href="#" id="scrollToTop"><i class="materialButton round fa fa-angle-up fa-3x"></i></a>

<script type="text/javascript"
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEUtAfmitoN_eSd9eGxeyI3siB3w3E-WM">
</script>
<?php
get_template_part( 'contacts' );
get_footer();
?>
