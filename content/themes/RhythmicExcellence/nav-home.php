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
				wp_nav_menu(array(
					'theme_location' => 'header-menu',
					'menu_id' => 'menu-main-menu-desktop',
					'container' => false
				));
				?>
			</div>
		</div>
	</div>
	<div class="container left">
    <?php
    wp_nav_menu(array(
      'theme_location' => 'responsive-menu',
      'menu_id' => 'disciplines-menu',
      'container' => false
    ));
    ?>
	</div>
</nav>

<body id="home" class="home">
