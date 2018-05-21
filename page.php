<?php
/**
 * The template for displaying pages
 *
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
if ( ! function_exists("PLL")) exit("Please active polylang plugins");
global $instanceOrangea;
$lang_menus = $instanceOrangea->get_menu_translations();
get_header();
?>

	<div class="uk-section uk-section-large uk-padding-remove-top uk-padding-remove-bottom">
	<!-- s@ -->

	<div class="uk-container uk-container-large uk-flex">
    <div class="uk-padding-large uk-padding-remove-vertical entry-content">
      <?php
        while ( have_posts() ) : the_post();
          ?>
          <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
          </header><!-- .entry-header -->
          <?php
          the_content();
        endwhile;
      ?>
    </div>
	</div>
	<!-- .end s@ -->
<?php get_footer(); ?>