/**
 * Created by PhpStorm.
 * User: miguelplazas
 * Date: 10/05/16
 * Time: 0:35
 */
angular
    .module('SolarBearApp')
    .directive('ngCustomerForm', ngACustomerForm);

function ngCustomerForm() {
    var directive = {
        restrict: 'E',
        templateUrl: 'api/customers/new'

    };
    return directive;
};