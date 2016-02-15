<nav class="main">
	<div class="overflow"></div>
	<div class="top">
		<div class="container">
			<div class="row">
				<div class="menu-logo">
					<a href="#" id="responsive-menu"><i class="fa fa-bars"></i></a>
					<h1>Rhythmic Excellence</h1>
				</div>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'header-menu',
					'menu_id'        => 'menu-main-menu-desktop',
					'container'      => false
				) );
				?>
			</div>
		</div>
	</div>
	<div class="container left">
		<ul id="disciplines-menu">
			<li class="page_item page-item-24">
				<a href="<?php bloginfo( 'url' ); ?>">Home</a>
			</li>
			<li class="page_item page-item-24">
				<a href="<?php bloginfo( 'url' ); ?>/news/">News</a>
			</li>
			<?php
			$args = array( 'posts_per_page' => 10, 'category_name' => 'Disciplines', 'order' => 'ASC', 'orderby' => 'meta_value', 'meta_query' => array( array('key' => 'order_in_archive') ) );
			$myposts = get_posts( $args );
			foreach( $myposts as $post ) : setup_postdata( $post ); ?>
				<li class="page_item page-item-24">
					<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</nav>

<body id="home" class="home">
