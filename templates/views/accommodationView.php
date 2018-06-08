<?php
use Underscore\Types\Arrays;
// global $section, $parents, $background, $galleries;
?>
<style type="text/css">
  <?php do_action('orangea_section_bg', '.org-2-section', $section, $background); ?>
</style>

<div class="org-2-section __org_parent <?= $section->__org_section_class ?>">
  <script type="text/javascript">
    var galleries = <?= json_encode($galleries, JSON_PRETTY_PRINT) ?>;
    (function ($) {
      $(document).ready(function () {
        if ( ! _.isNull(galleries)) {
          bgChange($('.org-2-section').find('.__org-bg'), galleries, 2000);
        }
      });
    })(jQuery);
  </script>
	<div class="__org-bg __org_parallax">
		<div class="__org_container uk-container uk-container-large  __org_devider">
			<!-- <div class="__org_devider_bg"></div> -->
			<div class="uk-padding-large " uk-grid>
				<div class="uk-flex uk-width-1-2@m uk-width-1-1">
					<div class="uk-margin-auto-vertical __org_bg_sensor">
						<div class="uk-padding-large uk-padding-remove-horizontal uk-padding-remove-bottom  __org_support"
						     id="<?= sanitize_title($section->post_title) ?>"
						     uk-parallax="opacity: 0,1; y: -100, 0; viewport: 0.3">
							<div class="container-content uk-padding-large uk-padding-remove-vertical">
								<h2 class="__org_header_white ui header uk-margin-small-top"
								    uk-parallax="opacity: 0,1; y: 100,0; viewport: 0.3">
									<?= $section->post_title ?>
								</h2>
								<div class="uk-margin-medium-top uk-margin-medium-bottom">
									<?= apply_filters("the_content", $section->post_content) ?>
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
								<div class="uk-padding-large uk-padding-remove-top">
									<?php foreach ($parents as $key => $parent) :
										$first_class = $key == 0 ? "uk-padding-remove-top active" : " ";
										$find_parent = &$parent;
										$childs = Arrays::filter($menu, function ($child) use ($find_parent) {
											return $child->menu_item_parent == $find_parent->ID;
										});
										?>
										<div class="ui tab uk-padding-small uk-padding-remove-horizontal <?= $first_class ?>"
										     data-tab="<?= $parent->post_name ?>">
											<div class="uk-clearfix">
												<?php $is_child = true; ?>
												<?php foreach ($childs as $it => $child) {
												$current_child = &$child;
												$subchilds = Arrays::filter($menu, function ($value) use ($current_child) {
													return $value->menu_item_parent == $current_child->ID;
												});

												if ( empty($subchilds)) :
												if ($is_child) :  ?>
												<div class="uk-width-1-2 uk-width-1-2@s uk-float-left __org_tab_card">
													<ul class="uk-padding-remove uk-margin-remove-bottom">
														<?php endif;

														echo '<li><a>'. $current_child->post_title .'</a></li>';

														$is_child = false;
														continue;
														endif;
														?>
														<div class="uk-width-1-2 uk-width-1-2@s uk-float-left __org_tab_card">
															<?php if ( ! is_null($subchilds)) :?>
																<h5 class="ui header uk-margin-remove-vertical"><?= $child->post_title ?></h5>
															<?php endif; ?>

															<ul class="uk-padding-remove uk-margin-medium-bottom uk-margin-small-top">

																<?php if (is_array($subchilds)) : ?>
																	<?php foreach ($subchilds as $subchild) : ?>
																		<li><a><?= $subchild->post_title ?></a></li>
																	<?php endforeach; ?>
																<?php else: ?>
																	<li><a><?= $current_child->post_title ?></a> </li>
																<?php endif; ?>

															</ul>
														</div>
														<?php } ?> <!-- .end foreach #childs -->
														<?php if ( ! $is_child) : ?> </div> <?php endif; ?>
												<div class="uk-width-1-2 uk-width-1-2@s uk-float-left">
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