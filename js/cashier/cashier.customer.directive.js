angular.module('cashierApp')
  .directive('fetchCustomer', ['$http', '$q', '$uibModal', function($http, $q, $uibModal){

    function showPopUpPickCustomer(query)
    {
      var modalInstance = $uibModal.open({
        animation: true,
        templateUrl: 'customer-modal.html',
        controller: 'modalCustomerController',
        size: 'lg',
        resolve: {
          searchCustomerKey: function(){
            return query;
          }
        }
      });

      return modalInstance.result;
    }

    function fetchCustomer(query)
    {
      var deferred = $q.defer();
      var param = $.param({"searchCustomerKey": query});

      $http({
          method: 'POST',
          url: baseUrl + "/cashier/Sales/getCustomer",
          data: param,
          headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      })
      .success(function (data, status, headers, config) {
        if (data === null || data.length < 1 || data === 'null') {
          showPopUpPickCustomer(query).then(function(data){
            deferred.resolve(data);
          }, function(){
            deferred.reject('No Customer Chosen');
          });
        } else {
          if (angular.isArray(data)) {
            deferred.resolve(data[0]);
          } else {
            deferred.resolve(data);
          }
        }
      })
      .error(function () {
        deferred.reject('Failed to get customer data');
      });

      return deferred.promise;
    }

    return {
      restrict: 'A',
      link: function (scope, elem, attrs, ctrl) {
        elem.bind('keydown', function(e){
          if (e.keyCode === 13) {
            fetchCustomer(elem.val()).then(function(result){
              scope.customer = result;
            }, function(data){
              console.log('error', data);
            });
          }
        });
      }
    };
  }])
  .controller('modalCustomerController', ['$scope', '$http', '$uibModalInstance', 'searchCustomerKey', 'NgTableParams', function($scope, $http, $uibModalInstance, searchCustomerKey, NgTableParams){
    $scope.customerName = searchCustomerKey;
    $scope.defaultConfigTableParams = new NgTableParams({
      page:1,
      total:1
    }, {
      getData: function(params) {
        return $http({
          method: 'POST',
          url: baseUrl + "/cashier/Sales/getCustomers",
          data:  $.param({"searchCustomerKey": $scope.customerName}),
          headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(result) {
          params.total(result.data.length);
          return result.data;
        });
      },
      counts: []
    });

    $scope.selectCustomer = function(customer){
      $uibModalInstance.close(customer);
    };

    $scope.$watch('customerName', function(n){
      $scope.customerName = n;
      $scope.defaultConfigTableParams.reload();
    });
  }]);