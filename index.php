<?php
/**
 * Created by IntelliJ IDEA.
 * User: Javier
 * Date: 15/09/2017
 * Time: 11:52
 */
//require('php_scripts/check_cookie.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/logo.png">

    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

    <?php require('navbar.php'); ?>

    <div class="container-fluid">
        <div class="main-header">
            <h1 class="display-2 d-inline bold">yoyo</h1> <h1 class="display-2 d-inline"> analytics</h1>
        </div>

        <br><br>

        <div class="header">
            <h2>OVERALL SALES BY OUTLET</h2>
        </div>
        <br>
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="sub-header">
                    <h4 class="d-inline">LAST WEEK &nbsp;</h4><?php $previous_week = date("d/m/Y", strtotime("last week monday")); ?> <p class="d-inline"><?=$previous_week?></p>
                    <div class="loading" id="loading0" style="display: none;">
                        <br><br><br><br>
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="color: black;"></i>
                    </div>
                    <h5 id="nodata0">No Data Available</h5>
                    <canvas class="chart" id="myChart0" width="200" height="200"></canvas>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="sub-header">
                    <h4 class="d-inline">2 WEEKS AGO &nbsp;</h4><?php $previous_week = date("d/m/Y", strtotime("-3 week monday"));?> <p class="d-inline"><?=$previous_week?></p>
                    <div class="loading" id="loading1" style="display: none;">
                        <br><br><br><br>
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="color: black;"></i>
                    </div>
                    <h5 id="nodata1">No Data Available</h5>
                    <canvas class="chart" id="myChart1" width="200" height="200"></canvas>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="sub-header">
                    <h4 class="d-inline">3 WEEKS AGO &nbsp;</h4><?php $previous_week = date("d/m/Y", strtotime("-4 week monday"));?> <p class="d-inline"><?=$previous_week?></p>
                    <div class="loading" id="loading2" style="display: none;">
                        <br><br><br><br>
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="color: black;"></i>
                    </div>
                    <h5 id="nodata2">No Data Available</h5>
                    <canvas class="chart" id="myChart2" width="200" height="200"></canvas>
                </div>
            </div>
        </div>

    </div>



    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>

    <script>

        var ctx_arr = [];
        var datevalue;

        for(var x = 0; x<3; x++)
        {
            var chart = "myChart"+x;

            ctx_arr[x] = document.getElementById(chart);


            if(x==0)
            {
                datevalue = "<?=date("Y-m-d", strtotime("-5 week monday"))?>";
            } else if(x==1)
            {
                datevalue = "<?=date("Y-m-d ", strtotime("-6 week monday"))?>";
            } else if(x==2)
            {
                datevalue = "<?=date("Y-m-d", strtotime("-7 week monday"))?>";
            }

            ajaxPieRequest(ctx_arr, x, datevalue);

        }

        function ajaxPieRequest(arr, x, datevalue) {
            var loading = "#loading"+x;
            $(loading).show();
            $(arr[x]).hide();

            $.ajax({
                type: "POST",
                url: 'ajax/dashboard_doughnut_chart.php',
                data: {date: datevalue},
                dataType: 'json',
                success: function (data) {

                    if(data[0].datasets.every(checkNull))
                    {
                        var nodata = "#nodata"+x;
                        $(nodata).show();
                        $(arr[x]).hide();

                    } else
                    {
                        $(arr[x]).show();
                        data = {
                            datasets: [{
                                data: data[0].datasets,
                                backgroundColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1,

                            }],

                            // These labels appear in the legend and in the tooltips when hovering different arcs
                            labels: data[0].labels

                        };

                        var customTooltips = function(tooltip) {
                            // Tooltip Element
                            var tooltipEl = $('#chartjs-tooltip');
                            // Hide if no tooltip
                            if (!tooltip) {
                                tooltipEl.css({
                                    opacity: 1
                                });
                                return;
                            }
                            // Display, position, and set styles for font
                            tooltipEl.css({
                                fontSize: tooltip.fontSize,
                            });
                        }

                        var myDoughnutChart = new Chart(arr[x], {
                            type: 'doughnut',
                            data: data,
                            options: {
                                legend: {
                                    display: false
                                },
                                tooltips: {
                                    custom: function(tooltipModel){
                                        // Tooltip Element
                                        var tooltipEl = document.getElementById('chartjs-tooltip');

                                        // Create element on first render
                                        if (!tooltipEl) {
                                            tooltipEl = document.createElement('div');
                                            tooltipEl.id = 'chartjs-tooltip';
                                            tooltipEl.innerHTML = "<table></table>"
                                            document.body.appendChild(tooltipEl);
                                        }

                                        tooltipEl.style.titleFontSize = tooltipModel.titleFontSize;
                                    },
                                    bodyFontSize: 20
                                }
                            }
                        });
                    }

                },
                complete: function(){
                    $(loading).hide();
                }
            });
        }

        function checkNull(data) {
            return data == null;
        }

    </script>
</body>
</html>


