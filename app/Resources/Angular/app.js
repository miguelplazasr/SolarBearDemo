/**
 * Created by miguelplazas on 30/04/16.
 */


"use strict";

var app = angular.module('SolarBearApp',
    [
        'ngMaterial',
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

    //RestangularProvider.setDefaultHttpFields({cache: true});

    /*
    RestangularProvider.addResponseInterceptor(function (data, operation, what, url, response, deferred) {
        var newResponse = response;

        console.log(data);

        if (operation === "getList") {
            angular.forEach(newResponse, function (value, key) {
                newResponse[key].originalElement = angular.copy(value);
            });
        } else {
            newResponse.originalElement = angular.copy(response);
        }
        return newResponse;
    });*/
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
                templateUrl: '/',
            })

            .state('customer', {
                url: '/customer',
                templateUrl: '/api/customers',
                controller: "Customer.MainCtrl",
                controllerAs: "vm"
            })

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


/* Theming Configuration */
app.config(function ($mdThemingProvider) {
    $mdThemingProvider.theme('default')
        .primaryPalette('blue', {
            'default': '900'
        })
        .accentPalette('green', {
            'default': '800'
        })
});


app.run(function ($rootScope) {

    // track current state for active tab
    $rootScope.$on('$stateChangeSuccess', function (event, toState, toParams, fromState, fromParams) {
        $rootScope.currentState = toState.name;
    });
});