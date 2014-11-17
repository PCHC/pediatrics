<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <?php if( has_post_thumbnail() ) : ?>
        <div class="featured-image">
        <?php the_post_thumbnail( 'large', array(
            'class' =>  '',
          )
        ); ?>
        </div>
      <?php endif; ?>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <p class="byline"><?php echo get_field('address'); ?></p>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>

      <?php
      $fields = get_fields();
      
      if( $fields )
      {
        foreach( $fields as $field_name => $value )
        {
          // get_field_object( $field_name, $post_id, $options )
          // - $value has already been loaded for us, no point to load it again in the get_field_object function
          if( $value && $field_name != 'address' && $field_name != 'show_map' && $field_name != 'map' ) {
          
            $field = get_field_object($field_name, false, array('load_value' => false));
            
            ?>
            
            <section class="entry-details">
              <h3><?php echo $field['label']; ?></h3>
              <?php echo wpautop( $value ); ?>
            </section>
            
            <?php
          }
        }
      }
      ?>

      <?php
      $map = get_field('map');

      if( !empty($map) ):
      ?>
      <div class="acf-map">
        <div class="marker" data-lat="<?php echo $map['lat']; ?>" data-lng="<?php echo $map['lng']; ?>"></div>
      </div>
      <?php endif; ?>

    </div>
    <footer>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
