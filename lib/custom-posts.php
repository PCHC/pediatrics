<?php
/**
 * Functionality for custom posts
 */

/**
 * Order by 2nd word in title
 */
function order_by_lastname( $orderby ) {

    // first you should check to make sure sure you're only filtering the particular query
    // you want to hack. return $orderby if its not the correct query;
    global $wpdb;
	$orderby_statement = "SUBSTR( LTRIM({$wpdb->posts}.post_title), LOCATE(' ',LTRIM({$wpdb->posts}.post_title)))";
	return $orderby_statement;
}

/**
 * Pre get_posts query
 */
function peds_pre_get_posts( $query ) {
	// validate
	if( is_admin() ){
		return $query;
	}

	if( isset( $query->query_vars['post_type'] ) ) {
		if( $query->query_vars['post_type'] == 'staff' ) {
			if( $query->query_vars['orderby'] != 'rand' ) {
				add_filter( 'posts_orderby', 'order_by_lastname' );
				$query->set( 'posts_per_page', -1 );
			}
		}
	}

	return $query;
}
add_action('pre_get_posts', 'peds_pre_get_posts');

/**
 * Adds Peds_Staff_Widget widget.
 */
class Peds_Staff_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'peds_staff_widget', // Base ID
			__('Featured Staff', 'roots'), // Name
			array( 'description' => __( 'Shows a random staff member in a featured position.', 'roots' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
	
     	echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		$args = array(
			'post_type' 		=> 'staff',
			'posts_per_page'	=> 1,
			'orderby' 			=> 'rand'
		);
		wp_reset_query();
		$staff_query = new WP_Query( $args );
		while( $staff_query->have_posts() ) : $staff_query->the_post(); ?>
			<a href="<?php the_permalink(); ?>">
				<?php if( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'pchc-thumb-provider', array(
						'class'	=>	'circle shadow-z-1 align-left',
					)
				); ?>
				<?php endif; ?>
				<h4><?php the_title(); ?></h4>
			</a>
			<p class="byline"><?php echo get_field('title'); ?></p>
			<p><?php the_content(); ?></p>
		<?php endwhile;
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'roots' );
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} // class Peds_Staff_Widget
// register Peds_Staff_Widget widget
function register_peds_staff_widget() {
    register_widget( 'Peds_Staff_Widget' );
}
add_action( 'widgets_init', 'register_peds_staff_widget' );