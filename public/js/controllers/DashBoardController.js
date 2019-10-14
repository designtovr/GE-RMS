app.controller('DashBoardController', ['$scope', '$http', 'Notification' , function($scope, $http , Notification)
{



    try {
        //bar chart
        var ctx = document.getElementById("TodayStatus");
        if (ctx) {
            ctx.height = 200;
            var myChart = new Chart(ctx, {
                type: 'bar',
                defaultFontFamily: 'Poppins',
                data: {
                    labels: ["Numerical", "Conventional"],
                    datasets: [
                        {
                            label: "Completed",
                            data: [100, 59],
                            borderColor: "rgba(0, 123, 255, 0.9)",
                            borderWidth: "0",
                            backgroundColor: "rgba(0, 123, 255, 0.5)",
                            fontFamily: "Poppins"
                        },
                        {
                            label: "Pending",
                            data: [28, 48],
                            borderColor: "rgba(0,0,0,0.09)",
                            borderWidth: "0",
                            backgroundColor: "rgba(255,0,0,0.4)",
                            fontFamily: "Poppins"
                        }
                    ]
                },
                options: {


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
            var myChart = new Chart(ctx, {
                type: 'bar',
                defaultFontFamily: 'Poppins',
                data: {
                    labels: ["Numerical", "Conventional"],
                    datasets: [
                        {
                            label: "Completed",
                            data: [100, 59],
                            borderColor: "rgba(0, 123, 255, 0.9)",
                            borderWidth: "0",
                            backgroundColor: "rgba(0, 123, 255, 0.5)",
                            fontFamily: "Poppins"
                        },
                        {
                            label: "Pending",
                            data: [28, 48],
                            borderColor: "rgba(0,0,0,0.09)",
                            borderWidth: "0",
                            backgroundColor: "rgba(255,0,0,0.4)",
                            fontFamily: "Poppins"
                        }
                    ]
                },
                options: {


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
            ctx.height = 150;
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [75, 25],
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
                }
            });
        }


    } catch (error) {
        console.log(error);
    }

    try {

        //doughut chart
        var ctx = document.getElementById("doughChart1");
        if (ctx) {
            ctx.height = 150;
            var myChart = new Chart(ctx, {
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
                }
            });
        }


    } catch (error) {
        console.log(error);
    }



}]);