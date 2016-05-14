/**
 * Created by miguelplazas on 12/05/16.
 */
(function (){
    'use strict';

    angular.module('SolarBearApp').controller('Customer.NewCtrl', Controller);
    
    function Controller($state, $mdToast, Restangular){

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

            baseCustomer.post(rsCustomer).then(function(){
                console.log('Customer saved OK');
            }, function(){
                console.log('here was an error saving');
            });

            vm.saving = false;

            $mdToast.show({
                template: '<md-toast><span flex>Customer data saved!</span></md-toast>',
                hideDelay: 6000,
                position: "bottom left"
            });
            
            $state.go('home.appointment_new');

        }


        
        
    }
})();