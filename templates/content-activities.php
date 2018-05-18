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

/**
 * Created by IntelliJ IDEA.
 * User: Tiafeno
 * Date: 14/05/2018
 * Time: 10:39
 */
use Underscore\Types\Arrays;
$activities_page = Arrays::filter($post_acf, function ($value) {
	return $value->__org_type == "activity";
});
$activities_page = Arrays::sort($activities_page, function ($article) {
  return $article->__org_section_id;
}, 'asc');

foreach (array_values($activities_page) as $index => $activitie) :
  $activity_menu = empty($activitie->__org_activity_menu) ? null : $activitie->__org_activity_menu;
  $class = ! empty($activitie->__org_section_class) ? $activitie->__org_section_class : "";
  $identification = ! empty($activitie->__org_section_id) ? $activitie->__org_section_id : '';
  ?>
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
<?php endforeach; ?>