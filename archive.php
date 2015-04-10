<?php get_template_part('templates/page', 'header'); ?>
<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'roots'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php if( get_post_type() == 'location' ) : ?>
  <div class="acf-map shadow-z-1">
    <?php while (have_posts()) : the_post(); ?>
      <?php $map_location = get_field('map'); ?>
      <div class="marker" data-lat="<?php echo $map_location['lat']; ?>" data-lng="<?php echo $map_location['lng']; ?>">
        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
        <p class="address"><?php echo get_field('address'); ?></p>
      </div>
    <?php endwhile; ?>
  </div>
<?php endif; ?>

<?php if( get_post_type() == 'staff' ) : 
  $penpeds_staff = new WP_Query(array(
    'numberposts' =>  -1,
    'post_type' =>    'staff',
    'meta_key' =>     'location',
    'meta_value' =>   'penpeds'
  ));
  
  if ($penpeds_staff->have_posts()) : ?>
    <h2>Penobscot Pediatrics</h2>
    <section class="main-content">
      <?php while ($penpeds_staff->have_posts()) : $penpeds_staff->the_post(); ?>
        <?php get_template_part('templates/archive', get_post_type()); ?>
      <?php endwhile; ?>
    </section>
  <?php endif; ?>

  <?php
  $hhhc_staff = new WP_Query(array(
    'numberposts' =>  -1,
    'post_type' =>    'staff',
    'meta_key' =>     'location',
    'meta_value' =>   'hhhc'
  ));
  
  if ($hhhc_staff->have_posts()) : ?>
    <h2>Helen Hunt Health Center</h2>
    <section class="main-content">
      <?php while ($hhhc_staff->have_posts()) : $hhhc_staff->the_post(); ?>
        <?php get_template_part('templates/archive', get_post_type()); ?>
      <?php endwhile; ?>
    </section>
  <?php endif; ?>

  <?php
  $hhhc_staff = new WP_Query(array(
    'numberposts' =>  -1,
    'post_type' =>    'staff',
    'meta_key' =>     'location',
    'meta_value' =>   'seaport'
  ));
  
  if ($hhhc_staff->have_posts()) : ?>
    <h2>Seaport Community Health Center</h2>
    <section class="main-content">
      <?php while ($hhhc_staff->have_posts()) : $hhhc_staff->the_post(); ?>
        <?php get_template_part('templates/archive', get_post_type()); ?>
      <?php endwhile; ?>
    </section>
  <?php endif; ?>

<?php else : ?>
  <section class="main-content">
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/archive', get_post_type()); ?>
    <?php endwhile; ?>
  </section>
<?php endif; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav class="post-nav">
    <ul class="pager">
      <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
      <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
    </ul>
  </nav>
<?php endif; ?>
