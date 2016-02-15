<?php
get_header();
get_template_part( 'nav', 'single' );
?>

<section class="text-center">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="section-heading">
						<h2><?php the_title(); ?></h2>
					</div>
					<?php the_content(); ?>
				<?php endwhile; ?>
			<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<a href="#" id="scrollToTop"><i class="materialButton round fa fa-angle-up fa-3x"></i></a>

<?php get_footer(); ?>
