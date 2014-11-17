<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php if( has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail( 'pchc-thumb-provider', array(
            'class' =>  'circle thumb-provider align-right shadow-z-1',
          )
        ); ?>
      <?php endif; ?>
      <?php if( get_field('title') ) : ?>
        <p class="byline vcard" itemprop="about"><?php echo get_field('title'); ?></p>
      <?php endif; ?>
    </header>
      <div class="entry-content">
        <?php the_content(); ?>
        
        <?php
          if( function_exists('get_fields') )
            $fields = get_fields();
          
          
          if( $fields )
          {
            foreach( $fields as $field_name => $value )
            {
              // get_field_object( $field_name, $post_id, $options )
              // - $value has already been loaded for us, no point to load it again in the get_field_object function
              if( $value && $field_name != 'title' ) {
              
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
      </div>
    <footer>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
