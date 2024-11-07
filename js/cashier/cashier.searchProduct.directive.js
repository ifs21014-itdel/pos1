angular.module('cashierApp')
  .directive('searchProduct', ['$http', '$q', '$uibModal', '$filter', function($http, $q, $uibModal, $filter){

    var showPopUpPickItem = function(searchKey){
      var modalInstance = $uibModal.open({
        animation: true,
        templateUrl: 'search-item-modal.html',
        controller: 'modalSearchItemController',
        windowClass: 'center-modal',
        size: 'lg',
        resolve: {
          searchKey: function(){
            return searchKey;
          }
        }
      });

      return modalInstance.result;
    };

    var fetchItem = function (searchKey)
    {
      var deffered = $q.defer();

      $http({
          method: 'POST',
          url: baseUrl + "/cashier/sales/getItem",
          data: $.param({"searchKey": searchKey}),
          headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      })
      .success(function (data, status, headers, config) {
          if (data === null || data.length < 1) {
            showPopUpPickItem(searchKey).then(function(result){
              deffered.resolve(result);
            }, function(){
              deffered.reject('No item selected');
            });
          } else {
            deffered.resolve(data);
          }
      }).error(function () {
        deffered.reject('item not found');
      });

      return deffered.promise;
    };

    return {
      restrict: 'A',
      link: function (scope, elem, attrs, ctrl) {
        var itemExist = function(searchKey){
            var exist = $filter('filter')(scope.order.items, {'barcode':searchKey});
            return exist.length ? true : false;
        };

        $(elem).focus();

        elem.bind('keydown', function(e){
          if (e.keyCode === 13) {
            if (itemExist(elem.val())) {
                angular.forEach(scope.order.items, function(orderItem){
                    if (orderItem.barcode == elem.val()) {
                        orderItem.quantity++;
                        orderItem.total = parseInt(orderItem.price, 10) * parseInt(orderItem.quantity, 10);
                    }
                });
            } else {
              scope.isListenerActive = false;
              fetchItem(elem.val()).then(function(data){

                if (itemExist(data.barcode)) {
                    angular.forEach(scope.order.items, function(orderItem){
                        if (orderItem.barcode == data.barcode) {
                            orderItem.quantity++;
                            orderItem.total = parseInt(orderItem.price, 10) * parseInt(orderItem.quantity, 10);
                        }
                    });
                } else {
                    data.quantity = 1;
                    data.total = data.price * data.quantity;
                    scope.order.items.push(data);
                    scope.selectedItemIndex = (scope.order.items.length -1);
                }
                scope.searchProduct = '';
              })
              .finally(function(){
                scope.isListenerActive = true;
              });
            }
          }
        });
      }
    };
  }])
  .controller('modalSearchItemController', ['$rootScope', '$scope', '$http', '$uibModalInstance', 'searchKey', 'NgTableParams', '$hotkey', function($rootScope, $scope, $http, $uibModalInstance, searchKey, NgTableParams, $hotkey){
    $scope.itemName = searchKey || '';
    $scope.isProductsListenerActive = true;
    $scope.selectedProductsIndex = null;

    $scope.selectedItemIndex = null;
    $scope.defaultConfigTableParams = new NgTableParams({
      page:1,
      total:1
    }, {
      getData: function(params) {
        return $http({
            method: 'POST',
            url: baseUrl + "/cashier/sales/getItems",
            data: $.param({"searchKey":  $scope.itemName}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .then(function(result) {
          params.total(result.data.length);
          return result.data;
        });
      },
      counts: []
    }
    );

    $scope.selectItem = function(item){
      $scope.selectedProductsIndex = null;
      $uibModalInstance.close(item);
    };

    $hotkey.bind('enter', function(e){
      if ($scope.selectedProductsIndex !== null) {
        var item = $scope.defaultConfigTableParams.data[$scope.selectedProductsIndex];
        $scope.selectedProductsIndex = null;
        $uibModalInstance.close(item);
      } else {
        $uibModalInstance.dismiss();
      }
    });

    $scope.$watch('itemName', function(o, n){
      if (o !== n) {
        $scope.defaultConfigTableParams.reload();
      }
    });

    $rootScope.$on('change-selected-index', function(arg, e){
      if ($scope.isProductsListenerActive) {
        $scope.selectedProductsIndex = e;
      }
    });
  }]);