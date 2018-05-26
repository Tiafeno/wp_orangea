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

function action_section_bg ($class, $section, $background) {
	if ( ! empty( $section->__bg ) ): ?>
		<?= $class ?> > .__org-bg {
		<?php if ( $section->__bg == 'image' && ! empty($background->url) ):
			$color = empty($background->color) ? "#ffffff" : $background->color;
			?>
			background-image: url( <?= $background->url ?> ) !important;
      background-position: <?= implode( " ", $background->position ) ?> !important;
      background-color: <?= $color ?> !important;
      background-size: <?= $background->size ?> !important;
      background-repeat: no-repeat;
      background-attachment: <?= $background->attachment ?> !important;
		<?php endif; ?>

		<?php if ( $section->__bg == 'color' && ! empty($background->color) ): ?>
			background: <?= $background->color ?> !important;
		<?php endif; ?>
		}
	<?php endif;
}

function action_home_bg ($class, $section) {
	if ( ! empty( $section->background ) ): ?>
		<?= $class ?> > .__org-bg {
		<?php if ( $section->background == 'image' && ! empty($section->bg_image) ):
			$color = empty($section->bg_color) ? "#ffffff" : $section->bg_color;
		  $position = explode('_', $section->bg_position);
			?>
			background-image: url( <?= $section->bg_image['url'] ?> ) !important;
      background-position: <?= implode( " ", $position ) ?> !important;
      background-color: <?= $color ?> !important;
      background-size: <?= $section->bg_size ?> !important;
      background-repeat: no-repeat;
      background-attachment: <?= $section->bg_attachment ?> !important;
		<?php endif; ?>

		<?php if ( $section->background == 'color' && ! empty($section->bg_color) ): ?>
			background: <?= $section->color ?> !important;
		<?php endif; ?>
		}
	<?php endif;
}
