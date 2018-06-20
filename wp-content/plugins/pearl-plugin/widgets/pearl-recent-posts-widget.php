<?php

add_action( 'widgets_init', function () {
	register_widget( 'Pearl_Recent_Posts_Widget' );
} );

class Pearl_Recent_Posts_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'pearl_recent_posts_widget',
			'description' => 'Display recent blog posts.',
		);

		parent::__construct( 'pearl_recent_posts_widget', 'Pearl - Recent Posts', $widget_ops );
	}


	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		?>
		<ul>
			<?php

				$number_of_posts = ( ! empty( $instance['number_of_posts'] ) ) ? $instance['number_of_posts'] : 3;
				$order_by        = ( ! empty( $instance['sort_by'] ) ) ? $instance['sort_by'] : 'date';

				// WP_Query arguments
				$post_args = array(
					'post_type'           => 'post',
					'posts_per_page'      => intval( $number_of_posts ),
					'meta_key'            => '_thumbnail_id',
					'meta_compare'        => 'EXITS',
					'orderby'             => esc_html( $order_by ),
					'ignore_sticky_posts' => 1
				);

				// The Query
				$query = new WP_Query( $post_args );

				// The Loop
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();

						?>
						<li>
							<div class="post-thumb">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'pearl_image_size_102_80' ); ?>
								</a>
							</div>
							<div class="post-content">
								<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<span class="post-date"><?php echo pearl_time_ago(); ?></span>
							</div>
						</li>
						<?php
					}
					wp_reset_postdata();

				} else {
					echo '<h4>' . esc_html__( 'No Posts Found!', 'pearl-antarctica' ) . '</h4>';
				}
			?>
		</ul>
		<?php
		echo $args['after_widget'];
	}


	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 *
	 * @return void
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		$title   = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Recent Posts', 'pearl-antarctica' );
		$count   = ! empty( $instance['number_of_posts'] ) ? $instance['number_of_posts'] : esc_html__( '3', 'pearl-antarctica' );
		$sort_by = ! empty( $instance['sort_by'] ) ? $instance['sort_by'] : esc_html__( 'recent', 'pearl-antarctica' );
		?>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'pearl-antarctica' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'number_of_posts' ) ); ?>"><?php esc_html_e( 'Number of Posts', 'pearl-antarctica' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number_of_posts' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'number_of_posts' ) ); ?>" type="text"
			       value="<?php echo esc_attr( $count ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'sort_by' ) ); ?>"><?php esc_html_e( 'Sort By:', 'pearl-antarctica' ) ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'sort_by' ) ); ?>"
			        id="<?php echo esc_attr( $this->get_field_id( 'sort_by' ) ); ?>" class="widefat">
				<option
					value="date"<?php selected( $sort_by, 'date' ); ?>><?php esc_html_e( 'Most Recent', 'pearl-antarctica' ); ?></option>
				<option
					value="rand"<?php selected( $sort_by, 'rand' ); ?>><?php esc_html_e( 'Random', 'pearl-antarctica' ); ?></option>
			</select>
		</p>
		<?php
	}


	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {

		// sanitization of widget options on save
		foreach ( $new_instance as $key => $value ) {
			$updated_instance[ $key ] = sanitize_text_field( $value );
		}

		return $updated_instance;
	}
}