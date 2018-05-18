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

$galerie_page = Arrays::filter( $post_acf, function ( $value ) {
	return $value->__org_type == "galerie";
} );
if ( ! empty( $galerie_page ) ) :
	list( $galerie ) = array_values( $galerie_page );
	WP_orangea_services::embed_wpb_custom_css( $galerie->ID );
	?>
  
  <div class="org-6-section devider-background __org_parent">
    <div class="__org-bg __org_parallax">
      <!--<div class="__org_bg_top"></div>-->
      <!--<div class="__org-container-shadow uk-position-absolute"></div>-->
      <div class="__org-bg-shadow">
        <div class="uk-container uk-container-large uk-padding-remove-bottom __org_container">
          <div class="__org_support uk-padding-large uk-margin-large-bottom">
            <div class="uk-padding-large uk-padding-remove-left uk-padding-remove-vertical">
              <h2 class="ui header __org_header_white" id="<?= sanitize_title( $galerie->post_title ) ?>">
								<?= $galerie->post_title ?>
              </h2>
              <aside class="uk-text-medium uk-width-1-1 uk-width-1-3@l __org_description">
								<?= $galerie->__org_subtitle ?>
              </aside>
              <div class="uk-margin-medium-top">
								<?= the_content() ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
