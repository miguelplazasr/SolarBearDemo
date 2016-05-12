/**
 * Created by miguelplazas on 12/05/16.
 */
(function (){
    'use strict';

    angular.module('SolarBearApp').controller('Customer.NewCtrl', Controller);
    
    function Controller($state, $mdDialog,dataToPass, Restangular){

        var vm = this;
        var baseCustomer = Restangular.all('customers');

        initController();

        vm.closeDialog = closeDialog;

        function initController() {

            dialogController();
            closeDialog();
            console.log('Customer.NewCtrl Aqui toy!');
            // reload alerts when updated
            //vm.$on('alerts-updated', loadCustomers);
        }

        function closeDialog() {
            console.log('me cierro!');
            //$state.go('home');
        }

        function dialogController($mdDialog) {
            vm.hide = function () {
                $mdDialog.hide();
            };
            vm.cancel = function () {
                console.log('test');
                $mdDialog.cancel();
            };
            vm.answer = function (answer) {
                $mdDialog.hide(answer);
            };
        }
        
    }
})();