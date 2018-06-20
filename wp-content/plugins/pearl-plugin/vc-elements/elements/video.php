<?php
/*
Element Description: Video
*/

// Element Class
class Pearl_VC_Video extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'element_mapping' ) );
		add_shortcode( 'pearl_video', array( $this, 'element_output' ) );
	}

	// Element Mapping
	public function element_mapping() {

		// Stop all if VC is not enabled
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			return;
		}

		// Map the block with vc_map()
		vc_map(

			array(
				'name'        => esc_html__( 'Pearl Video', 'pearl-plugin' ),
				'base'        => 'pearl_video',
				'description' => esc_html__( 'Display video with a heading and author name.', 'pearl-plugin' ),
				'category'    => esc_html__( 'Antarctica Theme', 'pearl-plugin' ),
				'params'      => array(
					array(
						'type'       => 'dropdown',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( 'Video Style', 'pearl-plugin' ),
						'param_name' => 'video_style',
						'value'      => array(
							'Style 1' => '1',
							'Style 2' => '2',
						),
					),
					array(
						'type'       => 'attach_image',
						'holder'     => 'p',
						'heading'    => esc_html__( 'Image for Video', 'pearl-plugin' ),
						'param_name' => 'video_image',
						'dependency' => array(
							'element' => 'video_style',
							'value' => '2',
						),
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'heading',
						'heading'    => esc_html__( 'Heading', 'pearl-plugin' ),
						'param_name' => 'heading',
						'dependency' => array(
							'element' => 'video_style',
							'value' => '1',
						),
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'author',
						'heading'    => esc_html__( 'Author', 'pearl-plugin' ),
						'param_name' => 'author',
						'dependency' => array(
							'element' => 'video_style',
							'value' => '1',
						),
					),
					array(
						'type'       => 'textfield',
						'holder'     => 'p',
						'class'      => 'url',
						'heading'    => esc_html__( 'Video URL', 'pearl-plugin' ),
						'param_name' => 'url',
					),
				)
			)
		);

	}


	// Element HTML
	public function element_output( $atts ) {

		// Params extraction
		extract(
			shortcode_atts(
				array(
					'video_style' => '',
					'video_image' => '',
					'heading' => '',
					'author'  => '',
					'url'  => '',
				),
				$atts
			)
		);

		ob_start();

		if ( '2' == $video_style ) {

			echo '<section class="our-video our-video-2">';

			if ( ! empty( $url ) && ! empty( $video_image ) ) {
				echo '<a class="video-popup" data-rel="lightcase" href="' . esc_url( $url ) . '">';
				echo '<i class="fa fa-play"></i>';
				echo '<img src="' . esc_url( wp_get_attachment_image_url( $video_image, 'full' ) ) . '" alt="">';
				echo '</a>';
			}
			
			echo '</section>';

		} else {

			echo '<section class="our-video our-video-1 sections section-padding">';

			echo '<div class="container">';

			if ( ! empty( $url ) ) {
				echo '<a class="play-video" data-rel="lightcase" href="' . esc_url( $url ) . '"></a>';
			}

			if ( ! empty( $heading ) ) {
				echo '<h3 class="title">' . esc_html( $heading ) . '</h3>';
			}

			echo '<span class="line"></span>';

			if ( ! empty( $author ) ) {
				echo '<p class="author">' . esc_html( $author ) . '</p>';
			}

			echo '</div>';

			echo '</section>';
		}

		return ob_get_clean();

	}

} // End Element Class

// Element Class Init
new Pearl_VC_Video();