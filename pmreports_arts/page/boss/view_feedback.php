<?php session_start(); ?>
<?php include("../service/check_login_page.php"); ?>
<?php require_once("../service/condb.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ข้อมูลการปฎิบัติงาน - pmreports</title>
    <!-- Section Meta tag -->
    <?php include('../include/meta.php') ?>
    <?php include("../include/head.php"); ?>
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="../../assets/bootstrap/template/plugins/chart.js/Chart.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap/template/plugins/ekko-lightbox/ekko-lightbox.css">
    
    <style>
        .contain {
            padding: 25px;

        }

        .card-title {
            font-size: 20px;
        }

        .card-footer {
            text-align: center;
        }

        label {
            display: block;
            padding: 15px;

        }

        .timeline-footer {
            text-align: center;
        }

        .btn11 {
            padding: 15px;
        }

        @media (max-width: 576px) {
            .chart{
                width:450px;
                height: 300px;
            }
            /* canvas {
                height:250px;
                width: 450px;
            } */

            .detail {
                display: block;
                width: 100;
            }

            /* input[type=text]{

            } */
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include("nav.php"); ?>
        <?php include("../include/sidebar_boss.php"); ?>
        <?php include('../include/function_date.php'); ?>
        <div class="content-wrapper" style="min-height: 608px;">
            <div class="contain">
                <div class="content">
                    <div class="card">
                        <div class="card-header " style="background:#004385 ;color:white;">
                            <div>
                                <h3 class="card-title">ข้อมูลการปฎิบัติงาน</h3>
                            </div>
                        </div>
                        <?php
                        $send_report_id = $_GET['send_report_id'];
                        $result = "SELECT * FROM send_report 
                                inner JOIN report
                                on send_report.report_id = report.report_id
                                inner JOIN member
                                on member.member_id = send_report.member_send_id
                                inner join department
                                on department.department_id = member.department_id
                                WHERE send_report_id = $send_report_id";
                        $query = mysqli_query($condb, $result);
                        $rows = mysqli_fetch_array($query, MYSQLI_ASSOC);
                        $report_id = $rows['report_id'];
                        $report_id_feedback = $rows['report_id'];
                        $member_send_name = $rows['name'];
                        $member_send_id = $rows['member_id'];
                        ?>
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
                                            <!-- timeline time label -->
                                            <div class="time-label">
                                                <span class="bg-info" style="font-weight: normal;"><?php echo $member_send_name ?></span>

                                            </div>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            <div class="detail" style="height: auto;">
                                                <!-- <i class="fas fa-user bg-green"></i> -->
                                                <div class="timeline-item">
                                                    <h1 class="timeline-header"> <label>หัวข้อ : <?php echo $values['header']; ?></label> </h1>
                                                    <div class="timeline-body">
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">รายละเอียดงาน : </label>
                                                            <div class="col-10">
                                                                <textarea style="background-color: white; border:0;resize: none;width: 100%;font-weight: bold;" class="form-control" name="detail" id="exampleFormControlTextarea1" disabled><?php echo $values['detail'] ?></textarea>
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
                                                                <textarea style="background-color: white; border:0;resize: none;width: 100%;font-weight: bold;" class="form-control" name="detail" id="exampleFormControlTextarea2" disabled><?php echo $values['problem']; ?></textarea>
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
                            <!-- /.timeline -->
                        <?php }
                        //} 
                        ?>

                        <div class="timeline-footer" data-toggle="modal" data-target="#exampleModalCenter">
                            <form action="send_feedback.php" method="get">
                                <input type="hidden" name="send_report_id" value="<?php echo $send_report_id ?>">
                                <input type="hidden" name="report_id" value="<?php echo $report_id_feedback ?>">
                                <input type="hidden" name="member_send_name" value="<?php echo $member_send_name ?>">
                                <input type="hidden" name="member_send_id" value="<?php echo $member_send_id ?>">

                                <a><button style="padding: 10px; text-alight:center;" type="submit" class="btn btn-danger"><i class="fas fa-paper-plane"></i> ส่งข้อเสนอแนะ</button></a>
                            </form>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            window.onload = function() {
                var myPDF = new PDFObject({
                    url: "pdf/<?php echo $file ?>",
                    id: "myPDF",
                    width: "650px",
                    height: "700px",
                    pdfOpenParams: {
                        navpanes: 1,
                        statusbar: 0,
                        view: "FitH",
                        pagemode: "thumbs"
                    }
                }).embed('pdfplace');
            };
        </script>
        <script>
            autosize(document.getElementById("exampleFormControlTextarea1"));
            autosize(document.getElementById("exampleFormControlTextarea2"));

            $(function() {
                $('.select2').select2()
            });
        </script>
        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": true,
                    "searching": false,
                    "paging": false,
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
            $(function() {
                $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                    event.preventDefault();
                    $(this).ekkoLightbox({
                        alwaysShowClose: true
                    });
                });

                $('.filter-container').filterizr({
                    gutterPixels: 3
                });
                $('.btn[data-filter]').on('click', function() {
                    $('.btn[data-filter]').removeClass('active');
                    $(this).addClass('active');
                });
            })
        </script>

        <!-- Chart JS -->
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
                    responsive: true,

                    plugins: {
                        legend: false,
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            min: 0,
                            max: 100
                        }
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
        <!-- Ekko Lightbox -->
        <script src="../../assets/bootstrap/template/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
        <!-- Filterizr-->
        <script src="../../assets/bootstrap/template/plugins/filterizr/jquery.filterizr.min.js"></script>
        <?php include("../include/footer.php"); ?>
        <?php include("../include/notification.php"); ?>
</body>