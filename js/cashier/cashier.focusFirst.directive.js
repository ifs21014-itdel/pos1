angular.module('cashierApp')
    .directive('focusFirst', ['$document', function($document){
        return {
            restrict: 'A',
            link: function(scope, elem, attrs, ctrl){
                $(elem).focus();
                $(elem).blur();

                scope.$on('focus.input', function(){
                    $(elem).focus();
                });
            }
        };
    }])
    .directive('autoScroll', [function(){
        var height = function(elem) {
          elem = elem[0] || elem;
          if (isNaN(elem.offsetHeight)) {
            return elem.document.documentElement.clientHeight;
          } else {
            return elem.offsetHeight;
          }
        },
        offsetTop = function(elem) {
          if (!elem[0].getBoundingClientRect || elem.css('none')) {
            return;
          }
          return elem[0].getBoundingClientRect().top + pageYOffset(elem);
        },
        pageYOffset = function(elem) {
          elem = elem[0] || elem;
          if (isNaN(window.pageYOffset)) {
            return elem.document.documentElement.scrollTop;
          } else {
            return elem.ownerDocument.defaultView.pageYOffset;
          }
        };

        return {
            restrict: 'A',
            link: function(scope, elem, attrs, ctrl){
                scope.$watch(
                    function() {
                        return elem.attr('class');
                    },
                    function(n){
                        var container = $('.table-order'), classArr = n.split(' ');
                        if (classArr.indexOf('selected') > -1) {
                            var containerBottom, containerTopOffset, elementBottom, elemHeight, scrollTop, scrollBottom;
                            containerBottom = height(container);
                            elemHeight = height(elem);
                            containerTopOffset = 0;

                            if (offsetTop(container) !== void 0) {
                              containerTopOffset = offsetTop(container);
                            }

                            elementBottom = offsetTop(elem) - containerTopOffset + height(elem);

                            scrollBottom = containerBottom - elementBottom < 11;
                            scrollTop = elementBottom < 31;

                            if (scrollBottom) {
                                $(container).animate({
                                    scrollTop: height(container) + (elementBottom - containerBottom)
                                }, 300);
                            }

                            if (scrollTop) {
                                $(container).animate({
                                    scrollTop: 0
                                }, 300);
                            }
                        }
                    }
                );

            }
        };
    }])
    .directive('stickyHeader', [function(){
        return {
            restrict: 'A',
            link: function(scope, elem, attrs, ctrl){
                console.log('load sticky', elem);
                $(elem).stickyTableHeaders({
                    scrollableArea: $('.table-order')
                });
            }
        };
    }]);