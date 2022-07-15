<?php session_start(); ?>
<?php include("../service/check_login_page.php"); ?>
<?php require_once("../service/condb.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ข้อมูลการปฎิบัติงานของพนักงาน - pmreports</title>
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
        }

        .card-header {
            background: #004385;
            color: white;
        }

        table {
            text-align: center;

        }

        /* table tr td , tr th{ 
          border:1px solid red;
      }
        thead,tfoot{
            background:#4FAEF1;
            color: #F2F3F4;
        } */
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include("nav.php"); ?>
        <?php include("../include/sidebar_boss.php"); ?>
        <?php include('../include/function_date.php'); ?>
        <div class="content-wrapper" style="min-height: 608px;">
            <div class="contain">
                <div class="card">
                    <div class="card-header ">
                        <div>
                            <h3 class="card-title">ข้อมูลการปฎิบัติงานของพนักงาน</h3>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>วันที่ส่ง</th>
                                    <th>ผู้รายงาน</th>
                                    <th>ตำแหน่งงาน</th>
                                    <th>หัวข้อ</th>
                                    <th>ความสำเร็จ</th>
                                    <th>ดูรายงาน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $department = $_SESSION["department_name"];
                                //? Select FROM send_report  , member , department
                                $result = "SELECT * FROM send_report 
                                            inner JOIN report
                                            on send_report.report_id = report.report_id
                                            inner JOIN member
                                            on member.member_id = send_report.member_send_id
                                            inner join department
                                            on department.department_id = member.department_id
                                            WHERE department_receive LIKE '%$department%'
                                            ORDER BY send_report_id DESC";
                                $query = mysqli_query($condb, $result);
                                $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

                                $count = 1;
                                foreach ($rows as $value) {
                                    $color = '';
                                    if ($value['level'] == 'boss') {
                                        $color = 'danger';
                                    } elseif ($value['level'] == 'staff') {
                                        $color = 'warning';
                                    } elseif ($value['level'] == 'employee') {
                                        $color = 'success';
                                    }
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
                                        <td><?php echo $value['name'] ?></td>
                                        <!-- style="white-space:normal;display:inline;" -->
                                        <td style="width:25%">
                                            <div style="font-weight: normal;white-space:normal;border-radius: 5px;padding:5px;" class="bg-<?php echo $color ?>"><?php echo $value['department_name'] ?></div>
                                        </td>

                                        <td style="width:25%"><?php echo $value['header']; ?></td>
                                        <!-- <td style="width:20%"><?php echo $value['job_type']; ?></td> -->
                                        <td style="width:10%">
                                            <div style="font-weight: normal;white-space:normal;border-radius: 5px;padding:5px;" class="bg-<?php echo $color_suc ?>"><?php echo $value['success']; ?>%</div>
                                        </td>

                                        <td style="width:10%" align="center"><a href="view_feedback.php?report_id=<?php echo $value['report_id'] ?>&member_send_name=<?php echo $value['name'] ?>&member_send_id=<?php echo $value['member_send_id'] ?>&send_report_id=<?php echo $value['send_report_id'] ?>"><button button style="background-color:#3C85B8 ;" class="btn"><i style="color:white;" class="fas fa-eye"></i></button></a></td>


                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>วันที่ส่ง</th>
                                    <th>ผู้รายงาน</th>
                                    <th>ตำแหน่งงาน</th>
                                    <th>หัวข้อ</th>
                                    <th>ความสำเร็จ</th>
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

    <?php
    if ($_SESSION['check_login'] == 1) {
        $_SESSION['check_login'] = 0;
        echo "<script>";
        echo "const Toast = Swal.mixin({
         toast: true,
         position: 'top-end',
         showConfirmButton: false,
         timer: 3000,
         timerProgressBar: true,
         didOpen: (toast) => {
             toast.addEventListener('mouseenter', Swal.stopTimer)
             toast.addEventListener('mouseleave', Swal.resumeTimer)
         }
         })
         Toast.fire({
         icon: 'success',
         title: 'เข้าสู่ระบบสำเร็จ'
         })";
        echo "</script>";
    }
    ?>
</body>