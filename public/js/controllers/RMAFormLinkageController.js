app.controller('RMAFormLinkageController', ['$scope', '$http', function($scope, $http){

    $scope.linkagemodal = {};
    $scope.linkagemodal.title = "Link";
    $scope.rmagridOptions = {
        data: [
            {
                'ref_no': '001',
                'gs_no': 'GS001',
                'date': '28/09/1994',
                'customer_name': 'ADFEW',
                'serial_no': 'SER001',
                'model_no': 'PART001',
            },
            {
                'ref_no': '001',
                'gs_no': 'GS002',
                'date': '27/09/1994',
                'customer_name': 'ADFEW',
                'serial_no': 'SER002',
                'model_no': 'PART001',
            },
            {
                'ref_no': '001',
                'gs_no': 'GS003',
                'date': '26/09/1994',
                'customer_name': 'ADFEW',
                'serial_no': 'SER003',
                'model_no': 'PART001',
            }
        ], //required parameter - array with data
        //optional parameter - start sort options
        sort: {
            predicate: 'companyName',
            direction: 'asc'
        }
    };
    $scope.pvgridOptions = {
        data: [
            {
                'receipt_no': '001',
                'rid': '1002',
                'customer_name': 'ADFEW',
                'serial_no': 'SER001',
                'model_no': 'PART01',
            },
            {
                'receipt_no': '002',
                'rid': '1003',
                'customer_name': 'ADFEW',
                'serial_no': 'SER002',
                'model_no': 'PART02',
            },
            {
                'receipt_no': '001',
                'rid': '1004',
                'customer_name': 'ADFEW',
                'serial_no': 'SER003',
                'model_no': 'PART03',
            }
        ], //required parameter - array with data
        //optional parameter - start sort options
        sort: {
            predicate: 'companyName',
            direction: 'asc'
        }
    };
    $scope.OpenLinkageModal = function()
    {
        $('#linkagemodal').modal('show');
    }
    $scope.CloseLinkageModal = function()
    {
        $('#linkagemodal').modal('hide');
    }
}]);