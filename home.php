<?php
/**
 * Template Name: Orangea Hotels Home
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 *
 * @package Tiafeno
 * @subpackage wp_orangea
 * @since Orangea 1.0
 */
if ( ! function_exists( "PLL" ) ) {
	exit( "Please active polylang plugins" );
}
global $instanceOrangea, $post;
$lang_menus = $instanceOrangea->get_menu_translations();

// Return posts natif
$section_posts = $instanceOrangea->get_published_sections();

// Return posts with acf fields
$post_acf = WP_Orangea::get_acf_params( $section_posts );
if ( false === $post_acf ) {
	exit( '<h2>Contenue indisponible pour le moment.</h2>' );
}

// Variable global query templates
set_query_var( 'post_acf', $post_acf );

// Home page ACF
WP_Orangea::get_page_acf_params( $post );
get_header();
?>

<div class="uk-section uk-section-large uk-padding-remove-top uk-padding-remove-bottom" ng-app="activityApp">
	<!-- s@ -->
	<style type="text/css">
		<?php do_action('orangea_home_bg', '.org-section', $post); ?>
	</style>
	<div class="org-section __org_parent">
		<div class="__org-bg __org_parallax">
			<div class="__org-bg-shadow">
				<div class="uk-container uk-container-large __org_container menu-container">
					<div class="uk-padding-large uk-padding-remove-top uk-margin-medium-top" uk-grid>
						<div class="uk-width-1-4@m uk-width-1-2">
							<div class="__org_logo">
								<!-- logo -->
								<a target="_parent" href="<?= home_url( '/' ) ?>">
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
												<?php foreach ( $lang_menus as $menu ): ?>
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
											'walker'          => new OG_Primary_Walker()
										) );
										?><!-- .primary_menu -->
									</div>

									<div class="__primary_menu_offcanvas uk-hidden@m">
										<nav>
											<a href="#menu" class="tiny ui right labeled orange icon button">
												<i class="right bars icon"></i>
												<?= pll_e( "MENU" ) ?>
											</a>
										</nav>
									</div>

								</header>
								<!-- Menu -->
								<nav id="menu" class="__nav_offcanvas uk-hidden@m">
									<div class="inner">
										<h2><?= pll_e( "MENU" ) ?></h2>
										<?php
										wp_nav_menu( array(
											'menu_class'      => 'links',
											'container_class' => '__menu',
											'theme_location'  => 'primary',
											'walker'          => new OG_offcanvas_Walker()
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
	<!-- .end s@ -->
	<?php

	get_template_part( 'templates/controller', 'about' );
	get_template_part( 'templates/controller', 'accommodation' );
	get_template_part( 'templates/controller', 'activities' );
	get_template_part( 'templates/controller', 'restaurant' );
	get_template_part( 'templates/controller', 'galerie' );
	get_template_part( 'templates/controller', 'contact' );

	get_footer();
	?>

