(function(){
    'use strict';

    angular.
        module('SolarBearApp').
        controller('Home.MainCtrl', Controller);

    function Controller( $scope, $mdBottomSheet, $mdSidenav, $mdDialog, Restangular) {

        var vm = this;

        var baseCustomer = Restangular.all('customers');
        var baseAppointment = Restangular.all('appointments');
        
        initController();

        function initController() {

            $scope.$on('customers-updated', countCustomers);
            $scope.$on('appointments-updated', countAppointments);

            toogleSidenav();
            mainMenu();
            countCustomers();
            countAppointments();
        }

        function toogleSidenav() {
            vm.toggleSidenav = function(menuId){
                $mdSidenav(menuId).toggle();
                console.log('Press it!');
            }
        }

        function mainMenu() {
            vm.menu = [
                {
                    link : 'dashboard',
                    title: 'Dashboard',
                    icon: 'dashboard',
                    sref: 'home'
                },
                {
                    link : 'home.customer.new',
                    title: 'Customers',
                    icon: 'group',
                    sref: 'home.customer_new'
                },
                {
                    link : 'home.appointment.new',
                    title: 'Appointments',
                    icon: 'alarm',
                    sref: 'home.appointment_new'
                }
            ];
        }

        function countCustomers() {
            baseCustomer.getList()
                .then(function (customers) {
                    // returns a list of users
                    vm.countCustomers = customers.length;
                });
        }

        function countAppointments() {
            baseAppointment.getList()
                .then(function (appointments) {
                    // returns a list of users
                    vm.countAppointments = appointments.length;
                });
        }
    }

})();