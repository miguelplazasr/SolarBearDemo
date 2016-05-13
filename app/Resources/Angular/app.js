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
                templateUrl: '/main',
                controller: 'Home.MainCtrl',
                controllerAs: 'vm'

            })

            /*
             .state('home.sidebar', {
             url: '/sidenavbar',
             templateUrl: '/sidenavbar',
             controller: "MainCtrl",
             controllerAs: "vm"
             })
             */

            .state('home.customer_list', {
                url: '/customer',
                templateUrl: '/api/customers',
                controller: "Customer.MainCtrl",
                controllerAs: "vm"
            })

        
            .state('home.customer_new', {
                url: '/new',
                templateUrl: '/api/customers/new.html',
                controller: "Customer.NewCtrl",
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

/* Theming Configuration */
/*app.config(function ($mdThemingProvider) {
 $mdThemingProvider.theme('default')
 .primaryPalette('blue', {
 'default': '900'
 })
 .accentPalette('green', {
 'default': '800'
 })
 });
 */
