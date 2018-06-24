<?php
/**
 * Copyright (c) 2018. Tiafeno Finel
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 * the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 * FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 * IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 */

class WP_Orangea {
	public function __construct() {
	}

	/**
	 * Ajouter les posts meta ACF dans la variable post
	 *
	 * @param WP_POST $post
	 * @return mixed
	 */
	private static function add_post_fields( &$post ) {
		$styles = get_field('styles', $post->ID);

		$post->__org_subtitle         = get_field( '__org_subtitle', $post->ID );
		$post->__org_type             = get_field( '__org_type', $post->ID );

		// Elements
		$elements = get_field('elements', $post->ID);
		$post->__org_section_id = $elements['__org_section_id'];
		$post->__org_section_class = $elements['__org_section_class'];
		$post->__org_activity_menu = $elements['__org_activity_menu'];

		$post->__org_desc          = get_field( '__org_desc', $post->ID );

		// Booking & Contact
		$booking = get_field('booking_&_contact', $post->ID);
		$post->__org_reservation_link = $booking['__org_book_link'];
		$post->__org_info             = $booking['__org_info'];

		$post->__bg           = get_field( '__bg', $post->ID );
		$post->__org_bg_img   = get_field( '__org_bg_img', $post->ID );
		$post->__org_bg_galeries   = get_field( '__org_bg_galeries', $post->ID );

		// Styles group
		$post->__org_bg_color = $styles['__org_bg_color'];
		$post->__org_bg_pos   = $styles['__org_bg_pos'];
		$post->__org_bg_size   = $styles['__org_bg_size'];
		$post->__org_bg_attachment   = $styles['__org_bg_attachment'];

		return $post;
	}

	/**
	 * @param array $posts
	 * @return array|bool
	 */
	public static function get_acf_params( $posts ) {
		if ( ! function_exists( 'get_field' ) ) {
			return false;
		}
		$posts_acf = [];
		if ( is_array( $posts ) && ! empty( $posts ) ) {
			foreach ( $posts as $post ):
				self::add_post_fields( $post );
				array_push( $posts_acf, $post );
			endforeach;
			return $posts_acf;
		} else {
			return false;
		}
	}

	/**
	 * @param array $posts
	 * @return array|bool
	 */
	public static function get_page_acf_params( &$post ) {
		if ( ! function_exists( 'get_field' ) ) {
			return false;
		}
		if ( ! empty( $post ) ) {
			$position = get_field( 'bg_position', $post->ID );
			if ($position == 'custom') {
				$position = get_field( 'bg_custom_position', $post->ID );
			}
			$post->background    = get_field( 'background', $post->ID );
			$post->bg_color      = get_field( 'bg_color', $post->ID );
			$post->bg_image      = get_field( 'bg_image', $post->ID );
			$post->bg_position   = $position;
			$post->bg_size       = get_field( 'bg_size', $post->ID );
			$post->bg_attachment = get_field( 'bg_attachment', $post->ID );

			return $post;
		} else {
			return false;
		}
	}

	public static function get_acf_params_postid( &$post_acf, $post_id ) {
		if ( ! function_exists( 'get_field' ) ) {
			return false;
		}
		if ( is_int( $post_id ) ) {
			$post = get_post( $post_id );
			self::add_post_fields( $post );
			$post_acf = $post;
		}

		return null;
	}

	/**
	 * @desc Récuperer les post de type section
	 * @return array
	 */
	public function get_published_sections() {
		$quered = [];

		// Récuperer le code de la langue en actuelle e.g: fr
		$localLang = pll_current_language();
		$args      = [
			'post_type'      => _OG_POSTTYPE_,
			'post_status'    => 'publish',
			'posts_per_page' => - 1,
			'lang'           => $localLang
		];
		query_posts( $args );
		if ( have_posts() ) {
			while ( have_posts() ): the_post();
				setup_postdata( get_the_ID() );
				// Il est important d'appliquer la filtre 'the_content'
				// Pour executer les autres filtres qui s'accroche sur cette l'article
				apply_filters( 'the_content', get_the_content() );
				// Récuperer et enregistrer l'object WP_Post de cette article
				array_push( $quered, get_post() );
			endwhile;
		}
		wp_reset_query();

		return $quered;
	}

	public function get_menu_translations() {
		$Menu = [];
		// Return false if function polylang isn't exist
		if ( ! function_exists( "PLL" ) ) {
			return false;
		}

		$available_post_ids   = PLL()->model->post->get_translations( get_the_ID() );
		$current_page_trad_id = pll_get_post( get_the_ID(), pll_current_language() );
		foreach ( $available_post_ids as $key => $id ) {
			if ( $id != $current_page_trad_id ) {
				$available_lang = PLL()->model->get_languages_list();
				foreach ( $available_lang as $lang ) {
					if ( $key == $lang->slug ) {
						array_push( $Menu, $lang );
					}
				}
			}
		}

		return $Menu;
	}
}