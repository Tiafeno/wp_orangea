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

if (isset($post_acf))
	$section = Arrays::filter( $post_acf, function ( $value ) {
		return $value->__org_type == "galerie";
	} );

if ( ! empty( $section ) ) :
	list( $galerie ) = array_values( $section );
	WP_orangea_services::embed_wpb_custom_css( $galerie->ID );
	if ( ! empty($galerie->__bg) ) {
	  $background = new stdClass();
	  switch ($galerie->__bg):
      case 'color':
        $background->color = $galerie->__org_bg_color;
        break;
      case 'image':
        $background->url = $galerie->__org_bg_img[ 'url' ];
        $background->color = $galerie->__org_bg_color;
        break;
      endswitch;
  }
  $backgroundPosition = explode('_', $galerie->__org_bg_pos);
  og_get_view_content('galerie', [
    'section' => $galerie,
    'background' => $background,
    'backgroundPosition' => $backgroundPosition
  ]);
endif;
