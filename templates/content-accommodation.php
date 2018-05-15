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
$accommodation_page = Arrays::filter($post_acf, function ($value) {
	return $value->__org_type == "accommodation";
});
if ( ! empty($accommodation_page)):
	list($accommodation) = array_values($accommodation_page);
	$menu = WP_orangea_services::get_menu_items_by_location('hebergement');
	$parents = Arrays::filter($menu, function ($value) {
		return $value->menu_item_parent == 0 ;
	});
	$parents = array_values($parents);
	?>

	<div class="org-2-section __org_parent">
		<div class="__org-bg __org_parallax">

			<div class="__org_container uk-container uk-container-large  __org_devider">
				<!-- <div class="__org_devider_bg"></div> -->
				<div class="uk-padding-large " uk-grid>
					<div class="uk-flex uk-width-1-2@m uk-width-1-1">
						<div class="uk-margin-auto-vertical __org_bg_sensor">
							<div class="uk-padding-large uk-padding-remove-horizontal uk-padding-remove-bottom  __org_support"
							     id="hebergement"
							     uk-parallax="opacity: 0,1; y: -100, 0; viewport: 0.3">
								<div class="container-content uk-padding-large uk-padding-remove-vertical">
									<h2 class="__org_header_white ui header uk-margin-small-top"
									    uk-parallax="opacity: 0,1; y: 100,0; viewport: 0.3"
											id="<?= sanitize_title($accommodation->post_title) ?>">
										<?= $accommodation->post_title ?>
									</h2>
									<div class="uk-margin-medium-top uk-margin-medium-bottom">
										<?= apply_filters("the_content", $accommodation->post_content) ?>
									</div>
									<!-- Menu hebergement -->
									<nav>
										<div class="__menu_dashed">
											<ul class="__menu_line pointing uk-padding-remove-left">
												<?php foreach ($parents as $key => $parent) :
													// First element to data current true value
													$current = ($key == 0) ? "true" : "false";
													$active = ($key == 0) ? "active" : " ";
													?>
													<li data-current="<?= $current ?>" >
														<a class="item <?= $active ?>" data-tab="<?= $parent->post_name ?>">
															<?= $parent->post_title ?>
														</a>
													</li>
												<?php endforeach; ?>
												<div class="line"></div>
											</ul>
										</div>
									</nav>
								</div>

								<div class="container-footer">
									<div class="uk-padding-large uk-padding-remove-vertical">
										<?php foreach ($parents as $key => $parent) :
											$first_class = $key == 0 ? "uk-padding-remove-top active" : " ";
											$find_parent = &$parent;
											$childs = Arrays::filter($menu, function ($child) use ($find_parent) {
												return $child->menu_item_parent == $find_parent->ID;
											});
											?>
											<div class="ui tab uk-padding-small uk-padding-remove-horizontal <?= $first_class ?>" data-tab="<?= $parent->post_name ?>">
												<div class="uk-clearfix">
													<?php $is_child = true; ?>
													<?php foreach ($childs as $it => $child) {
													$current_child = &$child;
													$subchilds = Arrays::filter($menu, function ($value) use ($current_child) {
														return $value->menu_item_parent == $current_child->ID;
													});

													if ( empty($subchilds)) :
													if ($is_child) :  ?>
													<div class="uk-width-1-1 uk-width-1-2@s uk-float-left">
														<ul class="uk-padding-remove uk-margin-remove-bottom">
															<?php endif;

															echo '<li><a href="#">'. $current_child->post_title .'</a></li>';

															$is_child = false;
															continue;
															endif;
															?>
															<div class="uk-width-1-1 uk-width-1-2@s uk-float-left">
																<?php if ( ! is_null($subchilds)) :?>
																	<h5 class="ui header uk-margin-remove-vertical"><?= $child->post_title ?></h5>
																<?php endif; ?>

																<ul class="uk-padding-remove uk-margin-medium-bottom uk-margin-small-top">

																	<?php if (is_array($subchilds)) : ?>
																		<?php foreach ($subchilds as $subchild) : ?>
																			<li><a href="#"><?= $subchild->post_title ?></a></li>
																		<?php endforeach; ?>
																	<?php else: ?>
																		<li><a href=""><?= $current_child->post_title ?></a> </li>
																	<?php endif; ?>

																</ul>
															</div>
															<?php } ?> <!-- .end foreach #childs -->
															<?php if ( ! $is_child) : ?> </div> <?php endif; ?>
													<div class="uk-width-1-1 uk-width-1-2@s uk-float-left">
														<?php
														$sidebar = sanitize_title(trim($parent->attr_title));
														if ( is_active_sidebar( $sidebar ) ) :
															dynamic_sidebar( $sidebar );
														endif;
														?>
													</div>
												</div>
											</div>
										<?php endforeach; ?> <!-- .end foreach #parents -->

									</div>
								</div>

								<!-- .end Menu hebergement -->
							</div>
						</div>

					</div>
					<div class="uk-width-1-2@m uk-width-1-1 uk-visible@m">
						<p></p>
					</div>
				</div>
			</div>

<!--			<div class="__org_bg_bottom"></div>-->
		</div>
	</div>
	<!-- .end S@2 -->

<?php endif; ?>