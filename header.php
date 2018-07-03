<!DOCTYPE html>
<html <?= language_attributes(); ?> class="no-js">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
	<!-- *
	*** Visitez www.falicrea.com pour plus d'information et voir nos réalisations
	*** Contact: contact@falicrea.com
		-->

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=525">
	<!--	<meta name="viewport" content="width=device-width, initial-scale=1">-->
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="apple-touch-icon" sizes="57x57"
	      href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60"
	      href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72"
	      href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76"
	      href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114"
	      href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120"
	      href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144"
	      href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152"
	      href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180"
	      href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"
	      href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32"
	      href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96"
	      href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16"
	      href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage"
	      content="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/html5.js"></script>
	<![endif]-->
	<?php wp_enqueue_script( "jquery" ); ?>
	<?php wp_head(); ?>

	<script type="text/javascript">
		// true - Mode teste unitaire
		// false - Mode production
		<?php $QUnit = WP_DEBUG == false ? 0 : 1; ?>
		var QUnitTest = <?= $QUnit ?>;

		/**
		 * Convert image url to base64
		 */
		var toDataURL = function (post) {
			return new Promise(function (resolve, reject) {
				if (false === post.url || _.isNull(post.url) || _.isEmpty(post.url)) reject(false);
				var xhr = new XMLHttpRequest();
				xhr.onload = function () {
					var reader = new FileReader();
					reader.onloadend = function () {
						post.blob = reader.result;
						resolve(post);
					};
					reader.readAsDataURL(xhr.response);
				};
				xhr.open('GET', post.url);
				xhr.responseType = 'blob';
				xhr.send();
			});
		};

		/**
		 * Change an element background image with define interval
		 * @param $selector {selector} jQuery
		 * @param $posts {Array} of media post
		 * @param timeout {int} - 2000ms (default)
		 */
		var bgChange = function ($selector, $posts, timeout = 2000) {
			var postMediaBg = [];
			if ($selector === '' || $selector === null) return;
			var Element = _.isString($selector) ? jQuery($selector) : $selector;
			if (Element.length > 0) {
				_.each($posts, function (post) {
					toDataURL(post)
						.then(function (response) {
							postMediaBg.push(response);
						})
				});
				Element.css({
					'-webkit-transition': 'background-image 1s ease-in-out',
					'-moz-transition': 'background-image 1s ease-in-out',
					'-o-transition': 'background-image 1s ease-in-out',
					'transition': 'background-image 1s ease-in-out'
				});
				window.setInterval(function () {
					var posts = postMediaBg.concat();
					var position = _.random(0, posts.length - 1);
					var post = posts[position];
					if (!_.isUndefined(post.blob))
						Element.css({
							'background-image': "url(" + post.blob + ")"
						});
				}, timeout);
			}
		};

		(function (jQ) {
			jQ(document).ready(function () {
				var bgTop = jQ('.__org_bg_top');
				var bgBottom = jQ('.__org_bg_bottom');
				var backgroundPosition = function () {

					// Positionner le fond en haut
					bgTop.each(function (index, el) {
						var elementHeight = jQ(el).height() - 2;
						jQ(el).css({
							top: -elementHeight + "px",
							"margin-bottom": -elementHeight + "px"
						});
					});

					// Positionner le fond en bas
					bgBottom.each(function (index, el) {
						var elementHeight = jQ(el).height() - 3;
						jQ(el).css({
							top: elementHeight + "px",
							"margin-top": -elementHeight + "px"
						});
					});
				};

				/**
				 * Constructeur
				 * @private
				 */
				var __init__;
				__init__ = function () {
					backgroundPosition();
				};
				__init__();
				jQ(window).resize(function () {
					backgroundPosition();
				});

				// Ligne d'animation quand la souris passe sur une liste
				jQ('.__menu_line .item')
					.tab({
						history: true
					})
					.on('mouseover', function (e) {
						e.preventDefault();
						var tabName = jQ(this).data('tab');
						jQ.tab('change tab', tabName);
						var listParent = jQ(this).parents('.__menu_line');
						listParent
							.find('li')
							.each(function (index, element) {
								var itemChild = jQ(element).find('.item');
								var dataTabChild = itemChild.data('tab');
								jQ(element).data('current', dataTabChild === tabName);
							});

					});

				// Element devider background effect
				var eightSection = jQ(".devider-background");
				var eightBg = eightSection.find('.__org-bg');
				var elContainer = eightSection.find('.__org_container');
				var sectionWidth = eightSection.innerWidth();

				// Default data value
				var imgSize = {width: 3992, height: 2242, regression: 180};

				/**
				 * Get object image width and height value
				 * @param url String
				 * @return Promise
				 */
				function getImageData(url = null) {
					return new Promise(function (resolve, reject) {
						if (_.isNull(url)) reject("L'url de l'image est non definie");
						var image = new Image();
						image.src = url;
						resolve({
							width: image.width,
							height: image.height
						});
					});
				}

				/**
				 * Get an url background image by element
				 * @param element jQuery Element
				 * @return string
				 */
				function getBgImgElement(element) {
					var bgUrl = element.css('background-image');
					// ^ Either "none" or url("...urlhere..")
					bgUrl = /^url\((['"]?)(.*)\1\)$/.exec(bgUrl);
					bgUrl = bgUrl ? bgUrl[2] : ""; // If matched, retrieve url, otherwise ""
					return bgUrl;
				}

				function addContainerpadding(mesure) {
					elContainer
						.css({
							'padding-top': mesure + "px"
						});
				}

				function resizeEight() {
					var windowWidth = jQ(window).innerWidth();
					var eightBgWidth = eightBg.width();
					var eightBgHeight = eightBg.height();
					var bgWidth, bgHeight;
					var imgUrl = getBgImgElement(eightBg);
					getImageData(imgUrl)
						.then(function (response) {
							// Modifier le variable par default
							var results = response;
							imgSize.width = results.width;
							imgSize.height = results.height;
							// Positionner la section
							if (eightBgWidth > eightBgHeight) {
								bgWidth = eightBgWidth;
								bgHeight = (bgWidth * imgSize.height) / imgSize.width;
								if (bgHeight < eightBgHeight) {
									var space = eightBgHeight - bgHeight;
									bgHeight += space;
									bgWidth = (bgHeight * imgSize.width) / imgSize.height;
								}
							}
							if (_.isEmpty(bgHeight)) bgHeight = eightBgHeight;
							var mesure = -Math.ceil((imgSize.regression * eightBgHeight) / bgHeight);
							eightSection
								.css({
									top: mesure + "px",
									"margin-bottom": mesure + "px"
								});
							eightBg
								.css({
									//"background-size": Math.ceil(bgWidth) + "px " + bgHeight + "px"
								});
							addContainerpadding(Math.abs(mesure));
						})
						.catch(function (reason) {
							console.warn(reason);
						});
				}

				// @sync(onResize)
				// Set the minimum height of Tab Card automatically @hebergement
				function setMinHeight() {
					var tabCards = jQ('.__org_tab_card');
					var heights = [140]; // Added default value
					var maxHeightValue = null;

					// Get max value
					jQ.each(tabCards, function (index, element) {
						var elHeight = jQ(element).innerHeight();
						heights.push(elHeight);
					});
					maxHeightValue = heights.reduce(function (a, b) {
						return Math.max(a, b);
					});
					tabCards.css({
						height: parseInt(maxHeightValue)
					});
				}

				resizeEight();
				setMinHeight();
				jQ(window).resize(function () {
					setMinHeight();
					sectionWidth = eightSection.innerWidth();
					resizeEight();
				});
			}); // document ready
		})(jQuery);
	</script>

	<style type="text/css">
		a, .uk-link {
			text-decoration: none !important;
		}

		h2.ui.header .sub.header {
			line-height: 0.9 !important;
		}

		.entry-content {
			width: 100%;
			display: block;
			min-height: 100vh;
		}

		/*  Section N°1  */
		.og-padding-medium {
			padding: 45px
		}

		/* Section N°2 */
		.container-footer {
			border-radius: 0px 0px 25px 25px;
			background-color: #FFFFFF;
			min-height: 100px;
		}

		.container-footer .menu-area {
			background: #f28d23;
			-webkit-border-radius: 15px;
			-moz-border-radius: 15px;
			border-radius: 15px;
			padding: 15px;
		}

		.container-footer .menu-area p {
			font-size: 11px;
		}

		.container-footer ul > li {
			list-style: none;
			padding-top: 0px;
			display: block;
			min-width: 48%;
		}

		.container-footer .widget_nav_menu li > a {
			color: #F6AC62;
			cursor: text;
			text-decoration: none;
		}

		.container-footer ul > li {
			text-decoration: none;
			color: #F6AC62;
			font-size: 12px;
		}

		.container-footer::before {
			content: " ";
			height: 25px;
			display: block;
			background: transparent url(<?= esc_url( get_template_directory_uri() ); ?>/img/SVG/chevron.svg) no-repeat top center;
			background-size: 70px;
			position: relative;
			top: -2px;
		}

		.org-4-section .__org_support {
			padding-bottom: 0;
		}

		/* Section 5 et 6 */
		.org-5-section > .__org-bg {
			z-index: 9 !important;
		}

		.org-6-section {
			position: relative;
		}

		.org-6-section .__org-bg {
			/*background: #ebe1df url(
		<?= esc_url( get_template_directory_uri() ); ?>            /img/unsplash.jpg) no-repeat top left; */
			background-attachment: fixed;
			background-size: cover;
			min-height: 50em;
			z-index: 8;
		}

		.org-6-section .__org-bg-shadow {
			position: relative;
			z-index: 9;
			background: none;
		}

		.org-nine-section .__org_description {
			color: #FFFFFF;
			width: 25em;
			margin: auto;
		}

		.__org-bg .__org_description {
			color: #FFFFFF;
		}

		.org-6-section .__org_header_white {
			line-height: 0.8 !important;
		}

		img.pointer {
			cursor: pointer;
		}

		@keyframes shrink {
			0% {
				transform: scale(0.6);
			}
			100% {
				transform: scale(1);
			}
		}

		@keyframes Zoom {
			0% {
				transform: scale(1.75);
			}
			100% {
				transform: scale(1.80);
			}
		}

		@media (max-width: 525px) {

			body,
			div.org-4-section .__menu li > a,
			.__menu_dashed li > a {
				font-size: 16px;
			}
		}
	</style>
</head>

<body <?php body_class(); ?> >
<div id="qunit"></div>
<!-- Chevron, pour aller vers le haut  -->
<span class="goup uk-margin-small-left uk-position-fixed uk-position-bottom-left uk-button uk-button-danger"
      uk-icon="icon: chevron-up; ratio: 2"
      style="padding: 0px 5px 0px 5px; z-index: 999; bottom: 80px"
      title="Vers le haut" uk-tooltip="pos: right">
  </span>

<div class="uk-offcanvas-content">
	<div class="" id="primary">
		<div class="primary-content">
