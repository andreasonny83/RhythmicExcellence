<?php
get_header();
get_template_part( 'nav', 'home' );
get_template_part( 'logo' );
?>
<section class="text-center">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="section-heading">
						<h2><?php the_title(); ?></h2>
						<i class="fa fa-2x fa-angle-down"></i>
					</div>
					<?php the_content(); ?>
				<?php endwhile; ?>
			<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<a href="#" id="scrollToTop"><i class="materialButton round fa fa-angle-up fa-3x"></i></a>

<?php
get_template_part( 'contacts' );
get_footer();
?>
