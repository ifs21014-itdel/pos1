var posApp = angular.module('rePrintReceiveApp', []);
posApp.controller('struckCtrl2', function($scope, $http, $element) {
	$scope.order = JSON.parse(localStorage.getItem("order"));
	$scope.sales = $scope.order.sales[0];
	$scope.salesDetails = $scope.order.salesDetails;
	$scope.customer = $scope.order.customer[0];
	
	$scope.currencyFormatIDR = function(num) {
		num = parseFloat(num);
		return num.toFixed(0) // always two decimal digits
		.replace(".", ",") // replace decimal point character with ,
		.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");//+",-"; // use . as a separator
	}
});
