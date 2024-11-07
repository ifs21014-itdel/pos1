angular.module('cashierApp')
  .service('cashierResourceService', ['$http', '$q', function($http, $q){

    this.getDebitType = function(){
      return $http({
          method: 'POST',
          url: baseUrl + "/master/card_type/get_debit_card_type",
          headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      })
      .then(function(result) {
        return result.data;
      });
    };

    this.getCreditCardType = function(){
      return $http({
          method: 'POST',
          url: baseUrl + "/master/card_type/get_credit_card_type",
          headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      })
      .then(function(result) {
        return result.data;
      });
    };


    this.saveOrder = function(param)
    {
      return $http({
          method: 'POST',
          url: baseUrl + "/cashier/sales/saveOrder",
          data: param,
          headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
              "X-Requested-With": "XMLHttpRequest"}
      });
    };

    this.getChangeDiscountPemission = function()
    {
      var deffered = $q.defer();

      $http({
            method: 'GET',
            url: baseUrl + "/cashier/sales/checkUserPermissionToUpdateDiscount",
        })
        .success(function (data) {
            if (data.success) {
              deffered.resolve(true);
            } else {
              deffered.resolve(false);
            }
        })
        .error(function () {
          deffered.resolve(false);
        });

      return deffered.promise;
    };

    this.customLogin = function(param)
    {
      return $http({
          method: 'POST',
          url: baseUrl + "/accounts/accounts/custom_login_auth",
          data: param
      });
    };

  }]);