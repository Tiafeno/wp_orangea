<div id="<?= $identification ?>" class="<?= $class ?> __org_parent">
	<div class="__org-bg">
		<div class="__org_bg_top"></div>
		<div class="uk-container uk-container-large __org_container">
			<div class="__org_support uk-padding-large uk-margin-large-bottom" uk-grid>
				<div class="uk-width-1-2@m uk-width-1-1">
					<div class="uk-padding-large uk-padding-remove-left uk-padding-remove-top">
						<h2 id="<?= sanitize_title($activitie->post_title) ?>" class="ui header" uk-parallax="opacity: 0,1; x: -100, 0; viewport: 0.5">
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
							$menu_items = WP_orangea_services::get_menu_items_content($activitie_menu_items);
							?>
							<script type="text/javascript">
                (function() {
                  var activities_<?= $index ?> = angular.module('ActivityApp_<?= $index ?>', [ 'ngSanitize' ]);
                  activities_<?= $index ?>.controller('MenuActivityCtrl', function ($scope) {
                    $scope.menuItems = <?= json_encode($menu_items, JSON_PRETTY_PRINT); ?>;
                    $scope.currentItem = "";
                    $scope.eventOnEnterMenuLink = function ($event, itemID) {
                      var element = $event.target;
                      $scope.currentItem = _.find($scope.menuItems, function (item) { return item.ID === itemID; });
                    };

                  });
                })();
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
								<div>
									<p ng-bind-html="currentItem.post_content"></p>
								</div>
							</div>

						<?php endif; ?>
					</div>
				</div>
				<div class="uk-width-1-2@m uk-width-1-1">
					<div class="uk-padding-small uk-padding-remove-top"
					     uk-parallax="opacity: 0,1; x: 100, 0; viewport: 0.3">
						<!--<img src="img/SVG/activity-gallery.svg" onerror="this.onerror=null; this.src='img/2x/activity-gallery@2x.png'">-->
						<?php
						$svgUrl = get_template_directory() . '/templates/svg/' . $identification . '.tpl.php';
						if (file_exists($svgUrl))
							require $svgUrl;
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="__org_bg_bottom"></div>
	</div>
</div>