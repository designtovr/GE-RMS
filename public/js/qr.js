require('qr-scanner.min.js');
require('qr-scanner.worker.min.js');

var qr = angular.module('QrScanner',[]);

qr.service('qrservice', function($scope){
    $scope.tutorialName = "Angular JS";
});


module.exports = 'QrScanner';
