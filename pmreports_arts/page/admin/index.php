<?php session_start(); ?>
<?php include("../service/check_login_page.php"); ?>
<?php
require_once("../service/condb.php");
$count = 1;
$result = "SELECT * FROM member 
           inner join department
           on department.department_id = member.department_id";
$query = mysqli_query($condb, $result);
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
$count = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ข้อมูลสมาชิก - pmreports</title>
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

        a,
        a:hover {
            color: white;
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
    <script>
        function deletes(str) {
            event.preventDefault(); // prevent form submit
            var form = event.target.form; // storing the form
            Swal.fire({
                title: 'ยืนยันการลบ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes !'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "back_del_member.php?member_id=" + str + "";
                }
            })
        }
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include("nav.php"); ?>
        <?php include("../include/sidebar_admin.php"); ?>
        <div class="content-wrapper" style="min-height: 608px;">
            <div class="contain">
                <div class="card">
                    <div class="card-header ">
                        <div>
                            <h3 class="card-title">ข้อมูลสมาชิก</h3>
                        </div>
                        <div style="text-align: right;">
                            <a href="form_add_member1.php"><button type="button" class="btn b_add text-right "><span class="fas fa-plus-circle"></span> เพิ่มสมาชิก</button></a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>ชื่อ - นามสกุล</th>
                                    <th>Username</th>
                                    <!-- <th>เบอร์โทรศัพท์</th> -->
                                    <th>ตำแหน่งงาน</th>
                                    <th>ระดับตำแหน่ง</th>
                                    <!-- <th>รีเซตรหัสผ่าน</th> -->
                                    <th>แก้ไข</th>
                                    <th>ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($rows as $value) {
                                    $color = '';
                                    if ($value['level'] == 'boss') {
                                        $color = 'danger';
                                    } elseif ($value['level'] == 'staff') {
                                        $color = 'warning';
                                    } elseif ($value['level'] == 'employee') {
                                        $color = 'success';
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $count++ ?></td>
                                        <td><?php echo $value['name'] ?></td>
                                        <td><?php echo $value['username'] ?></td>
                                        <td style="width:25%;">
                                            <div style="font-weight:normal;white-space:normal;border-radius: 5px;" class="bg-<?php echo $color ?>"><?php echo $value['department_name'] ?></div>
                                        </td>
                                        <td>
                                            <div style="border-radius: 5px;" class=" bg-<?php echo $color ?>"><?php echo $value['level'] ?></div>
                                        </td>
                                       
                                        <td> <a href="edit_member1.php?member_id=<?php echo $value['member_id'] ?>" class="btn btn-info"><i class="far fa-edit"></i></a></td>

                                        <td><a onclick="deletes(<?php echo $value['member_id'] ?>)" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>ชื่อ - นามสกุล</th>
                                    <th>Username</th>
                                    <th>ตำแหน่งงาน</th>
                                    <th>ระดับตำแหน่ง</th>
                                    <th>แก้ไข</th>
                                    <th>ลบ</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include("../include/footer.php"); ?>
    
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