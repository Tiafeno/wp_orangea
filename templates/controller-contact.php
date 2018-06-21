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

if ( isset( $post_acf ) ) {
	$section = Arrays::filter( $post_acf, function ( $value ) {
		return $value->__org_type == "contact";
	} );
}

if ( ! empty( $section ) ) :
	list( $contact ) = array_values( $section );
	$social_media = get_field( 'reseaux_social', 'option' );
	$socials      = [];
	foreach ( $social_media as $key => $social ) {
		if ( empty( $social_media[ $key ] ) ) {
			continue;
		}
		$content = [ 'url' => $social_media[ $key ], 'icon' => $key ];
		array_push( $socials, (object) $content );
	}
	$globalParams = [
		'section' => $contact,
		'socials' => $socials
	];
	og_get_view_content( 'contact', $globalParams );
endif;
?>