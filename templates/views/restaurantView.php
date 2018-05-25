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
?>
<style type="text/css">
  <?php do_action('orangea_section_bg', '.org-5-section', $section, $background); ?>
</style>
<div class="org-5-section __org_parent">
	<div class="__org-bg ">
		<div class="__org_bg_top"></div>

		<div class="__org_container uk-container uk-container-large  __org_devider">
			<!--<div class="__org_devider_bg"></div>-->
			<div class="uk-padding-large uk-padding-remove-vertical" uk-grid>
				<div class="uk-flex uk-width-1-2@m uk-width-1-1 ">

					<div class="uk-margin-auto-vertical uk-padding-large uk-padding-remove-left uk-padding-remove-right"
					     style="position:relative; width: 100%;">
						<div class="uk-padding-large uk-padding-remove-left __org_support">

							<div id="<?= sanitize_title($section->post_title) ?>" class="">
								<h2
									class="__org_header_white ui header uk-margin-small-top"
									uk-parallax="opacity: 0,1; y: 100,0; viewport: 0.3">
									<?= $section->post_title ?>
								</h2>
								<p class="uk-margin-medium-top uk-margin-medium-bottom">
									<?= apply_filters("the_content", $section->post_content) ?>
								</p>
							</div>

						</div>
					</div>

				</div>
				<div class="uk-width-1-2@m uk-width-1-1 uk-visible@m">
				</div>
			</div>
		</div>

		<!--<div class="__org_bg_bottom"></div>-->
	</div>
</div>
