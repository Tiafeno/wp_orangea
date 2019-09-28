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
global $detector;

$shortcodes_custom_css = get_post_meta($section->ID, '_wpb_shortcodes_custom_css', true);
if (!empty($shortcodes_custom_css)) {
	$shortcodes_custom_css = strip_tags($shortcodes_custom_css);
	echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
	echo $shortcodes_custom_css;
	echo '</style>';
}
?>
<div class="org-1-section __org_parent">
	<div class="__org-bg">
		<?php if ( ! $detector->isMobile() ) : ?>
			<div class="__org_bg_top"></div> <?php endif; ?>
		<div class="uk-container uk-container-large  __org_container uk-flex">
			<div class="uk-padding-large uk-padding-remove-vertical uk-flex">
				<div class="uk-grid og-padding-medium uk-padding-remove-horizontal uk-margin-auto-vertical"
				     style="padding-top: 2px">
					<div id="<?= $section->post_name ?>" class="uk-width-1-1@m uk-width-1-1">
						<div class="uk-margin-auto-vertical">

							<div class="uk-margin-medium-top">
								<?= apply_filters( "the_content", $section->post_content ) ?>
							</div>

						</div>
					</div>
				</div>

			</div>
		</div>
		<?php if ( ! $detector->isMobile() ) : ?>
			<div class="__org_bg_bottom"></div> <?php endif; ?>
	</div>
</div>

