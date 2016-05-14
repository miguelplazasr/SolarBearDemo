(function () {
    'use strict';

    angular.module('SolarBearApp').controller('Customer.MainCtrl', Controller);

    function Controller( $scope, Restangular) {

        var vm = this;
        var baseCustomer = Restangular.all('customers');
        
        initController();
        
        function initController() {

            loadCustomers();
            // reload alerts when updated
            $scope.$on('customers-updated', loadCustomers);
        }

        function loadCustomers() {
            baseCustomer.getList()
                .then(function (customers) {
                    // returns a list of users
                    vm.allCustomers = customers;
                });
        }

    }
})();