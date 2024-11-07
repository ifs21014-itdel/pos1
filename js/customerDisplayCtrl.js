var posApp = angular.module('posApp', ['ngStorage']);
posApp.controller('customerDisplayCtrl', function($scope, $http, $element,$localStorage) {
	
	$scope.date = new Date();
	$scope.order = JSON.parse(localStorage.getItem("order"));
	$scope.$storage = $localStorage.$default({
        order : {}
      });
	
	$scope.calculateBebanTotalOfFamily = function(item) {
		var bebanFamily = $scope.order.customer.discount;
		if(bebanFamily != "undefined" && item != "undefined"){
			return ((item.quantity * item.price) * bebanFamily /100);
		}
		return 0;
	};
	
	$scope.calculateSubTotalPrice = function(quantity, price) {
		var discount = $scope.order.customer.discount;
		var subTotal = 0;
		if(discount == undefined){
			discount = 0;
		}
		if(quantity != undefined && price != undefined && discount !=undefined){
			subTotal = ((quantity * price)+((quantity * price) * discount /100));
		}
                    
		return subTotal;
	};
	
	$scope.currencyFormatDefault = function(num) {
		num = parseFloat(num) || 0;
		return num.toFixed(0) // always two decimal digits
		.replace(".", ",") // replace decimal point character with ,
		.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."); // use . as a separator
	}
	
	$scope.currencyFormatIDR = function(num) {
		num = parseFloat(num);
		return num.toFixed(0) // always two decimal digits
		.replace(".", ",") // replace decimal point character with ,
		.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");//+",-"; // use . as a separator
	}
});
