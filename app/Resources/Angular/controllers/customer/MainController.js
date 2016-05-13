(function () {
    'use strict';

    angular.module('SolarBearApp').controller('Customer.MainCtrl', Controller);

    function Controller( Restangular) {

        var vm = this;
        var baseCustomer = Restangular.all('customers');
        
        initController();
        
        function initController() {

            loadCustomers();
            // reload alerts when updated
            //vm.$on('alerts-updated', loadCustomers);
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