<!DOCTYPE html>
<html <?= language_attributes(); ?> class="no-js">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
  <!-- *
	*** Visitez www.falicrea.com pour plus d'information et voir nos réalisations
	*** Contact: contact@falicrea.com
		-->

  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=525, initial-scale=1, maximum-scale=1">
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
	<?php
	/**
	 * ACF Dependancy get options
	 */

	?>

  <style type="text/css">

    @import url("<?php echo esc_url( get_template_directory_uri() ); ?>/libs/semantic/semantic.css");
    @import url("<?php echo esc_url( get_template_directory_uri() ); ?>/libs/semantic/transition.css");
    @import url("<?php echo esc_url( get_template_directory_uri() ); ?>/libs/semantic/modal.css");
    @import url("<?php echo esc_url( get_template_directory_uri() ); ?>/libs/semantic/form.css");
    @import url("<?php echo esc_url( get_template_directory_uri() ); ?>/libs/semantic/icon.css");
    @import url("<?php echo esc_url( get_template_directory_uri() ); ?>/libs/semantic/tab.css");
    @import url("<?php echo esc_url( get_template_directory_uri() ); ?>/libs/uikit/uikit.css");
    @import url("<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/menu.css");
    /** Template style */
    @import url("<?php echo esc_url( get_template_directory_uri() ); ?>/style.css");
    @import url('https://fonts.googleapis.com/css?family=Montserrat:300,400,400i,500,500i,700,800');

  </style>
  <script type="text/javascript">
    // true - Mode teste unitaire
    // false - Mode production
    <?php $QUnit = WP_DEBUG == false ? 0 : 1; ?>
    var QUnitTest = <?= $QUnit ?>;

    (function (jQ) {
      
        /**
         * Convert image url to base64
         */
        var toDataURL = function (post) {
          return new Promise(function (resolve, reject) {
            if (false == post.thumbnail_url) reject(false);
            var xhr = new XMLHttpRequest();
            xhr.onload = function () {
              var reader = new FileReader();
              reader.onloadend = function () {
                post.blob = reader.result;
                resolve( post );
              }
              reader.readAsDataURL(xhr.response);
            };
            xhr.open('GET', post.thumbnail_url);
            xhr.responseType = 'blob';
            xhr.send();
          });
        }
        
        /**
         * Change an element background image with define interval
         * @param $selector {selector} jQuery
         * @param $post {Array} of media post
         */
        var bgChange = function ($selector, $post) {
          var postMediaBg = [];
          if ($selector === '' || $selector === null) return;
          var Element = is_string($selector) ? jQ($selector) : $selector;
          if (Element.length > 0) {
            jQ.each(Element, function (index, el) {
              toDataURL
                .then(function (response) {
                  var postContent = response;
                  postMediaBg.push(postContent);
                })
            });

            window.setInterval( function () {
              var posts = postMediaBg.concat();
              var position = _.random(0, posts.length);
              var post = posts[ position ];
              Element.css({
                'background-image': "url(" + post.blob + ")";
              });
            }, 2000);
          }
        };

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

    .container-footer ul > li a:hover {
      color: #282525;
    }

    .container-footer ul > li a {
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

    /* Section 5 et 6 */
    .org-5-section > .__org-bg {
      z-index: 9 !important;
    }

    .org-6-section {
      position: relative;
    }

    .org-6-section > .__org-bg {
      background: #ebe1df url(<?= esc_url( get_template_directory_uri() ); ?>/img/unsplash.jpg) no-repeat top left;
      background-attachment: fixed;
      background-size: cover;
      min-height: 50em;
      z-index: 8;
    }

    .org-6-section .__org-bg-shadow {
      position: relative;
      z-index: 9;
      background: none;
      /*background: -moz-linear-gradient(top, rgba(25,24,25,1) 0%, transparent 82%);
			background: -webkit-linear-gradient(top, rgba(25,24,25,1) 0%, transparent 82%);
			background: linear-gradient(to bottom, rgba(25,24,25,1) 0%, transparent 82%);*/
    }

    .org-6-section .__org_container {

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

    img.tripadvisor {

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
