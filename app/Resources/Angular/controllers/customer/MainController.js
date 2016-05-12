(function () {
    'use strict';

    angular.module('SolarBearApp').controller('Customer.MainCtrl', Controller);

    function Controller( $mdDialog, Restangular) {

        var vm = this;
        var baseCustomer = Restangular.all('customers');

        vm.showAdd = showAdd;

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

        /*
         vm.showAdd = function (ev) {
         console.log('Clicked!');

         var useFullScreen = ($mdMedia('sm') || $mdMedia('xs'))  && vm.customFullscreen;


         $mdDialog.show({
         controller: DialogController,
         templateUrl: '<md-dialog><md-dialog-content><h1>dialogo</h1></md-dialog-content></md-dialog>',
         parent: angular.element(document.body),
         targetEvent: ev,
         clickOutsideToClose:true,
         //fullscreen: useFullScreen
         })
         .then(function(answer) {
         vm.status = 'You said the information was "' + answer + '".';
         }, function() {
         vm.status = 'You cancelled the dialog.';
         });


         };
         */
        function DialogController($mdDialog) {
            vm.hide = function () {
                $mdDialog.hide();
            };
            vm.cancel = function () {
                $mdDialog.cancel();
            };
            vm.answer = function (answer) {
                $mdDialog.hide(answer);
            };
        }

        function showAdd(ev) {
            console.log('hi');


            $mdDialog.show({
                controller: DialogController,
                templateUrl: '/api/customers/new.html',
                parent: angular.element(document.body),
                targetEvent: ev,
                clickOutsideToClose: true,
            })
                .then(function (answer) {
                    vm.status = 'You said the information was "' + answer + '".';
                }, function () {
                    vm.status = 'You cancelled the dialog.';
                });

        }


    }
})();