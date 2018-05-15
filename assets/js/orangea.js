
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
    allListSelector,
    allMenuLine,
    currentList;

  allMenuLine = $( ".__menu_line");
  allListSelector = allMenuLine.find("li");
  currentList = [];

  $( document ).ready(function () {
    var windowHeight;

    // Positionner la ligne sous le menu
    function positionLine ( positionIndex ) {
      return new Promise(function (resolve) {
        var listIndex = positionIndex;
        var currentListWidth = currentList.eq( positionIndex ).width();
        var translationContainer = [];
        for (var i = 0; i < listIndex; i++) {
          translationContainer.push( currentList.eq(i).width() + 4 );
        }
        lineMenu.css({
          width: (currentListWidth / 4) + "px",
          transform: "translate(" + _.sumBy(translationContainer) + "px)",
          transition: "all .4s ease-in-out"
        });

        /** set current element data true */
        resolve(true);
      });

    }

    $.each(allMenuLine, function (index, menuElement) {
      var menuLists = $( menuElement ).find("li");
      $.each(menuLists, function (i, el) {

        /** Positionner la ligne */
        var lstData = $( el ).data( 'current' );
        if (lstData) {
          currentList = menuLists;
          lineMenu = $( menuElement ).find( ".line" );
          positionLine( i );
        }

        $( el )
          .click(function () {
            var indexElement = i;
            currentList = menuLists;
            lineMenu = $( menuElement ).find( ".line" );
            currentList = _.forEach( currentList, function (el) {
              $( el ).data('current', false);
            });
            positionLine( indexElement )
              .then(function ( response ) {
                currentList.eq( indexElement ).data("current", true);
              })
          })
          .mouseenter(function () {
            var indexElement = i;
            currentList = menuLists;
            lineMenu = $( menuElement ).find( ".line" );
            positionLine( indexElement );
          })
          .mouseleave(function () {
            var elWidth = 0;
            var widthLists = [];
            $.each(currentList, function ($i, $el) {
              var hsCurrent = $( $el ).data( "current" );
              if (hsCurrent) {
                for (var j = 0; j < $i; j++) {
                  widthLists.push( currentList.eq(j).width() + 4 );
                }
                elWidth = $( $el ).width();
              }
              lineMenu.css({
                width: (elWidth/4) + "px",
                transform: "translate(" + _.sumBy(widthLists) + "px)"
              });
            }); // .end each loop

          });
      });
    });


    $.each(allListSelector, function (index, el) {
      $( el )
        .find( "a.anchorage" )
        .on("click", function () {
          var target = $( this ).attr( 'href' );
          $( "html, body" ).stop().animate({
            scrollTop: $( target ).offset().top - 20
          }, 2500, function () {
            var goup = $( '.goup' );
            goup.fadeIn('slow', function () {
            });
          });
        }); // .end onClick

      /**
       * Menu line
       */
      var line = $('.__menu_line').find('.line');
      line.css({
        height: "2px",
        "margin-left": "10px"
      });

    }); // .end each loop

    /** Scroll top */
    $('.goup')
      .hide()
      .on('click', function () {
        $('html, body').stop().animate({
          scrollTop: $('html, body').offset().top
        }, 1000, function () {
        });
      });

    $(window).scroll(function (event) {
      var LimiteTop = 200; // 200px
      var win = $(window);
      var Top = $(win).scrollTop();
      scrollStatus = (Top > LimiteTop) ? true : false;
      if (scrollStatus) {
        // $( '.goup' ).fadeIn('slow', function(){});
        var goup = $('.goup');
        if (goup.is(":visible")) return false;
        goup.fadeIn('slow', function () {
        });
      } else {
        $('.goup').fadeOut('slow', function () {
        });
      }
    });

    var updateSection = function () {
      var first_section = $(".org-1-section");
      if (_.isEmpty( first_section )) return;

      windowHeight = $(window).innerHeight();
      var _1_container = $(".org-section").find(".__org_container");
      var _2_container = first_section.find(".__org_container");
      var newContainerHeight;
      newContainerHeight = Math.abs(windowHeight - Math.ceil(_2_container.height()));
      _1_container.css({
        "min-height": newContainerHeight + "px"
      });
    };
    var updateDevider = function () {
      var parents = $(".__org_parent");
      var deviderWidth = parents.width();
      parents.each(function (index, el) {
        var devideBg = $(el).find(".__org_devider_bg");
        if (devideBg.length == 0 ) return;
        var mesure;
        mesure = (deviderWidth > 959) ? deviderWidth / 2 : deviderWidth;
        devideBg.css({
          width: mesure + 70 + "px"
        });
      });
    };

    updateSection();
    updateDevider();
    $(window).resize(function () {

      updateSection();
      updateDevider();
    });
  });

})(jQuery);