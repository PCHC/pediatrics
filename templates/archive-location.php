<article <?php post_class(); ?>>
  <header>
  	<a href="<?php the_permalink(); ?>">
	  	<?php if( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'medium', array(
					'class'	=>	'',
				)
			); ?>
		<?php endif; ?>
	    <h2 class="entry-title"><?php the_title(); ?></h2>
    </a>
  </header>
</article>