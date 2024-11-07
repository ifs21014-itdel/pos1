angular.module('cashierApp')
  .controller('oderController', ['$scope', '$uibModal' , 'cashierResourceService', '$hotkey', '$q', function($scope, $uibModal, cashierApi, $hotkey, $q){
    $scope.order = {
      items: [],
      customer:  $scope.customer
    };

    $scope.selectedItemIndex = null;
    $scope.isListenerActive = true;

    var getSelectedItem = function()
    {
      if ($scope.order.items.length) {
        return $scope.order.items[$scope.selectedItemIndex];
      }

      return null;
    };

    var getTotalOrderPrice = function()
    {
      var total = 0;
      angular.forEach($scope.order.items, function(item){
        total += parseInt(item.total, 10);
      });
      return total;
    };

    var getOrderPrice = function()
    {
      var total = 0;
      angular.forEach($scope.order.items, function(item){
        total += parseInt(item.price, 10) * parseInt(item.quantity, 10);
      });
      return total;
    };

    var getTotalOrderDiscount= function()
    {
      var total = 0;
      angular.forEach($scope.order.items, function(item){
        total += parseInt(item.discount, 10);
      });
      return total;
    };

    var showPayModal = function(){
      $scope.isListenerActive = false;
      var modalInstance = $uibModal.open({
        animation: true,
        templateUrl: 'modal-pay-bill.html',
        controller: 'modalPayBillController',
        windowClass: 'center-modal',
        size: 'lg',
        resolve: {
          totalPrice: function(){
            return getTotalOrderPrice();
          },
          debitType: function(){
            return cashierApi.getDebitType();
          },
          creditCardType: function(){
            return cashierApi.getCreditCardType();
          }
        }
      });

      return modalInstance.result;
    };

    var openModalLogin = function()
    {
      $scope.isListenerActive = false;
      var modalLoginInstance = $uibModal.open({
        animation: true,
        templateUrl: 'modal-login.html',
        size: 'md',
        windowClass: 'modal-transparent',
        controller: 'modalLoginController'
      });

      return modalLoginInstance.result;
    };

    var changeDiscount = function()
    {
      var deffered = $q.defer();

      cashierApi.getChangeDiscountPemission().then(function(allowed){
        if (!allowed) {
          openModalLogin().then(function(isAllowed){
            if (isAllowed) {
              changeDiscountModal().then(function(data){
                deffered.resolve(data);
              }, function(){
                deffered.reject('not action performed');
              });
            } else {
              deffered.reject('not allowed to change discount');
            }
          });
        } else {
          changeDiscountModal().then(function(data){
            deffered.resolve(data);
          }, function(){
            deffered.reject('not action performed');
          });
        }
      });

      return deffered.promise;
    };

    var changeDiscountModal = function()
    {
      $scope.isListenerActive = false;

      var _editedScope = $scope.$new(true);

      _editedScope.item = getSelectedItem();

      var modalInstance = $uibModal.open({
        animation: true,
        templateUrl: 'modal-change-discount.html',
        size: 'md',
        scope: _editedScope,
        windowClass: 'center-modal',
        controller: 'editItemDiscountController'
      });

      return modalInstance.result;
    };

    var changeItemQuantitytModal = function()
    {
      $scope.isListenerActive = false;

      var _editedScope = $scope.$new(true);

      _editedScope.item = getSelectedItem();

      var modalInstance = $uibModal.open({
        animation: true,
        templateUrl: 'modal-change-quantity.html',
        size: 'md',
        scope: _editedScope,
        windowClass: 'center-modal',
        controller: 'editItemQuantityController'
      });

      return modalInstance.result;
    };

    var printReceive = function ()
    {
      $scope.isListenerActive = false;

      var receive = $scope.$new(true);

      receive.url = baseUrl + "/cashier/sales/printReceive";

      var modalInstance = $uibModal.open({
        animation: true,
        templateUrl: 'modal-print-receive.html',
        controller: 'modalPrintReceiveController',
        windowClass: 'center-modal',
        size: 'md',
        backdrop: false,
        scope: receive,
      });
    };

    $hotkey.bind('F7', function(event)
    {
      event.preventDefault();
      if ($scope.order.items.length){
        showPayModal().then(function(payment){
          console.log('payment: ', payment);
          printReceive();
        })
        .finally(function(){
          $scope.isListenerActive = true;
        });
      } else {
        console.log('Ga punya item untuk dibayar');
      }
    });

    $hotkey.bind('F4', function(event)
    {
      // Discount
      if ($scope.selectedItemIndex !== null && $scope.order.items.length) {
        changeDiscount()
          .then(function(){
            angular.noop();
          })
          .finally(function(){
            $scope.isListenerActive = true;
          });
      }
    });

    $hotkey.bind('F2', function(event)
    {
      // quantity
      if ($scope.selectedItemIndex !== null && $scope.order.items.length) {
        changeItemQuantitytModal().then(function(item)
        {
          // jika quantity tambah,
          // cek diskon
          // update harga
          item.total = item.quantity * item.price;
        })
        .finally(function(){
          $scope.isListenerActive = true;
        });
      }
    });


    $hotkey.bind('up', function(){
        if ($scope.isListenerActive && $scope.order.items.length) {
            if ($scope.selectedItemIndex !== null & $scope.selectedItemIndex > 0) {
                --$scope.selectedItemIndex;
            }
        }
    });

    $hotkey.bind('down', function(){
        if ($scope.isListenerActive && $scope.order.items.length) {
            if ($scope.selectedItemIndex < ($scope.order.items.length -1)) {
                ++$scope.selectedItemIndex;
            }
        }
    });


    $scope.oderPrice = getOrderPrice;
    $scope.totalOrderPrice = getTotalOrderPrice;
    $scope.totalOrderDiscount = getTotalOrderDiscount;

    $scope.$watch('selectedItemIndex', function(n){
        // console.log('selectedItemIndex', n);
    });
  }])
  .controller('modalPayBillController', ['$scope', '$uibModalInstance', '$hotkey', 'cashierResourceService', 'totalPrice', 'debitType', 'creditCardType', function($scope, $uibModalInstance, $hotkey, cashierApi, totalPrice, debitType, creditCardType){
    $scope.totalPrice = totalPrice;
    $scope.debitType = debitType;
    $scope.creditCardType = creditCardType;

    $scope.showCash = true;
    $scope.showDebit = false;
    $scope.showCredit = false;
    $scope.showVoucher = false;

    $scope.cash = {};
    $scope.debit = {};
    $scope.creditCard = {};
    $scope.voucher = {};


    $scope.totalBayar = 100000;

    $scope.getKembalian = function()
    {
      // if ($scope.showCash && $scope.cash.amount) {
      //   $scope.totalBayar += parseInt($scope.cash.amount, 10);
      // }
      // if ($scope.showDebit && $scope.debit.amount) {
      //   $scope.totalBayar += parseInt($scope.debit.amount, 10);
      // }
      // if ($scope.showCredit && $scope.creditCard.amount) {
      //   $scope.totalBayar += parseInt($scope.creditCard.amount, 10);
      // }
      // if ($scope.showVoucher && $scope.voucher.amount) {
      //   $scope.totalBayar += parseInt($scope.voucher.amount, 10);
      // }

      return $scope.totalBayar - totalPrice;
    };

    var saveOrder = function ()
    {
      if ($scope.totalPrice > $scope.totalBayar) {
        alert("Pembayaran tidak cukup, Silahkan gunakan pembayaran lain.");
      }

      var payment = {
        totalQuantity: 0,
        totalPrice: $scope.totalPrice,
        totalCash: $scope.totalBayar,
        amountPayByCash: $scope.totalBayar,
        changeCash: $scope.changeCash,
        creditCardNumber: $scope.cc.no ? $scope.cc.no : '' ,
        amountPayByCreditCard: $scope.cc.amount? $scope.cc.amount : '',
        creditCardType: $scope.cc.bank ? $scope.cc.bank : '',
        debitCardNumber: $scope.debit.no ? $scope.debit.no: '',
        debitCardType: $scope.debit.bank ? $scope.debit.bank : '',
        amountPayByDebitCard: $scope.debit.amount ? $scope.debit.amount: '',
        voucherNumber: $scope.voucher.no ? $scope.voucher.no: '',
        amountPayByVoucher: $scope.voucher.amount ? $scope.voucher.amount: ''
      };

      var orderParam = JSON.stringify($scope.order);
      var param = 'order=' + encodeURIComponent(orderParam);

      cashierApi.saveOrder(param).then(function(){
        $uibModalInstance.close(payment);
      }, function(){
        alert("Transaksi gagal dilakukan, silahkan hubungi Support!");
      })
      .finally(function(){
        $scope.checkOutButtonDisabled = false;
      });

    };

    $hotkey.bind('F2', function(event){
      saveOrder();
    });
  }])
  .controller('modalPrintReceiveController', ['$uibModalInstance', '$window', function($uibModalInstance, $window){

    var beforePrint = function() {
      alert('Functionality to run before printing.');
    };
    var afterPrint = function() {
      alert('Functionality to run after printing');
    };

    window.matchMedia('print')
      .addListener(function(listener) {
          console.log(listener);
          if (listener.matches) {
            beforePrint();
          } else {
            afterPrint();
          }
      });

    window.onbeforeprint = beforePrint;
    window.onafterprint = afterPrint;

  }])
  .controller('editItemQuantityController', ['$scope', '$uibModalInstance', '$hotkey', function($scope, $uibModalInstance, $hotkey){
      $hotkey.bind('enter', function(){
        $uibModalInstance.close($scope.item);
      });
  }])
  .controller('editItemDiscountController', ['$scope', '$uibModalInstance', function($scope, $uibModalInstance){
    $scope.discountOptions = [
      {name: 'Percent', value: 'true'},
      {name: 'Price', value: 'false'}
    ];

    if (!$scope.item.discountType) {
        $scope.item.discountType = 'true';
    }
  }])
  .controller('modalLoginController', ['$scope', '$uibModalInstance', 'cashierResourceService', function($scope, $uibModalInstance, cashierApi){

    $scope.processLogin = function(){
      cashierApi.customLogin({username: $scope.username, password:$scope.password})
        .then(function(result){
          $uibModalInstance.close(result.data.message.isAllowed);
        }, function(){
          $uibModalInstance.dismiss('Failed to login');
        });
    };

  }]);