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

        }

        function toogleSidenav() {
            vm.toggleSidenav = function(menuId){
                $mdSidenav(menuId).toggle();
                console.log('Press it!');
            }
        }

    }

})();