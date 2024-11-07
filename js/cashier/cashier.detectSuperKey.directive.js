angular.module('cashierApp')
  .directive('detectSuperKey', ['$document', 'superKeyService', function($document, superKeyService){
    return {
      restrict: 'A',
      link: function(scope, elem, attrs, ctrl){
        $document.bind('keydown', function(e){
          superKeyService.handle(e.keyCode);
          // e.preventDefault();
        });

      }
    };
  }]);