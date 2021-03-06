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

use Underscore\Types\Arrays;

global $og_global_args;

if ( isset( $post_acf ) ) {
	$section = Arrays::filter( $post_acf, function ( $value ) {
		return $value->__org_type == "accommodation";
	} );
}

if ( ! empty( $section ) ):
	list( $accommodation ) = array_values( $section );
	
	$parents = [];
	// Récuperer la galleries
	$galleries = get_field( '__org_bg_galeries', $accommodation->ID );
	$menu      = WP_orangea_services::get_menu_items_by_location( 'hebergement' );
	if ( $menu ) :
		$parents = Arrays::filter( $menu, function ( $value ) {
			return $value->menu_item_parent == 0;
		} );
		$parents = array_values( $parents );
	endif;
	$globalParams = [
		'section'    => $accommodation,
		'background' => WP_orangea_services::get_post_bg_options( $accommodation ),
		'galleries'  => $galleries ? $galleries : null,
		'parents'    => $parents,
		'menu'       => $menu
	];
	og_get_view_content( 'accommodation', $globalParams );
endif;
