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
$contact_page = Arrays::filter($post_acf, function ($value) {
	return $value->__org_type == "contact";
});
if ( ! empty( $contact_page )) :
	list($contact) = array_values( $contact_page );
	WP_orangea_services::embed_wpb_custom_css($contact->ID);

?>


<style type="text/css">

  .org-nine-section {
  }

  .org-nine-section .__org-bg {
    background-color: #211e1e;
  }

  .org-nine-section h2,
  .org-nine-section aside {

    text-align: center;

  }

  .org-nine-section h2#contact {

    line-height: 0.8;

  }

  .org-nine-section h2#contact::after,
  .org-nine-section h2#contact::before {

    content: ' ';

    width: 100%;

    height: 4px;

    background: #615f60;

    display: block;

    margin: auto;

  }

  .contact-info {

    display: inline-block;

  }

  .contact-info::before {

    content: ' ';

    height: 67px;

    width: 3px;

    margin: auto;

    background: #615f60;

    display: block;

    margin-bottom: 10px;

  }

</style>

<!-- s@9 -->

<div class="org-nine-section __org_parent">
  <div class="__org-bg">
    <div class="__org_container uk-container uk-container-large uk-padding-remove-bottom">
      <div class="__org_support uk-padding-large" uk-grid>

        <div class="uk-width-1-1" id="<?= sanitize_title($contact->post_title) ?>">
          <h2 id="contact" class="__org_header_white uk-flex"><?= $contact->post_title ?></h2>
        </div>

        <div class="uk-width-1-1">
          <aside class="__org_description">
            <?= $contact->__org_subtitle ?>
          </aside>

          <?php if ( ! empty($contact->__org_book_link) || ! is_null($contact->__org_book_link) ) : ?>
            <div class="uk-margin-auto uk-padding-small">
              <button class="ui yellow button uk-display-block uk-margin-auto"
              onclick="window.location.href = 'https://booking.ericsoft.com/BookingEngine/Book?idh=AEB9D8823D51317C&lang=fr&cur=EUR'">
                <?= pll_e("Book") ?>
              </button>
            </div>
          <?php endif; ?>

          <div class="uk-flex">
            <div class="contact-info uk-margin-auto uk-text-center">
              <?= apply_filters("the_content", $contact->__org_info) ?>
            </div>
          </div>
        </div>

        <div class="uk-width-1-1">
          <div class="uk-width-1-3 uk-margin-auto">
            <img src="<?= get_template_directory_uri() . '/img/SVG/map.svg' ?>" class="uk-margin-auto uk-display-block" width="450"
                onerror="this.onerror=null; this.src='<?= get_template_directory_uri() . '/img/2x/map@2x.png' ?>' " />
          </div>
        </div>

        <div class="uk-width-1-1">
          <div class="uk-width-1-6 uk-margin-auto">
            <img src="<?= get_template_directory_uri() . '/img/SVG/tripadvisor.svg' ?>" class="uk-margin-auto uk-display-block" width="450"
                style="cursor: pointer"
                onclick="window.location.href = 'https://www.tripadvisor.fr/Hotel_Review-g479206-d1181580-Reviews-Orangea_Village-Nosy_Be_Antsiranana_Province.html'"
                onerror="this.onerror=null; this.src='<?= get_template_directory_uri() . '/img/2x/tripadvisor@2x.png' ?>'" />
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- .end s@9 -->
<?php endif; ?>