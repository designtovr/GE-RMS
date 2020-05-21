app.controller('DashBoardController', ['$scope', '$http', 'Notification' , '$location' , '$window' , '$interval', function($scope, $http ,  Notification , $location , $window, $interval)
{
    $scope.dashboardvalues = {};
    $scope.modal = {};
    $scope.overdueModal = {};
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

    var data  = {
        labels: ["Today - Numerical", "Today - Conventional","Monthly - Numerical", "Monthly - Conventional"],
        datasets: [
            {
                label: "Completed",
                data: [
       0,0,0,0,
                ],
                borderColor: "rgba(0, 123, 255, 0.9)",
                borderWidth: "0",
                backgroundColor: "rgba(0, 123, 255, 0.5)",
                fontFamily: "Poppins"
            },
            {
                label: "Pending",
                data: [
      0,0,0,0,
                ],
                borderColor: "rgba(0,0,0,0.09)",
                borderWidth: "0",
                backgroundColor: "rgba(255,0,0,0.4)",
                fontFamily: "Poppins"
            }

        ]
    }


    var outofwarrantydata  = {
        labels: ["PX40", "C264" , "Agile" ,"Conventional"],
        datasets: [
            {
                label: "Time Exceeded Relays",
                data: [60, 30 ,80, 29],
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
                borderColor: "rgba(0,0,0,0.09)",
                borderWidth: "0",
                backgroundColor: "rgba(0, 123, 255, 0.5)",
                fontFamily: "Poppins"
            }


        ]
    }

    var ctx = document.getElementById("Warranty");
    if (ctx) {
        ctx.height = 200;
        var Warranty = new Chart(ctx, {
            type: 'horizontalBar',
            data: warrantydata,
            options: {
                scales: {
                    xAxes: [{
                        stacked: true,
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    yAxes: [{
                        stacked: true,
                        gridLines: {
                            display: true
                        },
                        ticks: {
                            /*                  max: Math.max(...data.datasets[0].data) + 40,
                                              display: false,*/
                            beginAtZero: true
                        }
                    }]
                },

                "hover": {
                    "animationDuration": 0
                },



                "animation": {
                    "duration": 1,
                    "onComplete": function () {
                        var chartInstance = this.chart,
                            ctx = chartInstance.ctx;

                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';
                        ctx.color = 'black';
                        this.data.datasets.forEach(function (dataset, i) {
                            var meta = chartInstance.controller.getDatasetMeta(i);
                            meta.data.forEach(function (bar, index) {
                                var data = dataset.data[index];
                                if(i ==1)
                                {
                                    data += warrantydata.datasets[0].data[index];
                                }
                                /*     if(index % 2 != 0)
                                     {
                                         console.log(data);
                                         data += dataset.data[index -1];
                                     }*/
                                ctx.fillText(data, bar._model.x - 15, bar._model.y + 7);
                            });
                        });
                    }
                }
            },
            legend: {
                display: false,
                position : 'bottom'
            },

            tooltips: {
                "enabled": false
            }
        });

    }

    try {

        //bar chart
        var ctx = document.getElementById("TodayStatus");
        if (ctx) {
            ctx.height = 200;

            var TodayChart = new Chart(ctx, {
                type: 'bar',
                defaultFontFamily: 'Poppins',
                data: data,
                options: {
                    "hover": {
                        "animationDuration": 0
                    },
                    "animation": {
                        "duration": 1,
                        "onComplete": function () {
                            var chartInstance = this.chart,
                                ctx = chartInstance.ctx;

                            ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'bottom';

                            this.data.datasets.forEach(function (dataset, i) {
                                var meta = chartInstance.controller.getDatasetMeta(i);
                                meta.data.forEach(function (bar, index) {
                                    var data = dataset.data[index];
                                    ctx.fillText(data, bar._model.x + 10, bar._model.y + 5);
                                });
                            });
                        }
                    }
                },
                legend: {
                    display: false,
                    position : 'bottom'
                },

                tooltips: {
                    "enabled": false
                },
                scales: {
                    yAxes: [{
                        display: true,
                        gridLines: {
                            display: true
                        },
                        ticks: {
                            max: Math.max(...data.datasets[0].data) + 10,
                            display: false,
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }

            });

        }


    } catch (error) {
        console.log(error);
    }

    try {

        //Warranty chart
        var ctx = document.getElementById("OutOfWarranty");
        if (ctx) {
            ctx.height = 200;
            var OutOfWarranty = new Chart(ctx, {
                type: 'horizontalBar',
                data: outofwarrantydata,
                options: {
                    scales: {
                        xAxes: [{
                            stacked: true,
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                        yAxes: [{
                            stacked: true,
                            gridLines: {
                                display: true
                            },
                            ticks: {
                                /*                  max: Math.max(...data.datasets[0].data) + 40,
                                                  display: false,*/
                                beginAtZero: true
                            }
                        }]
                    },

                    "hover": {
                        "animationDuration": 0
                    },



                    "animation": {
                        "duration": 1,
                        "onComplete": function () {
                            var chartInstance = this.chart,
                                ctx = chartInstance.ctx;

                            ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'bottom';

                            this.data.datasets.forEach(function (dataset, i) {
                                var meta = chartInstance.controller.getDatasetMeta(i);
                                meta.data.forEach(function (bar, index) {
                                    var data = dataset.data[index];
                                    if(i ==1)
                                    {
                                        data += warrantydata.datasets[0].data[index];
                                    }
                                    /*     if(index % 2 != 0)
                                         {
                                             console.log(data);
                                             data += dataset.data[index -1];
                                         }*/
                                    ctx.fillText(data, bar._model.x - 15, bar._model.y + 7);
                                });
                            });
                        }
                    }
                },
                legend: {
                    display: false,
                    position : 'bottom'
                },

                tooltips: {
                    "enabled": false
                }
            });
        }
    }
    catch (error)
    {
        console.log(error);
    }

    try {

        //doughut chart
        var ctx = document.getElementById("doughChart1");
        if (ctx) {
            ctx.height = 200;
            var dc1 = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [85, 25],
                        backgroundColor: [
                            "rgba(0, 123, 255,0.9)",
                            "rgba(0,0,0,0.07)"
                        ],
                        hoverBackgroundColor: [
                            "rgba(0, 123, 255,0.9)",
                            "rgba(0,0,0,0)"
                        ]

                    }],
                    labels: [
                        "Numerical"

                    ]
                },
                options: {
                    legend: {
                        position: 'top',
                        labels: {
                            fontFamily: 'Poppins'
                        }

                    },
                    responsive: true
                } ,

            });
        }


    } catch (error) {
        console.log(error);
    }


    try {
        //Monthly chart
        var ctx = document.getElementById("MonthlyStatus");
        if (ctx) {
            ctx.height = 200;
            var monthlyChart = new Chart(ctx, {
                type: 'horizontalBar',
                defaultFontFamily: 'Poppins',
                data: {
                    labels: ["Numerical", "Conventional"],
                    datasets: [
                        {
                            label: "Completed",
                            data: [90, 59],
                            borderColor: "rgba(0, 123, 255, 0.9)",
                            borderWidth: "0",
                            backgroundColor: "rgba(34,139,34, 0.5)",
                            fontFamily: "Poppins"
                        },
                        {
                            label: "Pending",
                            data: [28, 48],
                            borderColor: "rgba(0,0,0,0.09)",
                            borderWidth: "0",
                            backgroundColor: "rgba(34,139,34,0.4)",
                            fontFamily: "Poppins"
                        }
                    ]
                },
                options: {
                    "hover": {
                        "animationDuration": 0
                    },



                    "animation": {
                        "duration": 1,
                        "onComplete": function () {
                            var chartInstance = this.chart,
                                ctx = chartInstance.ctx;

                            ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'bottom';

                            this.data.datasets.forEach(function (dataset, i) {
                                var meta = chartInstance.controller.getDatasetMeta(i);
                                meta.data.forEach(function (bar, index) {
                                    var data = dataset.data[index];
                                    ctx.fillText(data, bar._model.x +10, bar._model.y + 5);
                                });
                            });
                        }
                    }
                },
                legend: {
                    display: false,
                    position : 'bottom'
                },

                tooltips: {
                    "enabled": false
                },
                scales: {
                    yAxes: [{
                        display: true,
                        gridLines: {
                            display: true
                        },
                        ticks: {
                            max: Math.max(...data.datasets[0].data) + 10,
                            display: false,
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }

            });
        }


    } catch (error) {
        console.log(error);
    }

    try {

        //doughut chart
        var ctx = document.getElementById("doughChart");
        if (ctx) {
            ctx.height = 200;
            var dh = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [75, 25],
                        backgroundColor: [
                            "rgba(217,55,68,0.9)",
                            "rgba(0,0,0,0.07)"
                        ],
                        hoverBackgroundColor: [
                            "rgba(0, 123, 255,0.9)",
                            "rgba(0,0,0,0)"
                        ]

                    }],
                    labels: [
                        "Numerical"

                    ]
                },
                options: {
                    legend: {
                        position: 'top',
                        labels: {
                            fontFamily: 'Poppins'
                        }

                    },
                    responsive: true
                }
            });
        }


    } catch (error) {
        console.log(error);
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

    $scope.GetDashboardValues = function()
    {
        $http({
            'url': '/ge/getdashboardvalues',
            'method': 'GET',
        }).then(function(response){
            if (response.data.status == 'success')
            {
                $scope.dashboardvalues = response.data.data;




                try {
                        console.log(warrantydata);
                        console.log("warrantydata");

                        //outofwarranty
                        //TodayChart
                        TodayChart.data.datasets[0].data =     [
                        $scope.dashboardvalues.today_status.numerical.completed,
                        $scope.dashboardvalues.today_status.conventional.completed,
                        $scope.dashboardvalues.monthly_status.numerical.completed,
                        $scope.dashboardvalues.monthly_status.conventional.completed,
                    ];

                    TodayChart.data.datasets[1].data =      [
                        $scope.dashboardvalues.today_status.numerical.pending,
                        $scope.dashboardvalues.today_status.conventional.pending,
                        $scope.dashboardvalues.monthly_status.numerical.pending,
                        $scope.dashboardvalues.monthly_status.conventional.pending,
                    ]

                    TodayChart.update();
                        //Monthly Chart
                        //WWarrantyarranty chart
                            Warranty.data.datasets[0].data = [
                                $scope.dashboardvalues.repair_warranty.px40.time_exceeded,
                                $scope.dashboardvalues.repair_warranty.c264.time_exceeded ,
                                $scope.dashboardvalues.repair_warranty.agile.time_exceeded ,
                                $scope.dashboardvalues.repair_warranty.conventional.time_exceeded]

                    Warranty.data.datasets[1].data = [
                        $scope.dashboardvalues.repair_warranty.px40.total - $scope.dashboardvalues.repair_warranty.px40.time_exceeded  ,
                        $scope.dashboardvalues.repair_warranty.c264.total - $scope.dashboardvalues.repair_warranty.c264.time_exceeded  ,

                        $scope.dashboardvalues.repair_warranty.agile.total -  $scope.dashboardvalues.repair_warranty.agile.time_exceeded ,
                        $scope.dashboardvalues.repair_warranty.conventional.total - $scope.dashboardvalues.repair_warranty.conventional.time_exceeded ]


                        Warranty.update();

                    OutOfWarranty.data.datasets[0].data = [
                        $scope.dashboardvalues.repair_chargable.px40.time_exceeded,
                        $scope.dashboardvalues.repair_chargable.c264.time_exceeded ,
                        $scope.dashboardvalues.repair_chargable.agile.time_exceeded ,
                        $scope.dashboardvalues.repair_chargable.conventional.time_exceeded]

                    OutOfWarranty.data.datasets[1].data = [
                        $scope.dashboardvalues.repair_chargable.px40.total - $scope.dashboardvalues.repair_chargable.px40.time_exceeded  ,
                        $scope.dashboardvalues.repair_chargable.c264.total - $scope.dashboardvalues.repair_chargable.c264.time_exceeded  ,

                        $scope.dashboardvalues.repair_chargable.agile.total -  $scope.dashboardvalues.repair_chargable.agile.time_exceeded ,
                        $scope.dashboardvalues.repair_chargable.conventional.total - $scope.dashboardvalues.repair_chargable.conventional.time_exceeded ]




                    OutOfWarranty

                }
                catch (error)
                {
                    console.log(error);
                }


            }
        }, function(response){

        });
    }

}]);