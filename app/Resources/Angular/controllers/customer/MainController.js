/**
 * Created by miguelplazas on 9/05/16.
 */
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
}