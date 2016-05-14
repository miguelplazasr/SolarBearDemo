/**
 * Created by miguelplazas on 13/05/16.
 */

(function () {
    'use strict';

    angular.module('SolarBearApp').controller('Appointment.NewCtrl', Controller);

    function Controller($scope, $mdSidenav, $state, $mdToast, $filter, Restangular) {

        var vm = this;
        var formCopy = {};
        var baseAppointment = Restangular.all('appointments');
        vm.saving = false;

        initController();

        function initController() {
            $mdSidenav('left').toggle();
            console.log('Appointment.NewCtrl was loaded!');
        }

        vm.saveAppointment = function (rsAppointment) {

            vm.saving = true;
            formCopy = angular.copy(rsAppointment);

            rsAppointment.date = $filter('date')(rsAppointment.date,'yyyy-MM-dd');
            
            baseAppointment.post(rsAppointment).then(function () {
                console.log('Appointment saved OK');

                $mdToast.show({
                    template: '<md-toast><span flex>Appointment data saved!</span></md-toast>',
                    hideDelay: 6000,
                    position: "bottom left"
                });
                
                $scope.$emit('appointments-updated');

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