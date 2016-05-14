/**
 * Created by miguelplazas on 12/05/16.
 */
(function () {
    'use strict';

    angular.module('SolarBearApp').controller('Customer.NewCtrl', Controller);

    function Controller($scope, $state, $mdToast, Restangular) {

        var vm = this;
        var formCopy = {};
        var baseCustomer = Restangular.all('customers');
        vm.saving = false;

        initController();

        //vm.saveCustomer = saveCustomer(newCustomer);


        function initController() {
            console.log('Customer.NewCtrl Aqui toy!');
            // reload alerts when updated
            //vm.$on('alerts-updated', loadCustomers);
        }

        vm.saveCustomer = function (rsCustomer) {

            vm.saving = true;
            formCopy = angular.copy(rsCustomer);

            baseCustomer.post(rsCustomer).then(function () {
                console.log('Customer saved OK');

                $mdToast.show({
                    template: '<md-toast><span flex>Customer data saved!</span></md-toast>',
                    hideDelay: 6000,
                    position: "bottom left"
                });

                $scope.$emit('customers-updated');

                $state.go('home');

            }, function () {
                console.log('here was an error saving');

                $mdToast.show({
                    template: '<md-toast><span flex>Here was an error saving!</span></md-toast>',
                    hideDelay: 6000,
                    position: "bottom left"
                });
                vm.saving = false;
            });


            

        }


    }
})();