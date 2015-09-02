var subconApp = angular.module('SubConApplication', ['ui.router', 'ng-context-menu', 'ui.grid', 'ui.grid.autoResize', 'ui.grid.moveColumns', 'ui.grid.resizeColumns', 'ui.grid.selection', 'ui.grid.exporter'])
.run(function($rootScope, $interval){
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    //Manipulate DOM for removing an element
    $rootScope.manipulateDOM = function () {
        Element.prototype.remove = function () {
            this.parentElement.removeChild(this);
        }
        NodeList.prototype.remove = HTMLCollection.prototype.remove = function () {
            for (var i = this.length - 1; i >= 0; i--) {
                if (this[i] && this[i].parentElement) {
                    this[i].parentElement.removeChild(this[i]);
                }
            }
        }
    };
});

subconApp.config(function ($stateProvider, $urlRouterProvider) {
    //default view in ui-view
    $urlRouterProvider.otherwise("/");

    $stateProvider
     //Trucking
    .state('Trucking', {
        url: "/trucking",
        templateUrl: "/subcontractor/trucking/view",
        controller: "TruckingController"
    })
    //Shipping Line
    .state('ShippingLine', {
        url: "/shippingline",
        templateUrl: "/subcontractor/shippingline/view",
        controller: "ShippingLineController"
    })


});
    // -------------------------------------------------------------------------//
    // Usage for spin.js
    var opts = {
        lines: 11, // The number of lines to draw
        length: 11, // The length of each line
        width: 4, // The line thickness
        radius: 11, // The radius of the inner circle
        corners: 1, // Corner roundness (0..1)
        rotate: 0, // The rotation offset
        direction: 1, // 1: clockwise, -1: counterclockwise
        color: '#000', // #rgb or #rrggbb or array of colors
        speed: 1, // Rounds per second
        trail: 46, // Afterglow percentage
        shadow: false, // Whether to render a shadow
        hwaccel: false, // Whether to use hardware acceleration
        className: 'spinner', // The CSS class to assign to the spinner
        zIndex: 2e9, // The z-index (defaults to 2000000000)
        top: '50%', // Top position relative to parent
        left: '50%' // Left position relative to parent
    };
    var spinnerTarget = document.getElementById('spinnerTarget');