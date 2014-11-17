<header class="banner-top navbar-fixed-top" role="banner">
  <div class="navbar navbar-main">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse-primary">
          <span class="sr-only">Toggle navigation</span>
          <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
      </div>

      <nav class="collapse navbar-collapse navbar-collapse-primary" role="navigation">
        <?php
          if (has_nav_menu('primary_navigation')) :
            wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
          endif;
        ?>
      </nav>
    </div>
  </div>
  <div class="navbar navbar-secondary">
    <div class="container">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-secondary">
        <span class="sr-only">Toggle navigation</span>
        <i class="fa fa-bars"></i>
      </button>
      <nav class="collapse navbar-collapse navbar-collapse-secondary" role="navigation">
        <?php
          if (has_nav_menu('secondary_navigation')) :
            wp_nav_menu(array('theme_location' => 'secondary_navigation', 'menu_class' => 'nav navbar-nav'));
          endif;
        ?>
      </nav>
    </div>
  </div>
</header>
