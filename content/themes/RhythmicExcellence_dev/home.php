<?php
get_header();
get_template_part( 'nav', 'single' );
?>

<section id="news">
	<div class="container">
			<h1>News</h1>
			<article>
				<?php
				query_posts( array ( 'category_name' => 'news', 'posts_per_page' => 10 ) );
				while ( have_posts() ) : the_post();
					echo '<h3>';
					the_title();
					echo '</h3>';
					the_content();
				?>
				<hr>
			</article>
			<?php
			endwhile;
			wp_reset_query();
			?>
	</div>
</section>

<a href="#" id="scrollToTop"><i class="materialButton round fa fa-angle-up fa-3x"></i></a>

<?php
get_template_part( 'contacts' );
get_footer();
?>
