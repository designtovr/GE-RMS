app.controller('DailyReportController', ['$scope', '$http', 'Notification' , '$location' , '$window' , '$interval', function($scope, $http ,  Notification , $location , $window, $interval)
{
    $scope.dashboardvalues = {};
    $scope.modal = {};
    $scope.overdueModal = {};
    $scope.GetDashboardValues = function()
    {
        $http({
            'url': '/ge/daily-report-data',
            'method': 'GET',
        }).then(function(response){
            if (response.data.status == 'success')
            {
                $scope.dashboardvalues = response.data.data;
            }
        }, function(response){

        });
    }
    $scope.dateVariable = new Date();

    var warrantydata  = {
        labels: ["PX40", "C264" , "Agile" ,"Conventional" ],
        datasets: [
            {
                label: "Time Exceeded Relays",
                data: [92, 59 ,90, 59],
                stack: 'Stack 0',
                borderColor: "rgba(0,0,0,0.09)",
                borderWidth: "0",
                backgroundColor: "rgba(255,0,0,0.4)",
                fontFamily: "Poppins"
            },
            {
                label: "Total",
                data: [28, 48,90, 59],
                stack: 'Stack 0',
                borderColor: "rgba(0, 123, 255, 0.9)",

                borderWidth: "0",
                backgroundColor: "rgba(0, 123, 255, 0.5)",
                fontFamily: "Poppins"
            }


        ]
    }


    $scope.GoToReceipt = function() {
        $window.location.href = "/ge/receipt";
    };

    $interval(function(){
        $scope.GetDashboardValues();
    }, 60000);

    $scope.OnHoverShowStage = function(relay)
    {
        $('#smallmodal').modal('show');
        $scope.modal.stage = relay.current_stage;
        $scope.modal.serial_no = relay.serial_no;
        $scope.modal.formatted_pv_id = relay.formatted_pv_id;
        console.log($scope.modal)
    }

    $scope.OnHoverLeaveStage = function()
    {
        $('#smallmodal').modal('hide');
        $scope.modal.stage = "";
    }

    $scope.ShowTotalOverdue = function(stage, list)
    {
        console.log(stage)
        console.log(list);
        var obj = {
            due_list: list,
        };
        $scope.ShowOverDueList(stage, obj);
    }

    $scope.ShowOverDueList = function(stage, obj)
    {
        $scope.overdueModal = {};
        $scope.overdueModal.title = stage;
        $scope.overdueModal.serial_no_list = obj.due_list;
        console.log(stage)
        console.log(obj);
        $('#mediumModal').modal('show');
    }



}]);