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

$about_page = Arrays::filter($post_acf, function ($about) {
	return $about->__org_type == "about";
});

if ( ! empty($about_page)):
	list($about) = array_values($about_page);
	?>
	<div class="org-1-section __org_parent">
		<div class="__org-bg">
			<div class="__org_bg_top"></div>
			<div class="uk-container uk-container-large  __org_container uk-flex">
				<div class="uk-padding-large uk-padding-remove-vertical uk-flex">
					<div class="uk-grid og-padding-medium uk-padding-remove-horizontal uk-margin-auto-vertical">
						<div class="uk-width-1-2@m uk-width-1-1 uk-flex">
							<div>
								<div class="uk-flex" style="height: 100%">
									<img src="<?= get_template_directory_uri() . '/img/SVG/orangea-hotels.svg' ?>"
									     onerror="this.onerror=null; this.src='<?= get_template_directory_uri() . '/img/2x/orangea-hotels@2x.png' ?>'"
									     class="uk-logo"
									     width="420"/>
								</div>
							</div>
						</div>
						<div class="uk-width-1-2@m uk-width-1-1 uk-flex">
							<div class="uk-margin-auto-vertical">

								<div class="uk-margin-medium-top">
									<?= apply_filters("the_content", $about->post_content) ?>
								</div>

							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="__org_bg_bottom"></div>
		</div>
	</div>
<?php endif; ?>