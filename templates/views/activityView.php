<?php
global $detector;

$shortcodes_custom_css = get_post_meta($activitie->ID, '_wpb_shortcodes_custom_css', true);
if (!empty($shortcodes_custom_css)) {
	$shortcodes_custom_css = strip_tags($shortcodes_custom_css);
	echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
	echo $shortcodes_custom_css;
	echo '</style>';
}
?>
<div id="<?= $identification ?>" class="<?= $class ?> __org_parent">
	<div class="__org-bg">

		<?php if ( ! $detector->isMobile() ) : ?>
			<div class="__org_bg_top"></div> <?php endif; ?>

		<div class="uk-container uk-container-large __org_container">
			<div class="__org_support uk-padding-large" uk-grid>

				<div class="uk-width-1-2@m uk-width-1-1">
					<div class="uk-padding-large uk-padding-remove-left uk-padding-remove-top">
						<h2 id="<?= $activitie->post_name ?>"
						    class="ui header" <?php if ( ! $detector->isMobile() ) { ?> uk-parallax="opacity: 0,1; x: -100, 0; viewport: 0.5" <?php } ?>>
							<?= $activitie->__org_subtitle ?>
							<div class="sub header uk-margin-small-top">
								<?= $activitie->post_title ?>
							</div>
						</h2>

						<div class="uk-margin-medium-top">
							<?= apply_filters("the_content", $activitie->post_content); ?>
						</div>

						<?php
						if ( has_nav_menu( $activity_menu )) :
							$activitie_menu_items = WP_orangea_services::get_menu_items_by_location( $activity_menu );
							$menu_items           = WP_orangea_services::get_menu_items_content( $activitie_menu_items );
							?>
							<script>
								App.controller('MenuActivityCtrl', function ($scope) {
									$scope.menuItems = <?= json_encode( $menu_items, JSON_PRETTY_PRINT ) ?>;
									$scope.currentItem = "";
									$scope.eventOnEnterMenuLink = function ($event, itemID) {
										var element = $event.target;
										$scope.currentItem = _.find($scope.menuItems, function (item) {
											return item.ID === itemID;
										});
									};

								});
							</script>
							<div ng-app="ActivityApp_<?= $index ?>" ng-controller="MenuActivityCtrl">
								<div class="uk-padding-large uk-padding-remove-left">
									<div class="__menu">
										<ul class="uk-padding-remove uk-margin-remove">
											<li ng-repeat="item in menuItems">
												<a
													ng-class="{active: item.ID === currentItem.ID}"
													ng-mouseenter="eventOnEnterMenuLink($event, item.ID)">
													{{ item.post_title }}
												</a>
											</li>
										</ul>
									</div>
								</div>
								<div style="min-height: 120px">
									<p ng-bind-html="currentItem.post_content"></p>
								</div>
							</div>

						<?php endif; ?>
					</div>
				</div>

				<div class="uk-width-1-2@m uk-width-1-1">
					<div
						class="uk-padding-small uk-padding-remove-top <?php if ( $detector->isMobile() ) : ?> uk-margin-large-bottom <?php endif; ?>">
						<div ng-controller="galerieCtrl">
							<activity-galerie galerie-data="<?= $activitie->ID ?>"></activity-galerie>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php if ( ! $detector->isMobile() ) : ?>
			<div class="__org_bg_bottom"></div> <?php endif; ?>

	</div>
</div>