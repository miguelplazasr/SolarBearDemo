(function () {
    'use strict';

    angular.module('SolarBearApp').controller('Appointment.MainCtrl', Controller);

    function Controller( Restangular) {

        var vm = this;
        var baseAppointment = Restangular.all('appointments');
        
        initController();
        
        function initController() {

            loadAppointments();
            // reload alerts when updated
            //vm.$on('alerts-updated', loadCustomers);
        }

        function loadAppointments() {
            baseAppointment.getList()
                .then(function (appointments) {
                    // returns a list of users
                    vm.allAppointments = appointments;
                });
        }

    }
})();