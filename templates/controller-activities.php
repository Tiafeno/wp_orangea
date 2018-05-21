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

  og_get_view_content('activity', compact("activitie", "activity_menu", "identification", "class", "index"));
endforeach;