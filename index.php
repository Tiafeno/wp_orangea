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

if ( ! function_exists("PLL")) exit("Please active polylang plugins");
global $instanceOrangea;
$lang_menus = $instanceOrangea->get_menu_translations();
get_header();
?>

	<div class="uk-section uk-section-large uk-padding-remove-top uk-padding-remove-bottom">
	<!-- s@ -->
	<div class="org-section __org_parent">
		<div>
			<div>
				<div class="uk-container uk-container-large __org_container menu-container">
					<div class="uk-padding-large uk-padding-remove-bottom uk-padding-remove-top uk-margin-medium-top" uk-grid>
						<div class="uk-width-1-4@m uk-width-1-2">
							<div class="__org_logo">
								<!-- logo -->
								<a target="_parent" href="<?= home_url('/') ?>">
									<img class="uk-logo" width="180" src="<?= get_template_directory_uri() . '/img/2x/logo@2x.png' ?>"/>
								</a>
								<!-- .end logo -->
							</div>
						</div>
						<div class="uk-width-3-4@m uk-width-1-2">
							<div class="uk-flex" style="height: 100%">
								<!-- menu -->
								<header id="header" class="__org_menu alt">

									<div class="__top_menu">
										<div class="__menu">
											<ul class="uk-margin-remove __top_menu_container">
												<?php foreach ($lang_menus as $menu): ?>
													<li><a href="<?= $menu->home_url ?>"><?= strtoupper( $menu->slug ) ?></a></li>
												<?php endforeach; ?>
											</ul>
										</div>

									</div>

									<div class="__primary_menu uk-visible@m">
										<?php
										wp_nav_menu( array(
											'menu_class'      => '__primary_menu_container __menu_line',
											'container_class' => '__menu',
											'theme_location'  => 'primary',
											'walker' => new OG_Primary_Walker()
										) );
										?><!-- .primary_menu -->
									</div>

									<div class="__primary_menu_offcanvas uk-hidden@m">
										<nav>
											<a href="#menu" class="tiny ui right labeled orange icon button">
												<i class="right bars icon"></i>
												<?= pll_e("MENU") ?>
											</a>
										</nav>
									</div>

								</header>
								<!-- Menu -->
								<nav id="menu" class="__nav_offcanvas uk-hidden@m">
									<div class="inner">
										<h2><?= pll_e("MENU") ?></h2>
										<?php
										wp_nav_menu( array(
											'menu_class'      => 'links',
											'container_class' => '__menu',
											'theme_location'  => 'primary',
											'walker' => new OG_offcanvas_Walker()
										) );
										?><!-- .primary_offcanvas_menu -->

										<a href="#" class="close">Close</a>
									</div>
								</nav>
								<!-- .end menu -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="uk-container uk-container-large uk-flex">
		<div class="uk-padding-large uk-padding-remove-vertical">
			<?php
			while ( have_posts() ) : the_post();
				?>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
				<?php
				the_content();
			endwhile;
			?>
		</div>
	</div>
	<!-- .end s@ -->
<?php get_footer(); ?>