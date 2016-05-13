/**
 * Created by miguelplazas on 30/04/16.
 */


"use strict";

var app = angular.module('SolarBearApp',
    [
        'ngMaterial',
        'ngAnimate',
        'ngMdIcons',
        'ngMessages',
        'ui.router',
        'ngCookies',
        'restangular'
    ]);

app.config(function ($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});


app.config(function (RestangularProvider) {

    RestangularProvider.setBaseUrl('/api');

});

/**
 * Route configuration for the RDash module.
 */
app.config([
    '$stateProvider',
    '$urlRouterProvider',
    function ($stateProvider, $urlRouterProvider) {

        // For unmatched routes
        $urlRouterProvider.otherwise('/');

        // Application routes

        $stateProvider
            .state('home', {
                url: '/',
                templateUrl: '/main',
                controller: 'Home.MainCtrl',
                controllerAs: 'vm'

            })

            .state('home.customer_list', {
                url: '/customer',
                templateUrl: '/api/customers',
                controller: "Customer.MainCtrl",
                controllerAs: "vm"
            })
        
            .state('home.customer_new', {
                url: '/customer/new',
                templateUrl: '/api/customers/new.html',
                controller: "Customer.NewCtrl",
                controllerAs: "vm"
            })

            .state('home.appointment_new', {
                url: '/appointment/new',
                templateUrl: '/api/appointments/new.html',
                controller: "Appointment.NewCtrl",
                controllerAs: "vm"
            })


        /* Dialog on states Example
         .state('home.customer.new', {
         //url: '/new',
         //controller: "Customer.NewCtrl",
         //controllerAs: "vm",
         onEnter: function ( $mdDialog) {
         var ev = null; // this should be the $event 
         $mdDialog.show({
         controller: "Customer.NewCtrl",
         controllerAs: "vm",
         //scope: $scope.parentScopeData,
         locals:{dataToPass: $mdDialog},
         //parent: angular.element(document.body),
         //bindToController:true,

         templateUrl: '/api/customers/new.html',
         //parent: angular.element(document.body),
         targetEvent: ev,
         clickOutsideToClose: true,
         }
         ).then(function(answer) {
         // Noop
         }, function() {
         $scope.status = 'You cancelled the dialog.';
         });
         }
         })
         */


        /*
         .state('categories', {
         url: '/categories',
         templateUrl: './categories',
         controller: 'CategoryCtrl'
         })
         */
        ;
    }
]);

app.config(function ($mdThemingProvider) {
    var customBlueMap = $mdThemingProvider.extendPalette('blue', {
        'contrastDefaultColor': 'light',
        'contrastDarkColors': ['50'],
        '50': 'ffffff'
    });
    $mdThemingProvider.definePalette('customBlue', customBlueMap);
    $mdThemingProvider.theme('default')
        .primaryPalette('customBlue', {
            'default': '900',
            'hue-1': '50'
        })
        .accentPalette('green', {
            'default': '800'
        });
    $mdThemingProvider.theme('input', 'default')
        .primaryPalette('grey')
});

