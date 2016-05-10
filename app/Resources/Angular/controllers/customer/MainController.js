(function() {
    'use strict';

angular.
    module('SolarBearApp').
    controller('Customer.MainCtrl', Controller );

function Controller($scope, Restangular) {

    var vm = this;
    var baseCustomer = Restangular.all('customers');

    initController();

    function initController() {

        loadCustomers();
        // reload alerts when updated
        $scope.$on('alerts-updated', loadCustomers);
    }

    function loadCustomers(){
        baseCustomer.getList()
            .then(function(customers) {
                // returns a list of users
                vm.allCustomers = customers;
                console.log(vm.allCustomers);
            });
    }

    vm.topDirections = ['left', 'up'];
    vm.bottomDirections = ['down', 'right'];
    vm.isOpen = true;
    vm.selectedMode = 'md-scale';
    vm.selectedDirection = 'left';

}

})();