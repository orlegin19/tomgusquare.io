<div class="col-md-12">
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Sales Today
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="sales_today"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Unpaid Orders
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="total_unpaid"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-parking fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Orders Today</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="count_orders"></div>
                                </div>
                                <!-- <div class="col">
                <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                </div> -->
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <!--<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
        <div class="row no-gutters align-items-center">
            <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Online Orders</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800" id="online_orders"></div>
            </div>
            <div class="col-auto">
             <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
        </div>
        </div>
    </div>
    </div>
    </div>

    Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-10 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Daily Sales Summary</h6>
                        <!-- <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <div class="dropdown-header">Dropdown Header:</div>
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div> -->
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="des_chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-2 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
                        <!-- <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <div class="dropdown-header">Dropdown Header:</div>
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div> -->
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="order_chart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Dine-in
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> Take-out
                            </span>
                            <!--<span class="mr-2">
            <i class="fas fa-circle text-info"></i> Delivery
            </span>
            <span class="mr-2">
            <i class="fas fa-circle" style="color:#f86601 "></i> Pick-up
            </span>
        </div>
        </div>
    </div>
    </div>
    </div>
</div>-->

                            <script>
                            $(document).ready(function() {
                                load_data()
                                des_chart()
                                order_cart()
                            })

                            window.load_data = function() {
                                $.ajax({
                                    url: '<?php echo base_url('admin/load_dash_data') ?>',
                                    method: 'POST',
                                    data: {},
                                    error: err => {
                                        console.log(err)
                                        Dtoast('An error occured.')

                                    },
                                    success: resp => {
                                        if (typeof resp != undefined && typeof resp != null) {
                                            resp = JSON.parse(resp)
                                            $('#sales_today').html('&#8369; ' + parseFloat(resp
                                                .total_sales).toLocaleString('en-US', {
                                                style: 'decimal',
                                                maximumFractionDigits: 2
                                            }))
                                            $('#total_unpaid').html('&#8369; ' + parseFloat(resp
                                                .total_unpaid).toLocaleString('en-US', {
                                                style: 'decimal',
                                                maximumFractionDigits: 2
                                            }))
                                            $('#count_orders').html(resp.total_orders)
                                            $('#online_orders').html(resp.total_online_orders)
                                        }
                                    }
                                })
                            }
                            window.des_chart = function() {
                                // Set new default font family and font color to mimic Bootstrap's default styling
                                Chart.defaults.global.defaultFontFamily = 'Nunito',
                                    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                                Chart.defaults.global.defaultFontColor = '#858796';

                                function number_format(number, decimals, dec_point, thousands_sep) {
                                    // *     example: number_format(1234.56, 2, ',', ' ');
                                    // *     return: '1 234,56'
                                    number = (number + '').replace(',', '').replace(' ', '');
                                    var n = !isFinite(+number) ? 0 : +number,
                                        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                                        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                                        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                                        s = '',
                                        toFixedFix = function(n, prec) {
                                            var k = Math.pow(10, prec);
                                            return '' + Math.round(n * k) / k;
                                        };
                                    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                                    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                                    if (s[0].length > 3) {
                                        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                                    }
                                    if ((s[1] || '').length < prec) {
                                        s[1] = s[1] || '';
                                        s[1] += new Array(prec - s[1].length + 1).join('0');
                                    }
                                    return s.join(dec);
                                }
                                var data = [];
                                $.ajax({
                                    url: '<?php echo base_url('admin/des_chart_data') ?>',
                                    error: err => {
                                        console.log(err)
                                        DToast('Daily Sales Summary chart error.', 'error')
                                    },
                                    success: resp => {
                                        if (typeof resp != undefined && typeof resp != null) {
                                            resp = JSON.parse(resp)
                                            data = resp

                                            var label_dates = []
                                            var label_amount = []
                                            Object.keys(data.dates).map(k => {
                                                label_dates.push(data.dates[k])
                                            })
                                            Object.keys(data.amount).map(k => {
                                                label_amount.push(data.amount[k])
                                            })


                                            var ctx = document.getElementById("des_chart");
                                            var myLineChart = new Chart(ctx, {
                                                type: 'bar',
                                                data: {
                                                    labels: label_dates,
                                                    datasets: [{
                                                        label: "Sales",
                                                        lineTension: 0.3,
                                                        backgroundColor: "#f8660170",
                                                        borderColor: "#f86601",
                                                        pointRadius: 3,
                                                        pointBackgroundColor: "#f86601",
                                                        pointBorderColor: "#f86601",
                                                        pointHoverRadius: 3,
                                                        pointHoverBackgroundColor: "#f86601",
                                                        pointHoverBorderColor: "#f86601",
                                                        pointHitRadius: 10,
                                                        pointBorderWidth: 2,
                                                        data: label_amount,
                                                    }],
                                                },
                                                options: {
                                                    maintainAspectRatio: false,
                                                    layout: {
                                                        padding: {
                                                            left: 10,
                                                            right: 25,
                                                            top: 25,
                                                            bottom: 0
                                                        }
                                                    },
                                                    scales: {
                                                        xAxes: [{
                                                            time: {
                                                                unit: 'date'
                                                            },
                                                            gridLines: {
                                                                display: false,
                                                                drawBorder: false
                                                            },
                                                            ticks: {
                                                                maxTicksLimit: 7
                                                            }
                                                        }],
                                                        yAxes: [{
                                                            ticks: {
                                                                maxTicksLimit: 5,
                                                                padding: 10,
                                                                // Include a dollar sign in the ticks
                                                                callback: function(
                                                                    value, index,
                                                                    values) {
                                                                    return '₱ ' +
                                                                        number_format(
                                                                            value);
                                                                }
                                                            },
                                                            gridLines: {
                                                                color: "#f86601",
                                                                zeroLineColor: "rgb(234, 236, 244)",
                                                                drawBorder: false,
                                                                borderDash: [2],
                                                                zeroLineBorderDash: [2]
                                                            }
                                                        }],
                                                    },
                                                    legend: {
                                                        display: false
                                                    },
                                                    tooltips: {
                                                        backgroundColor: "rgb(255,255,255)",
                                                        bodyFontColor: "#858796",
                                                        titleMarginBottom: 10,
                                                        titleFontColor: '#6e707e',
                                                        titleFontSize: 14,
                                                        borderColor: '#dddfeb',
                                                        borderWidth: 1,
                                                        xPadding: 15,
                                                        yPadding: 15,
                                                        displayColors: false,
                                                        intersect: false,
                                                        mode: 'index',
                                                        caretPadding: 10,
                                                        callbacks: {
                                                            label: function(tooltipItem,
                                                            chart) {
                                                                var datasetLabel = chart
                                                                    .datasets[tooltipItem
                                                                        .datasetIndex]
                                                                    .label || '';
                                                                return datasetLabel +
                                                                    ': ₱ ' + number_format(
                                                                        tooltipItem.yLabel);
                                                            }
                                                        }
                                                    }
                                                }
                                            });
                                        }
                                    }
                                })


                            }
                            window.order_cart = function() {
                                $.ajax({
                                    url: '<?php echo base_url('admin/order_chart') ?>',
                                    error: err => console.log(err),
                                    success: resp => {
                                        if (typeof resp != undefined && typeof resp != null) {
                                            resp = JSON.parse(resp)

                                            // Set new default font family and font color to mimic Bootstrap's default styling
                                            Chart.defaults.global.defaultFontFamily = 'Nunito',
                                                '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                                            Chart.defaults.global.defaultFontColor = '#858796';

                                            // Pie Chart Example
                                            var ctx = document.getElementById("order_chart");
                                            var myPieChart = new Chart(ctx, {
                                                type: 'doughnut',
                                                data: {
                                                    labels: [resp.label[1], resp.label[2], resp
                                                        .label[3], resp.label[4]
                                                    ],
                                                    datasets: [{
                                                        data: [resp.count[1], resp
                                                            .count[2], resp.count[
                                                            3], resp.count[4]
                                                        ],
                                                        backgroundColor: ['#4e73df',
                                                            '#1cc88a', '#36b9cc',
                                                            '#da7631'
                                                        ],
                                                        hoverBackgroundColor: [
                                                            '#2e59d9', '#17a673',
                                                            '#2c9faf', '#da7631'
                                                        ],
                                                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                                                    }],
                                                },
                                                options: {
                                                    maintainAspectRatio: false,
                                                    tooltips: {
                                                        backgroundColor: "rgb(255,255,255)",
                                                        bodyFontColor: "#858796",
                                                        borderColor: '#dddfeb',
                                                        borderWidth: 1,
                                                        xPadding: 15,
                                                        yPadding: 15,
                                                        displayColors: false,
                                                        caretPadding: 10,
                                                    },
                                                    legend: {
                                                        display: false
                                                    },
                                                    cutoutPercentage: 80,
                                                },
                                            });

                                        }
                                    }
                                })
                            }
                            </script>