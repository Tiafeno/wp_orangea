/*
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

(function ($) {
  var
    lineMenu,
    allMenuLine,
    currentList;

  allMenuLine = $(".__menu_line");
  currentList = [];
  $(document).ready(function () {
    var windowHeight;
    // Positionner la ligne sous le menu
    function positionLines(positionIndex) {
      return new Promise(function (resolve, reject) {
        if (!_.isNumber(positionIndex)) reject(false);
        var currentListWidth = currentList.eq(positionIndex).width();
        var resistance = 0.5;
        var translationContainer = [];
        for (var i = 0; i < positionIndex; ++i) {
          translationContainer.push(currentList.eq(i).width() + 4);
        }
        // Effectuer une somme dans le contenue de cette tableau "translationContainer"
        var xPos = _.reduce(translationContainer, function (memo, num) {
          return memo + num;
        }, 0);
        lineMenu.css({
          width: (currentListWidth / 4) + "px",
          transform: "translate(" + (xPos - (resistance * positionIndex)) + "px)",
          transition: "all .4s ease-in-out"
        });
        /** Set current element data true */
        resolve(true);
      });
    }

    $.each(allMenuLine, function (index, menuElement) {
      var menuLists = $(menuElement).find("li");
      $.each(menuLists, function (i, el) {
        /** Positionner la ligne */
        var lstData = $(el).data('current');
        if (lstData) {
          currentList = menuLists;
          lineMenu = $(menuElement).find(".line");
          positionLines(i);
        }

        $(el)
          .click(function () {
            var indexElement = i;
            currentList = menuLists;
            lineMenu = $(menuElement).find(".line");
            currentList = _.forEach(currentList, function (el) {
              $(el).data('current', false);
            });
            positionLines(indexElement)
              .then(function (response) {
                currentList.eq(indexElement).data("current", true);
              })
          })
          .mouseenter(function () {
            var indexElement = i;
            currentList = menuLists;
            lineMenu = $(menuElement).find(".line");
            positionLines(indexElement);
          })
          .mouseleave(function () {
            var elWidth = 0;
            var widthLists = [];
            $.each(currentList, function ($i, $el) {
              var hsCurrent = $($el).data("current");
              if (hsCurrent) {
                for (var j = 0; j < $i; j++) {
                  widthLists.push(currentList.eq(j).width() + 4);
                }
                elWidth = $($el).width();
              }
              lineMenu.css({
                width: (elWidth / 4) + "px",
                transform: "translate(" + _.reduce(widthLists, function (memo, num) {
                  return memo + num;
                }, 0) + "px)"
              });
            }); // .end each loop

          });
      });
    });

    if (QUnitTest) {
      QUnit.test("Orangea script basics", async function( assert ) {
        currentList = allMenuLine.eq(0).find('li');
        var requestPosition = await positionLines(2);
        assert.equal(requestPosition, true, 'La requete sur la verification de position a étes effectuer avec success');
        assert.ok( currentList, "currentList variable is'nt empty" );
      });
    }

    /**
     * Animer le scroll quand on clique sur le menu principal sur mobile ou sur desktop
     * @type {*|HTMLElement}
     */
    var MenuLists = $("li");
    $.each(MenuLists, function (index, el) {
      $(el)
        .find("a.anchorage")
        .on("click", function () {
          var target = $(this).attr('href');
          $("html, body").stop().animate({
            scrollTop: $(target).offset().top - 20
          }, 2500, function () {
            var goup = $('.goup');
            goup.fadeIn('slow', function () {
            });
          });
        }); // .end onClick

      /**
       * Ajouter une ligne d'animation sur l'objet definie
       */
      var line = $('.__menu_line').find('.line');
      if ( ! _.isEmpty(line))
        line.css({
          height: "2px",
          "margin-left": "10px"
        });

    }); // .end each loop

    /**
     * Evenement quand on clique sur le boutton qui dirige vers le haut
     */
    $('.goup')
      .hide()
      .on('click', function () {
        $('html, body').stop().animate({
          scrollTop: $('html, body').offset().top
        }, 1000, function () {
        });
      });

    /**
     * On scroll event browser
     */
    $(window).scroll(function () {
      var LimiteTop = 200; // 200px
      var win = $(window);
      var Top = win.scrollTop();
      scrollStatus = (Top > LimiteTop) ? true : false;
      if (scrollStatus) {
        var goup = $('.goup');
        if (goup.is(":visible")) return false;
        goup.fadeIn('slow', function () {
        });
      } else {
        $('.goup').fadeOut('slow', function () {
        });
      }
    });

    /**
     * Cette fonction permet de visualiser la 2em section (à propos)
     * à l'ouverture du site.
     */
    var updateSection = function () {
      var first_section = $(".org-1-section");
      if (_.isEmpty(first_section)) return;
      windowHeight = $(window).innerHeight();
      var _1_container = $(".org-section").find(".__org_container");
      var _2_container = first_section.find(".__org_container");
      var newContainerHeight;
      newContainerHeight = Math.abs(windowHeight - (Math.ceil(_2_container.height() / 2)));
      var cssObj = {
        "min-height": newContainerHeight + "px"
      };
      _1_container.css(cssObj);
      return cssObj;
    };

    /**
     * Ajouter une devider background
     */
    var updateDevider = function () {
      var parents = $(".__org_parent");
      var deviderWidth = parents.width();
      parents.each(function (index, el) {
        var devideBg = $(el).find(".__org_devider_bg");
        if (devideBg.length == 0) return;
        var mesure;
        mesure = (deviderWidth > 959) ? (deviderWidth / 2) + 70 : deviderWidth;
        devideBg.css({
          width: mesure + "px"
        });
      });
    };

    var __initResize__ = function () {
      updateSection();
      updateDevider();
    };

    __initResize__();
    $(window).resize(function () {
      __initResize__();
    });
  });

})(jQuery);