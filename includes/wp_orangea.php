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
	 * @param WP_POST $post
	 * @return mixed
	 */
	private static function add_post_fields (&$post) {
		$post->__org_subtitle = get_field('__org_subtitle', $post->ID);
		$post->__org_type = get_field('__org_type', $post->ID);
		$post->__org_desc = get_field('__org_desc', $post->ID);
		$post->__org_reservation_link = get_field('__org_reservation_link', $post->ID);
		$post->__org_info = get_field('__org_info', $post->ID);
		$post->__org_activity_img = get_field('__org_activity_img', $post->ID);

		$post->__bg = get_field('__bg', $post->ID);
		$post->__org_bg_color = get_field('__org_bg_color', $post->ID);
		$post->__org_bg_img = get_field('__org_bg_img', $post->ID);
		$post->__org_bg_pos = get_field('__org_bg_pos', $post->ID);

		return $post;
	}
	/**
	 * @param array $posts
	 * @return array|bool
	 */
	public static function get_acf_params ($posts) {
		if ( ! function_exists('get_field')) return false;
		$posts_acf = [];
		if (is_array( $posts ) && ! empty($posts)) {
			foreach ($posts as $post):
				self::add_post_fields( $post );
				array_push( $posts_acf, $post );
			endforeach;

			return $posts_acf;
		} else
			return false;
	}

	public static function get_acf_params_postid (&$post_acf, $post_id) {
		if ( ! function_exists('get_field')) return false;
		if (is_int($post_id)) {
			$post = get_post($post_id);
			self::add_post_fields( $post );
			$post_acf = $post;
		}
		return null;
	}

	/**
	 * @desc Récuperer les post de type section
	 * @return array
	 */
	public function get_published_sections () {
		$quered = [];
		$localLang = pll_current_language();
		$args = [
			'post_type' => _OG_POSTTYPE_,
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'lang' => $localLang
		];
		query_posts( $args );
		if (have_posts()) {
			while (have_posts()): the_post();
				apply_filters('the_content', get_the_content());
				array_push($quered, get_post(get_the_ID()));
			endwhile;
		}
		wp_reset_query();
		return $quered;
	}

	public function get_menu_translations () {
		$Menu = [];

		// Return false if function polylang isn't exist
		if ( ! function_exists("PLL")) return false;

		$available_post_ids = PLL()->model->post->get_translations(get_the_ID());
		$current_page_trad_id = pll_get_post(get_the_ID(), pll_current_language());
		foreach ($available_post_ids as $key => $id) {
			if ($id != $current_page_trad_id) {
				$available_lang = PLL()->model->get_languages_list();
				foreach ( $available_lang as $lang) {
					if ($key == $lang->slug) {
						array_push($Menu, $lang);
					}
				}
			}
		}
		return $Menu;
	}
}