<?php
/**
 * Created by IntelliJ IDEA.
 * User: Tiafeno
 * Date: 06/05/2018
 * Time: 16:36
 */

class WP_orangea_services {

	/**
	 * @param $location string
	 *
	 * @return array|false
	 */
	public static function get_menu_items_by_location ($location) {
		$locations = get_nav_menu_locations();
		$menu = wp_get_nav_menu_object( $locations[ $location ] );
		$menu_items = wp_get_nav_menu_items( $menu->term_id);
		return $menu_items;
	}

	public static function get_menu_items_content ($menu_items = array()) {
		$items = [];
		if ( ! is_array($menu_items)) return $menu_items;
		foreach ($menu_items as $menu) {
			if ($menu->object != "post") continue;

			$post = get_post($menu->object_id);
			array_push($items, [
				'post_content' => apply_filters( "the_content", $post->post_content ),
				'ID' => $post->ID,
				'post_title' => $post->post_title
			]);
		}
		return $items;
	}

	/**
	 * Permet d'enregistrer une variable dans une variable global definie $og_global_args
	 * @param array $args
	 * @return void
	 */
	public static function set_to_global_args ($args) {
		global $og_global_args;
		if (isset($og_global_args) && is_array($og_global_args)) :
			foreach ($args as $name => $value) {
				$og_global_args[$name] = $value;
			}
		endif;
	}

	public static function embed_wpb_custom_css ($post_id) {
		$shortcodes_custom_css = get_post_meta( $post_id, '_wpb_shortcodes_custom_css', true );
		if ( ! empty( $shortcodes_custom_css ) ) {
			$shortcodes_custom_css = strip_tags( $shortcodes_custom_css );
			echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
			echo $shortcodes_custom_css;
			echo '</style>';
		}
	}

}