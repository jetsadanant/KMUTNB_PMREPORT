<?php session_start(); ?>
<?php include("../service/check_login_page.php"); ?>
<?php require_once("../service/condb.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>รายงานผลการปฎิบัติงาน - pmreports</title>
    <!-- Section Meta tag -->
    <?php include('../include/meta.php') ?>
    <?php include("../include/head.php"); ?>
    <style>
        .contain {
            padding: 25px;
        }

        .card-title {
            font-size: 20px;
        }

        a {
            color: white;
            text-decoration: none;
        }

        table {
            text-align: center;
        }

        .card-header {
            background: #004385;
            color: white;
        }

        .b_add {
            background: #05B2DC;
            color: white;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: 0.35s;
            z-index: 1;
            border-radius: 50px;
            box-shadow: 0 17px 26px -9px rgba();
            transition: all 0.3s ease;
        }

        .b_add:hover {
            background: #04DB97;
            color: white;
            background-color: rgba(0.2, 0.7);
            box-shadow: 0 13px 26px -9px rgba(0.2, 0.7);
            transform: translateY(3px);
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
                            <h3 class="card-title">รายงานผลการปฎิบัติงาน</h3>
                        </div>
                        <div style="text-align: right;">
                            <a class="t_add" href="form_report.php" style="color: white;"><button class="btn b_add text-right "><span class="fas fa-plus-circle"></span> เพิ่มรายงาน</button></a>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>วันที่ส่ง</th>
                                    <th>หัวข้อ</th>
                                    <th>ประเภทงาน</th>
                                    <th>ความสำเร็จ</th>
                                    <th>อัปเดต</th>
                                    <th>ดูรายงาน</th>
                                    <!-- <th>ลบ</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = "SELECT * FROM send_report 
                                inner JOIN report
                                on send_report.report_id = report.report_id
                                WHERE member_send_id = " . $_SESSION["member_id"] . "
                                ORDER BY send_report_id DESC";
                                $query = mysqli_query($condb, $result);

                                $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                $count = 1;
                                foreach ($rows as $value) {
                                    $color_suc = '';
                                    if ($value['success'] == '0') {
                                        $color_suc = 'danger';
                                    } elseif ($value['success'] < '100') {
                                        $color_suc = 'warning';
                                    } elseif ($value['success'] == '100') {
                                        $color_suc = 'success';
                                    }
                                ?>
                                    <tr>
                                        <td style="width:5%"><?php echo $count++ ?></td>
                                        <?php

                                        $date = explode(" ", $value['date']);
                                        $dates = DateThai($date[0]);

                                        ?>
                                        <td><?php echo $dates ?><br><?php echo $date[1] ?></td>

                                        <td><?php echo $value['header'] ?></td>
                                        <td style="width:20%"><?php echo $value['job_type'] ?></td>
                                        <td style="width:10%">
                                            <div style="font-weight: normal;white-space:normal;border-radius: 5px;padding:5px;" class="bg-<?php echo $color_suc ?>"><?php echo $value['success']; ?>%</div>
                                        </td>

                                        <td style="width:10%"><a href="update_success.php?report_id=<?php echo $value['report_id'] ?>&send_report_id=<?php echo $value['send_report_id'] ?>" ><button  class="btn btn-warning" ><i class="far fa-edit"></i></button></a></td>

                                        <td align="center" style="width:10%"><a href="view_report.php?report_id=<?php echo $value['report_id'] ?>&department_receive=<?php echo $value['department_receive'] ?>"><button style="background-color:#3C85B8 ;" class="btn"><i style="color:white;"  class="fas fa-eye"></i></button></a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>วันที่ส่ง</th>
                                    <th>หัวข้อ</th>
                                    <th>ประเภทงาน</th>
                                    <th>ความสำเร็จ</th>
                                    <th>อัปเดต</th>
                                    <th>ดูรายงาน</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    <?php include("../include/footer.php"); ?>
    <?php include("../include/notification.php"); ?>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "paging": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
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
</body>