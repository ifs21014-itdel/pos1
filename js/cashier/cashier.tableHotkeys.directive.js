angular.module('cashierApp')
  .directive('bindTable', ['$rootScope', '$hotkey', function($rootScope, $hotkey){
    return {
      restrict: 'A',
      link: function(scope, elem, attr, ctrl){
        var _listener_id = scope.$eval(attr.bindId);
        var _bindingActive = false;

        $hotkey.bind('up', function(){
          if (_bindingActive) {
            ctrl.decreaseActiveindex(_listener_id);
            $rootScope.$broadcast('change-selected-item', ctrl.getActiveRowId(_listener_id));
            $rootScope.$broadcast('change-selected-index', ctrl.selectedItemIndex[_listener_id]);
          }
        });

        $hotkey.bind('down', function(){
          if (_bindingActive) {
            ctrl.increaseActiveindex(_listener_id);
            $rootScope.$broadcast('change-selected-item', ctrl.getActiveRowId(_listener_id));
            $rootScope.$broadcast('change-selected-index', ctrl.selectedItemIndex[_listener_id]);
          }
        });

        scope.$watch(function(){ return scope.$eval(attr.bindTable);}, function(bindingActive){
          _bindingActive = bindingActive;
        });

        scope.$watch(function(){ return scope.$eval(attr.selectedIndex);}, function(selectedIndex){
          // console.log('selected index', attr.bindId, selectedIndex);
          if (_bindingActive) {
            ctrl.setActiveIndex(_listener_id, selectedIndex);
            $rootScope.$broadcast('change-selected-item', ctrl.getActiveRowId(_listener_id));
            $rootScope.$broadcast('change-selected-index', ctrl.selectedItemIndex[_listener_id]);
          }
        });

      },
      controller: function($scope){
        this.row = [];
        this.selectedItemIndex = [];

        this.getActiveRowId = function(listener){
          // console.log('getActiveRowId', listener, this.selectedItemIndex[listener], this.row[listener]);
          if (this.row[listener] && this.row[listener].length) {
            if (this.row[listener][this.selectedItemIndex[listener]]) {
              return this.row[listener][this.selectedItemIndex[listener]].id;
            } else {
              return this.row[listener][this.row[listener].length - 1].id;
            }
          } else {
            return null;
          }
        };

        this.addRow = function(listener, item, increase){
          if (!this.row[listener]) {
            this.row[listener] = [];
          }

          this.row[listener].push(item);
          if (increase) {
            this.increaseActiveindex(listener);
          }
        };

        this.setActiveIndex = function(listener, i){
          if (!this.selectedItemIndex[listener]) {
            this.selectedItemIndex.push(listener);
          }

          this.selectedItemIndex[listener] = i;
        };

        this.decreaseActiveindex = function(listener){
          if (this.selectedItemIndex[listener]) {
            --this.selectedItemIndex[listener];
          }
        };

        this.increaseActiveindex = function(listener)
        {
          if (this.selectedItemIndex[listener] === null) {
           this.selectedItemIndex[listener] = 0;
          } else {
            // console.log('row length increase', this.selectedItemIndex[listener] < (this.row[listener].length - 1));
            if (this.selectedItemIndex[listener] < (this.row[listener].length - 1)) {
              ++this.selectedItemIndex[listener];
            }
          }
        };
      }
    };
  }])
  .directive('bindRow', [function(){
    return {
      restrict: 'A',
      require: '^bindTable',
      scope: {
        item: '=bindRow'
      },
      link: function(scope, elem, attr, bindTableCtrl){
        var _listener_id =  scope.$eval(attr.bindId);
        var increaseOnAdd = scope.$eval(attr.increaseOnAdd) == 'true' ? true : false;

        bindTableCtrl.addRow(_listener_id, scope.item, increaseOnAdd);

        scope.$on('change-selected-item', function(e, selectedId){
          if (scope.item.id == selectedId) {
            elem.css('background', '#DCE9BE');
          } else {
            elem.css('background', 'none');
          }
        });
      }
    };
  }]);