app.controller('DashBoardController', ['$scope', '$http', 'Notification' , '$location' , '$window' , '$interval', function($scope, $http ,  Notification , $location , $window, $interval)
{
    $scope.dashboardvalues = {};
    var warrantydata  = {
        labels: ["PX40", "C264" , "Agile" ,"Conventional" ],
        datasets: [
            {
                label: "Time Exceeded Relays",
                data: [90, 59 ,90, 59],
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

    var ctx = document.getElementById("Warranty");
    if (ctx) {
        ctx.height = 200;
        var stackedBar = new Chart(ctx, {
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

    $scope.GoToReceipt = function() {
        $window.location.href = url('/receipt');
        $location.url('/receipt');
        console.log("colled");
    };

    $interval(function(){
        $scope.GetDashboardValues();
    }, 10000);

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
                    var data  = {
                            labels: ["Today - Numerical", "Today - Conventional","Monthly - Numerical", "Monthly - Conventional"],
                            datasets: [
                                {
                                    label: "Completed",
                                    data: [
                                        $scope.dashboardvalues.today_status.numerical.completed, 
                                        $scope.dashboardvalues.today_status.conventional.completed,
                                        $scope.dashboardvalues.monthly_status.numerical.completed, 
                                        $scope.dashboardvalues.monthly_status.conventional.completed,
                                    ],
                                    borderColor: "rgba(0, 123, 255, 0.9)",
                                    borderWidth: "0",
                                    backgroundColor: "rgba(0, 123, 255, 0.5)",
                                    fontFamily: "Poppins"
                                },
                                {
                                    label: "Pending",
                                    data: [
                                        $scope.dashboardvalues.today_status.numerical.pending, 
                                        $scope.dashboardvalues.today_status.conventional.pending,
                                        $scope.dashboardvalues.monthly_status.numerical.pending, 
                                        $scope.dashboardvalues.monthly_status.conventional.pending,
                                    ],
                                    borderColor: "rgba(0,0,0,0.09)",
                                    borderWidth: "0",
                                    backgroundColor: "rgba(255,0,0,0.4)",
                                    fontFamily: "Poppins"
                                }

                                ]
                        }
                    var warrantydata  = {
                        labels: ["PX40", "C264" , "Agile" ,"Conventional" ],
                        datasets: [
                            {
                                label: "Time Exceeded Relays",
                                data: [90, 59 ,90, 59],
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
                    //bar chart
                    var ctx = document.getElementById("TodayStatus");
                    if (ctx) {
                        ctx.height = 200;
                        var myChart = new Chart(ctx, {
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
                        myChart.destroy();
                        myChart = new Chart(ctx, {
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
                    //bar chart
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

                try {

                    //Warranty chart

                        stackedBar.update();

                }
                catch (error)
                {
                    console.log(error);
                }

                try {

                    //Warranty chart
                    var ctx = document.getElementById("OutOfWarranty");
                    if (ctx) {
                        ctx.height = 200;
                        var war = new Chart(ctx, {
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
            }
        }, function(response){

        });
    }

}]);