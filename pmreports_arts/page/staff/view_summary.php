<?php session_start();
include("../service/check_login_page.php");
require_once("../service/condb.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>สรุปผลการรายงาน - pmreports</title>
    <!-- Section Meta tag -->
    <?php include('../include/meta.php') ?>
    <?php include("../include/head.php"); ?>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> -->
    <style>
        .contain {
            padding: 20px;
        }

        .card-title {
            font-size: 20px;
        }

        .card-footer {
            text-align: center;
        }

        .head_es {
            text-align: center;
            font-size: 20px;
        }

        /* .table td,
        .table {
            padding: 10px;
            border: 1px solid #CDC9C9;
        } */

        .head1 td {
            background: #17a2b8;
            color: white;
            border: none;

        }

        .card-header {
            background: #004385;
        }

        h3 {
            color: white;
        }

        label {
            color: #495057;
        }

        /* .a1,
        .a2 {
            margin-right: 20px;
            margin-left: 20px;
            display: flex;
            justify-content: center;
            text-align: center;
        } */
        /* .contain{
            display: inline-flex;
            justify-content: center;
        } */

        @media (max-width: 576px) {
            .chart {
                width: 450px;
                height: 300px;
            }

            .text {
                text-align: left;
            }

            .btn {
                margin-top: 10px;
            }
        }



        @media (max-width: 820px) {

            .chart {
                width: 550px;
                height: 300px;
            }

            .text {
                text-align: left;
            }

            .btn {
                margin-top: 10px;
            }

        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include("nav.php"); ?>
        <?php include("../include/sidebar_staff.php"); ?>
        <div class="content-wrapper" style="min-height: 608px;">
            <div class="contain ">
                <div class=" card">
                    <div class="card-header ">
                        <div>
                            <h3 class="card-title">สรุปผลการรายงาน</h3>
                        </div>
                    </div>
                    <!-- Start card-body -->
                    <div class="card-body">
                        <div class="form-group">
                            <div class="col">
                                <?php
                                $member_id = $_SESSION['member_id'];
                                $mysql = "SELECT DATE_FORMAT(send_report.date, '%c') as month , COUNT(MONTH(send_report.date)) as count 
                                FROM send_report
                                inner join report
                                on send_report.report_id = report.report_id
                                WHERE";
                                $mysql2 = "SELECT DATE_FORMAT(send_report.date, '%c') as month , COUNT(MONTH(send_report.date)) as count 
                                FROM send_report
                                inner join report
                                on send_report.report_id = report.report_id
                                WHERE";
                                $mysql3 = "SELECT DATE_FORMAT(send_report.date, '%c') as month , COUNT(MONTH(send_report.date)) as count 
                                FROM send_report
                                inner join report
                                on send_report.report_id = report.report_id
                                WHERE";
                                $job = ['งานประจำ', 'งานที่ตอบตัวชี้วัดคำรับรองการปฏิบัติงานของคณะ'];
                                if (!empty($_POST['year']) || !empty($_POST['job_type'])) { //หากมีการเลือกปี ให้แสดงยอดขายของเดือนที่อยู่ในปีนั้นๆ
                                    $getYear = $_POST['year'];
                                    $getJob = $_POST['job_type'];
                                    $mysql .= " send_report.member_send_id = " . $member_id . " AND report.job_type='" . $getJob . "' AND YEAR(send_report.date)='" . $getYear . "'";
                                    $mysql2 .= " send_report.member_send_id = " . $member_id . " AND report.job_type='" . $getJob . "' AND report.success='100' AND YEAR(send_report.date)='" . $getYear . "'";
                                    $mysql3 .= " send_report.member_send_id = " . $member_id . " AND report.job_type='" . $getJob . "' AND report.success='0' AND YEAR(send_report.date)='" . $getYear . "'";
                                    // ShipperID = 3 change success = 100 | YEAR (date)
                                    // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

                                } else { //หากไม่เลือกอะไร ให้แสดงยอดขายในปีปัจจุบัน
                                    $getYear = date('Y');
                                    $getJob = $job[0];
                                    $mysql .= " send_report.member_send_id = " . $member_id . " AND report.job_type='" . $job[0] . "' AND YEAR(send_report.date)='" . $getYear . "'";
                                    $mysql2 .= " send_report.member_send_id = " . $member_id . " AND report.job_type='" . $job[0] . "' AND report.success='100' AND YEAR(send_report.date)='" . $getYear . "'";
                                    $mysql3 .= " send_report.member_send_id = " . $member_id . " AND report.job_type='" . $job[0] . "' AND report.success='0' AND YEAR(send_report.date)='" . $getYear . "'";
                                }
                                $mysql .= " GROUP BY YEAR(send_report.date), MONTH(send_report.date) 
                                ORDER BY DATE_FORMAT(send_report.date,'%m') ASC";
                                $mysql2 .= " GROUP BY YEAR(send_report.date), MONTH(send_report.date) 
                                ORDER BY DATE_FORMAT(send_report.date,'%m') ASC";
                                $mysql3 .= " GROUP BY YEAR(send_report.date), MONTH(send_report.date) 
                                ORDER BY DATE_FORMAT(send_report.date,'%m') ASC";
                                ?>
                                <div align="center">
                                    <form method="post" action="view_summary.php">
                                    <form method="post" action="graph.php">
                                        <input type="hidden" name="member_id" value="<?php echo $member_id ?>">
                                        <div class="contain">
                                            <div class="text form-group row">
                                            <label class=" col-sm-2 "> เลือกประเภทงาน </label>
                                                <div class="col-sm-3" style="">
                                                    <select class=" select2 form-control" name="job_type" id="job_type">
                                                        <?php
                                                        foreach ($job as $job_value) {
                                                            //<?= $getJob == $job[0] ? 'selected' : '' 
                                                        ?>
                                                            ?>
                                                            <option value="<?= $job_value ?>" <?= $getJob == $job_value ? 'selected' : '' ?>><?php echo $job_value ?></option>
                                                        <?php  } ?>
                                                    </select>
                                                </div>


                                                <label class="  col-sm-2 "> เลือกปี </label>
                                                <div class="col-sm-3" style="">
                                                    <select class=" select2 form-control" name="year" id="year">
                                                        <?php for ($year = 2022; $year <= date('Y'); $year++) { ?>
                                                            <option value="<?= $year ?>" <?= $getYear == $year ? 'selected' : '' ?>><?php echo ($year + 543) ?></option>
                                                        <?php  } ?>
                                                    </select>
                                                </div>

                                                <?php //echo date('Y');
                                                //echo date('Y') + 543; 
                                                ?>

                                                <div class="col-sm-2" style="">
                                                    <input type="submit" class=" btn btn-success  " name="btsearch" id="btsearch" value="ค้นหารายงาน" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <br>
                                    <!-- Chart -->
                                    <div class="card-body">
                                        <div class="chart">
                                            <canvas id="canvas" style=" max-height: 550px;  "></canvas>
                                        </div>
                                    </div>
                                    <?php
                                    $query = mysqli_query($condb, $mysql);
                                    $totals = [];
                                    $fail = [];
                                    $progress = [];
                                    $successs = [];
                                    while ($show = mysqli_fetch_assoc($query)) {
                                        $totals[$show['month'] - 1] = $show['count'];
                                    }
                                    $query2 = mysqli_query($condb, $mysql2);
                                    while ($show2 = mysqli_fetch_assoc($query2)) {
                                        $successs[$show2['month'] - 1] = $show2['count'];
                                    }
                                    $query3 = mysqli_query($condb, $mysql3);
                                    while ($show3 = mysqli_fetch_assoc($query3)) {
                                        $fail[$show3['month'] - 1] = $show3['count'];
                                    }
                                    $months = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];
                                    //! 100%
                                    for ($i = 0; $i < COUNT($months); $i++) {
                                        // echo $i;
                                        if (!isset($successs[$i])) {
                                            // echo '0<br>';
                                            $successs[$i] = 0;
                                        } else {
                                            // echo '1<br>';
                                        }
                                    }
                                    ksort($successs);
                                    // echo "<pre>";
                                    // print_r($successs);
                                    // echo "</pre>";

                                    //! 0%
                                    for ($i = 0; $i < COUNT($months); $i++) {
                                        // echo $i;
                                        if (!isset($fail[$i])) {
                                            // echo '0<br>';
                                            $fail[$i] = 0;
                                        } else {
                                            // echo '1<br>';
                                        }
                                    }
                                    ksort($fail);
                                    // echo "<pre>";
                                    // print_r($fail);
                                    // echo "</pre>";
                                    //! total
                                    for ($i = 0; $i < COUNT($months); $i++) {
                                        // echo $i;
                                        if (!isset($totals[$i])) {
                                            // echo '0<br>';
                                            $totals[$i] = 0;
                                        } else {
                                            // echo '1<br>';
                                        }
                                    }
                                    ksort($totals);
                                    // echo "<pre>";
                                    // print_r($totals);
                                    // echo "</pre>";
                                    // echo "<br>";

                                    //! 1-99%
                                    for ($i = 0; $i < COUNT($months); $i++) {
                                        $totals[$i] = $totals[$i] - $fail[$i];
                                    }
                                    for ($i = 0; $i < COUNT($months); $i++) {
                                        $progress[$i] = $totals[$i] - $successs[$i];
                                    }
                                    // echo "<pre>";
                                    // print_r($fails);
                                    // echo "</pre>";
                                    ?>
                                    <br>
                                    <div class="contain">
                                        <div class="card">
                                            <div class="card-body">
                                                <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <td width="20%" align="center">เดือน</td>
                                                            <td>
                                                                <div style="text-align:center;font-weight:normal;white-space:normal;border-radius:5px;padding:5px; background:rgb(9, 154, 131);color:white;">ดำเนินการสำเร็จ</div>
                                                            </td>
                                                            <td>
                                                                <div style="text-align:center;font-weight:normal;white-space:normal;border-radius:5px;padding:5px; background:rgb(255, 187, 0) ;">กำลังดำเนินการ</div>
                                                            </td>
                                                            <td>
                                                                <div style="text-align:center;font-weight:normal;white-space:normal;border-radius:5px;padding:5px;background:rgb(255, 70, 62);color:white;">ยังไม่ได้ดำเนินการ</div>
                                                            </td>
                                                            <td>
                                                                <div style="text-align:center;font-weight:normal;white-space:normal;border-radius:5px;padding:5px;background:rgb(9, 154, 188);color:white;">จำนวนที่รายงาน</div>
                                                                <!-- #4497D2 -->
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    $total_report = 0;
                                                    $total_report_suc = 0;
                                                    $total_report_progress = 0;
                                                    $total_report_fail = 0;
                                                    $month = array(0 => 'มกราคม', 1 => 'กุมภาพันธ์', 2 => 'มีนาคม', 3 => 'เมษายน', 4 => 'พฤษภาคม', 5 => 'มิถุนายน', 6 => 'กรกฎาคม', 7 => 'สิงหาคม', 8 => 'กันยายน', 9 => 'ตุลาคม', 10 => 'พฤศจิกายน', 11 => 'ธันวาคม');
                                                    foreach ($month as $key_m => $val_m) {
                                                        $total_report += $totals[$key_m];
                                                        $total_report_suc += $successs[$key_m];
                                                        $total_report_progress += $progress[$key_m];
                                                        $total_report_fail += $fail[$key_m];
                                                    ?>
                                                        <tbody>
                                                            <tr>
                                                                <td align="center"><?php echo $val_m ?></td>
                                                                <td align="center"><?php echo $successs[$key_m] ?></td>
                                                                <td align="center"><?php echo $progress[$key_m] ?></td>
                                                                <td align="center"><?php echo $fail[$key_m] ?></td>
                                                                <td align="center"><?php echo $totals[$key_m] ?></td>
                                                            </tr>
                                                        </tbody>
                                                    <?php  } ?>
                                                    <tfoot>
                                                        <tr>
                                                            <td align="center">รายงานรวมทั้งหมด : </td>
                                                            <td>
                                                                <div style="text-align:center;font-weight:normal;white-space:normal;border-radius:5px;padding:5px; "><?php echo $total_report_suc ?></div>
                                                            </td>
                                                            <td>
                                                                <div style="text-align:center;font-weight:normal;white-space:normal;border-radius:5px;padding:5px;"><?php echo $total_report_progress ?></div>
                                                            </td>
                                                            <td>
                                                                <div style="text-align:center;font-weight:normal;white-space:normal;border-radius:5px;padding:5px;"><?php echo $total_report_fail ?></div>
                                                            </td>
                                                            <td>
                                                                <div style="text-align:center;font-weight:normal;white-space:normal;border-radius:5px;padding:5px;"><?php echo $total_report ?></div>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <!-- End col -->
                        </div>
                    </div>
                    <!-- End card-body -->
                </div>
            </div>
        </div>
    </div>
    <!-- bs-custom-file-input -->
    <script src="../../assets/bootstrap/template/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- dom -->
    <script>
        const month = <?php echo json_encode($months); ?>;
        const total = <?php echo json_encode($totals); ?>;
        const progress = <?php echo json_encode($progress); ?>;
        const fail = <?php echo json_encode($fail); ?>;
        const success = <?php echo json_encode($successs); ?>;
        var barChartData = {
            labels: month,
            datasets: [{
                    label: "ดำเนินการสำเร็จ",
                    yAxisID: 'bar-stack',
                    backgroundColor: "rgb(9, 154, 131)",
                    borderWidth: 1,
                    stack: 'bef',
                    data: success
                },
                {
                    label: "กำลังดำเนินการ",
                    yAxisID: 'bar-stack',
                    backgroundColor: "rgb(255, 187, 0)",
                    borderWidth: 1,
                    stack: 'bef',
                    data: progress
                },
                {
                    label: "ยังไม่ได้ดำเนินการ",
                    yAxisID: 'bar-stack',
                    backgroundColor: "rgb(255, 70, 62)",
                    borderWidth: 1,
                    stack: 'bef',
                    data: fail
                },
                {
                    label: "จำนวนที่รายงาน",
                    yAxisID: 'bar-stack',
                    backgroundColor: "rgb(9, 154, 188)",
                    borderWidth: 1,
                    stack: 'now1',
                    data: total
                }
            ]
        };

        var chartOptions = {
            responsive: true,
            scales: {
                yAxes: [{
                    id: "bar-stack",
                    position: "left",
                    stacked: true,
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'จำนวนรายงาน'
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false,
                    },
                }]
            }
        }
        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: "bar",
                data: barChartData,
                options: chartOptions
            });
        };
    </script>
    <?php include("../include/footer.php"); ?>
    <?php include("../include/notification.php"); ?>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": false,
                "paging": false,
                "ordering": false,
                "info": false,
                "searching": false,
                "autoWidth": false

            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "responsive": true,
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
    <script>
        $(function() {
            $('.select2').select2()
        });
    </script>
</body>