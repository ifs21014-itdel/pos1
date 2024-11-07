angular.module('cashierApp')
  .service('superKeyService', ['$q', function($q){

    var defferedPrint = $q.defer();

    this.handle = function(keyCode)
    {
      switch(keyCode) {
        case 113: // edit quuantity // F2
            console.log('F2');
            break;
        case 118: // pay // F7
            defferedPrint.resolve();
            break;
        default:
            break;
      }
    };


    this.isPay = function(){
      return defferedPrint.promise;
    };

    this.resetPay = function(){
      defferedPrint.resolve(true);
      defferedPrint = null;
      defferedPrint = $q.defer();
    };
  }]);