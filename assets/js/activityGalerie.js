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
var App = angular.module('activityApp', ['ngSanitize']);
App.directive('activityGalerie', ['HTTPServices', 'Convert', '$window', function (HTTPServices, Convert, $window) {
  return {
    restrict: "E",
    scope: true,
    templateUrl: orangea.templateUrl + "galerie.html",
    link: function (scope, element, attrs) {
      scope.sectionId = attrs.galerieData;
      var form = new FormData();
      form.append('action', 'action_get_galerie');
      form.append('section_id', scope.sectionId);
      HTTPServices
        .getGalerie(form)
        .then(function (response) {
          var data = response.data;
          if (_.isNull(data) || false === data || !_.isArray(data)) return;
          var loadData = [];
          _.each(data, function (galerie) {
            Convert
              .toBase64(galerie)
              .then(function (res) {
                loadData.push(res);
              });
          });
          $window.setInterval(function () {
            var position = _.random(0, loadData.length - 1);
            scope.imageUrl = loadData[position].blob;
            scope.$apply();
          }, 2500);
        }, function (error) {
        });
      element
        .bind('click', function (event) {

        });
    }
  };
}]);

App.directive('zoomAnimation', function () {
  return {
    restrict: "A",
    scope: false,
    link: function (scope, element) {
      element.css({
        'background-position': 'center center',
        'animation': 'shrink 4s infinite alternate',
        'animation-timing-function': 'ease-in'
      });
    }
  }
});

App.directive('scaleAnimation', function () {
  return {
    restrict: "A",
    scope: false,
    link: function (scope, element) {
      element.css({
        top: 180,
        position: 'absolute',
        height: 'inherit',
        width: '100%',
        animation: 'Zoom 4s infinite alternate',
        'animation-timing-function': 'ease-out'
      });
    }
  }
});

App.factory("HTTPServices", function ($http, $q) {
  return {
    getGalerie: function (formdata) {
      return $http({
        url: orangea.ajax_url,
        method: "POST",
        headers: {'Content-Type': undefined},
        data: formdata
      })
    }
  };
});

App.factory('Convert', function () {
  return {
    toBase64: function (post) {
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
    }
  }
});

App.controller('galerieCtrl', ['$scope', '$window', 'HTTPServices', function ($scope, $window, HTTPServices) {
  $scope.sectionId = null;
  $scope.imageUrl = "";
}]);
