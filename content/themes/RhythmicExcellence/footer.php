<footer class="text-center">
  <div class="container">
    <div class="social-bar col-md-12">
      <div class="row">
        <h3>Follow our social media pages</h3>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">

        <ul id="social-menu">
        <?php
        $locations  = get_nav_menu_locations();
        $menu       = wp_get_nav_menu_object( $locations['social-menu'] );
        $menu_items = wp_get_nav_menu_items( $menu->term_id );

        foreach ( $menu_items as $key => $menu_item ) {
          $title        = $menu_item->title;
          $url          = $menu_item->url;
          $button_class = $menu_item->classes[0];
          $li_class     = 'col-xs-6 col-sm-2';

          if ( $key === 0 ) {
            $li_class = 'col-xs-6 col-sm-2 col-sm-offset-1';
          }
          else if ( $key === 4 ) {
            $li_class = 'col-xs-12 col-sm-2';
          }

          $output  = '<li class="' . $li_class . '"><a href="' . $url . '">';
          $output .= '<i class="materialButton round fa ' . $button_class . ' fa-3x"></i></a></li>';
          echo $output;
        }
        ?>
        </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="bottom">
    <div class="col-md-offset-1 col-md-10 col-sm-12">
      <p>Copyright &copy; 2016 All right reserved. | Powered by <a href="https://github.com/andreasonny83">SonnY</a></p>
    </div>
  </div>
</footer>
<script src="<?php bloginfo('template_directory');?>/scripts/app.min.js" async></script>
<?php wp_footer(); ?>
</body>
</html>
