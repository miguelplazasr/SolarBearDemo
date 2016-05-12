(function(){
    'use strict';

    angular.
        module('SolarBearApp').
        controller('Home.MainCtrl', Controller);

    function Controller( $mdBottomSheet, $mdSidenav, $mdDialog, Restangular) {

        var vm = this;

        initController();

        function initController() {

            toogleSidenav();
            mainMenu();

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
                    link : 'home',
                    title: 'Dashboard',
                    icon: 'dashboard',
                    sref: 'home'
                },
                {
                    link : 'home.customer',
                    title: 'Customers',
                    icon: 'group',
                    sref: 'home.customer'
                },
                {
                    link : '',
                    title: 'Messages',
                    icon: 'message'
                }
            ];
        }

    }

})();