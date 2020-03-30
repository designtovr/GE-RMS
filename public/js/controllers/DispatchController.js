app.controller('DispatchController', ['$scope', '$http','Notification','ChangePVStatusService', 'PVPriorityService', 'ExcelSave', function($scope, $http , Notification, ChangePVStatusService, PVPriorityService, ExcelSave){
    $scope.gridOptions = {
        pagination: {
            itemsPerPage: '10'
        },
        data:[]
        , //required parameter - array with data
        //optional parameter - start sort options
        sort: {

        },
        urlSync: true
    };

    $scope.status = 'dispatchapproved';
    $scope.selectedpvs = [];
    $scope.page = 1;
    $scope.pvprioritylist = [];
    $scope.pvprioritylistmax = 0;
    
    $scope.Start = function()
    {
        $http({
            method: 'GET',
            url: '/ge/physicalverification?cat='+$scope.status
        }).then(function success(response) {
            $scope.gridOptions.data =  response.data.physicalverification;
        }, function error(response) {

        });
        $scope.GetPVPriorityList();
    }

    $scope.GetPVPriorityList = function()
    {
        $scope.pvprioritylist = PVPriorityService.GetPVPriorityList(function(list, max)
        {
            $scope.pvprioritylist = list;
            $scope.pvprioritylistmax = max;
            console.log($scope.pvprioritylist);
        });
    }

    $scope.exportToExcelSave=function(tableId , filename){
        ExcelSave.tableToExcel(tableId,filename);

        $timeout(function(){

        },100); // trigger download
    }

    $scope.SetPVPriority = function(pv_id, priority)
    {
        PVPriorityService.SetPVPriority(pv_id, priority, function(response){
            if (response.data.status == 'success')
            {
                Notification.success(response.data.message);
                $scope.LoadData($scope.page);
                $scope.GetPV($scope.status);
                $scope.GetPVPriorityList();
            }
            else if (response.data.status == 'failure')
            {
                Notification.error(response.data.message);
            }
            else if (response.status == 422)
            {
                var errors = response.data.errors;
                for(var error in errors)
                {
                    Notification.error(errors[error][0]);
                    break;
                }
            }
        });
    }


    $scope.Reset = function()
    {
        $scope.filterrmaID = '';
        $scope.filterID = '';
        $scope.filterpart_no = '';
        $scope.filterserial_no = '';
        $scope.filterpvdate = '';
        $scope.filterCustomer = '';
        $scope.filterendCustomer = '';
        $scope.dateTo = '';
        $scope.dateFrom = '';
    }


        $scope.ChangeStatus = function(status)
            {
                console.log($scope.gridOptions.data);
                $scope.selectedpvs = [];
                for (var i = 0; i < $scope.gridOptions.data.length; i++) {
                    if ($scope.gridOptions.data[i].create_wc != undefined && $scope.gridOptions.data[i].create_wc)
                    {
                        $scope.selectedpvs.push($scope.gridOptions.data[i].id);
                    }
                }
                if ($scope.selectedpvs.length == 0)
                {
                    Notification.error("No Relay Selected");
                    return;
                }
                console.log($scope.selectedpvs);


                //$scope.ChangePVStatus($scope.selectedpvs ,status);
                $scope.DispatchCompleted($scope.selectedpvs ,status);
            }

            $scope.ChangePVStatus = function(pvids, status)
            {
                ChangePVStatusService.ChangePVStatus(pvids, status, function(response){
                    if (response.data.status == 'success')
                    {
                        Notification.success(response.data.message);
                        $scope.GetPV($scope.status);
                    }
                    else if (response.status == 422)
                    {
                        var errors = response.data.errors;
                        for(var error in errors)
                        {
                            Notification.error(errors[error][0]);
                            break;
                        }
                    }
                });
            }

            $scope.CompleteDispatch = function()
            {
                console.log($scope.gridOptions.data);
                $scope.selectedpvs = [];
                $scope.first_rma = '';
                for (var i = 0; i < $scope.gridOptions.data.length; i++) {
                    if ($scope.gridOptions.data[i].create_wc != undefined && $scope.gridOptions.data[i].create_wc)
                    {
                        $scope.selectedpvs.push($scope.gridOptions.data[i].id);
                        console.log($scope.gridOptions.data[i].rma_id);
                        if($scope.first_rma == '')
                            $scope.first_rma = $scope.gridOptions.data[i].rma_id;
                        else if($scope.first_rma != '')
                        {
                            if($scope.first_rma != $scope.gridOptions.data[i].rma_id)
                            {
                                Notification.error("Different RMA Selected");
                                return;
                            }
                        }
                    }
                }
                if ($scope.selectedpvs.length == 0)
                {
                    Notification.error("No Relay Selected");
                    return;
                }
                console.log($scope.selectedpvs);

                $http({
                method: 'post',
                url: '/ge/completedispatch',
                data: {
                    'selectedpvs': $scope.selectedpvs
                },
                }).then(function success(response){
                    if (response.data.status == 'success')
                    {
                        var content = response.data.message;
                        Notification.success(content);
                        $scope.Start();
                    }
                }, function failure(response){
                    if (response.status == 422)
                    {
                        var errors = response.data.errors;
                        for(var error in errors)
                        {
                            Notification.error(errors[error][0]);
                            break;
                        }
                    }
                });
            }


            $scope.startTab = false;
            $scope.openTab = false;

            $scope.LoadData = function(page)
            {
                console.log(page);
                $scope.openTab = false;
                $scope.startTab = false;
                if(page == '1')
                    $scope.openTab = true;
                
                if(page == '2')
                    $scope.startTab = true;

            }   


            $scope.GetPV = function(status)
            {
                $scope.status = status;
                $http({
                    method: 'GET',
                    url: '/ge/physicalverification?cat='+status
                }).then(function success(response) {
                    $scope.gridOptions.data =  response.data.physicalverification;
                }, function error(response) {
                });
            }

}]);