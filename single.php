<?php if( get_post_type() == 'post' || get_post_type() == 'page') : 
	get_template_part('templates/content', 'single');
else :
	get_template_part('templates/content', get_post_type() );
endif; ?>