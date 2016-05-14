/**
 * Created by miguelplazas on 13/05/16.
 */

(function () {
    'use strict';

    angular.module('SolarBearApp').controller('Appointment.NewCtrl', Controller);

    function Controller($state, $mdToast, $filter, Restangular) {

        var vm = this;
        var formCopy = {};
        var baseAppointment = Restangular.all('appointments');
        vm.saving = false;

        initController();

        function initController() {
            console.log('Appointment.NewCtrl was loaded!');
        }

        vm.saveAppointment = function (rsAppointment) {

            formCopy = angular.copy(rsAppointment);

            //rsAppointment.date = $filter('date')(rsAppointment.date,'yyyy-MM-dd');
            
            console.log(rsAppointment.date);

            baseAppointment.post(rsAppointment).then(function () {
                console.log('Appointment saved OK');
            }, function () {
                console.log('here was an error saving');
            });

        }

    }
})();