<?php session_start(); ?>
<?php include("../service/check_login_page.php"); ?>
<?php require_once("../service/condb.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ข้อเสนอแนะ - pmreports</title>
    <!-- Section Meta tag -->
    <?php include('../include/meta.php') ?>
    <?php include("../include/head.php"); ?>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://rawgit.com/jackmoore/autosize/master/dist/autosize.min.js"></script> -->
    <style>
        .contain {
            padding: 25px;
        }

        .card-title {
            font-size: 20px;
        }

        .font-size {
            font-size: 18px;
            color: black;
        }

        a {
            color: white;
        }

        .card-header {
            background: #004385;
            color: white;
        }

        table {
            text-align: center;
        }

        @media (max-width: 576px) {
            .chart {
                width: 450px;
                height: 300px;
            }


            .detail {}

            .text {
                margin-left: -45px;

            }

            .timeline {
                display: block;
                width: 350px;

            }

            /* .row {
                display: block;
            } */
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include("nav.php"); ?>
        <?php include("../include/sidebar_staff.php"); ?>
        <?php include('../include/function_date.php'); ?>
        <div class="content-wrapper" style="min-height: 608px;">
            <div class="contain">
                <div class="card">
                    <div class="card-header ">
                        <div>
                            <h3 class="card-title">ข้อเสนอแนะ</h3>
                        </div>
                    </div>
                    <?php
                    $sf_sent_report_id = $_GET['sf_sent_report_id'];
                    $result = "SELECT * FROM send_report 
                                inner JOIN report
                                on send_report.report_id = report.report_id
                                inner JOIN member
                                on member.member_id = send_report.member_send_id
                                inner join department
                                on department.department_id = member.department_id
                                WHERE send_report_id = $sf_sent_report_id";
                    $query = mysqli_query($condb, $result);
                    $rows = mysqli_fetch_array($query, MYSQLI_ASSOC);
                    $report_id = $rows['report_id'];
                    $feedback_id = $_GET['feedback_id'];
                    $member_send_name = $_GET['member_send_name'];
                    $member_send_id = $_GET['member_send_id'];

                    $result = "SELECT * FROM feedback WHERE feedback_id = $feedback_id";
                    $query = mysqli_query($condb, $result);
                    $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
                    foreach ($rows as $values) {
                    ?>
                        <div class="card-body">
                            <div class="callout callout-info">
                                <div class="post clearfix" style="color: #495057;">
                                    <label class="col-form-label">ชื่อผู้ส่ง : <?php echo $member_send_name ?></label><br>
                                    <?php
                                    $date = explode(" ", $values['date']);
                                    $dates = DateThai($date[0]);
                                    ?>
                                    <label class="col-form-label">วันที่ส่ง : <?php echo $dates; ?> <?php echo $date[1]; ?></label><br>

                                    <label class="col-form-label">ข้อเสนอแนะ : </label><textarea style="background-color: white; border:0;resize: none;width: 100%;font-weight: bold;" class="form-control" name="detail" id="exampleFormControlTextarea3" disabled><?php echo $values['detail']; ?></textarea>
                                </div>

                                <?php
                                $text = [];
                                $arr = [];
                                $result = "SELECT * FROM report WHERE report_id = $report_id";
                                $query = mysqli_query($condb, $result);
                                $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                foreach ($rows as $values) {
                                    if (!empty($values['his_success']) || $values['his_success'] >= '0') {
                                        $arr = explode(",", $values['his_success']);
                                    }
                                    array_push($arr, $values['success']);
                                    if (!empty($values['his_date'])) {
                                        $text = explode(",", $values['his_date']);
                                        $i = 0;
                                        foreach ($text as $value) {
                                            $text[$i] = DateThai($value);
                                            $i++;
                                        }
                                    }
                                    array_push($text, DateThai($values['working_range_end']));
                                ?>
                                    <div class="card-body">
                                        <!-- Timelime example  -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- The time line -->
                                                <div class="timeline">
                                                    <!-- timeline item -->
                                                    <div style="height: auto;">
                                                        <i class="fas fa-user bg-green"></i>

                                                        <div class="timeline-item">
                                                            <h1 class="timeline-header"> <label for="">หัวข้อ : <?php echo $values['header']; ?></label> </h1>
                                                            <div class="timeline-body">

                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">รายละเอียดงาน : </label>
                                                                    <div class="col-10">
                                                                        <textarea style="background-color: white; border:0;resize: none;width: 100%;height: 150px;font-weight: bold;" class="form-control" name="detail" id="exampleFormControlTextarea1" disabled><?php echo $values['detail']; ?></textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">สถานที่ปฎิบัติงาน :</label>
                                                                    <div class="col-sm-3">
                                                                        <label class="col-form-label"><?php echo $values['workplace']; ?></label>
                                                                    </div>
                                                                    <label class="col-sm-2 col-form-label">ประเภทงาน :</label>
                                                                    <div class="col-sm-5">
                                                                        <label class="col-form-label"><?php echo $values['job_type']; ?></label>
                                                                    </div>
                                                                </div>

                                                                <div class=".form-group row">
                                                                    <label class="col-sm-2 col-form-label">วันที่และเวลาทำงาน:</label>
                                                                    <div class="col-sm-4">
                                                                        <label class="col-form-label"><?php echo DateThai($values['working_range_start']); ?> <span>ถึง <?php echo DateThai($values['working_range_end']); ?></span></label>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-sm-2 col-form-label">ปัญหาที่พบ :</label>
                                                                    <div class="col-10">
                                                                        <textarea style="background-color: white; border:0;resize: none;width: 100%;height: 150px;font-weight: bold;" class="form-control" name="detail" id="exampleFormControlTextarea2" disabled><?php echo $values['problem']; ?></textarea>
                                                                    </div>
                                                                </div>

                                                                <!-- BAR CHART -->
                                                                <?php
                                                                if ($values['file'] != "") {
                                                                    $file = $values['file'];

                                                                    echo " <div id='pdfplace'>";
                                                                    echo " <center>";
                                                                    echo "<a href='../../assets/files/$file'><button class='btn btn-danger '>คลิกที่นี้เพื่อดาวน์โหลดไฟล์</button></a>";
                                                                    echo " </center>";
                                                                    echo "<br>";
                                                                }
                                                                ?>

                                                                <!-- Canvas ChartJS -->
                                                                <div class="card card-success">
                                                                    <div class="card-header">
                                                                        <h3 class="card-title">ความสำเร็จ</h3>

                                                                        <div class="card-tools">
                                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                                <i class="fas fa-minus"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                            <div class="card-body">
                                                                <div class="chart">
                                                                    <canvas id="myChart" style="position: relative; max-height: 300px;  "></canvas>
                                                                </div>
                                                            </div>
                                                                    <!-- /.card-body -->
                                                                </div>
                                                            </div>
                                                            <!-- /.timeline-body -->
                                                        </div>
                                                        <!-- END timeline item -->
                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <!-- /.timeline -->
                    <?php }
                                //} 
                    ?>
                </div>
            <?php } ?>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <script>
        autosize(document.getElementById("exampleFormControlTextarea1"));
        autosize(document.getElementById("exampleFormControlTextarea2"));
        autosize(document.getElementById("exampleFormControlTextarea3"));
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "paging": false,
                "ordering": true,
                "info": false,
                "buttons": ["copy", "excel", "print"]
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
        const label = <?php echo json_encode($text); ?>;
        const arr = <?php echo json_encode($arr); ?>;
        const data = {
            labels: label,
            datasets: [{
                data: arr,
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(255, 159, 64)',
                    'rgba(255, 205, 86)',
                    'rgba(75, 192, 192)',
                    'rgba(54, 162, 235)',
                    'rgba(153, 102, 255)',
                    'rgba(201, 203, 207)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        };
        const config = {
            type: 'bar',
            data: data,
            options: {
                plugins: {
                    legend: false,
                },
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
            },
        };
    </script>
    <script>
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
    <!-- ChartJS -->
    <script src="../../assets/bootstrap/template/plugins/chart.js/Chart.min.js"></script>
    <?php include("../include/footer.php"); ?>
    <?php include("../include/notification.php"); ?>
</body>