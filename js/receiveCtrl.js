var posApp = angular.module('posApp', []);
posApp.controller('struckCtrl', function($scope, $http, $element) {
	$scope.date = new Date();
	$scope.order = JSON.parse(localStorage.getItem("order"));
	var orderTmp = JSON.parse(localStorage.getItem("order2"));
//	orderTmp = JSON.parse(orderTmp);
	var sales = orderTmp.sales;
	$scope.orderHeader = sales;
//	var salesDetails = orderTmp.salesDetails;
//	$scope.order = salesDetails;
	
	console.log("$scope.orderHeader",$scope.orderHeader);
	console.log("$scope.order",$scope.order);
	
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
	
	$scope.currencyFormatIDR = function(num) {
		num = parseFloat(num);
		return num.toFixed(0) // always two decimal digits
		.replace(".", ",") // replace decimal point character with ,
		.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");//+",-"; // use . as a separator
	}
});
