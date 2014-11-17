<article <?php post_class(); ?>>
  <header>
  	<a href="<?php the_permalink(); ?>">
	  	<?php if( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'pchc-thumb-provider', array(
					'class'	=>	'circle thumb-provider shadow-z-1',
				)
			); ?>
		<?php endif; ?>
	    <h2 class="entry-title"><?php the_title(); ?></h2>
    </a>
    <?php if( get_field('title') ) : ?>
		<p class="byline" itemprop="about"><?php echo get_field('title'); ?></p>
	<?php endif; ?>
  </header>
</article>