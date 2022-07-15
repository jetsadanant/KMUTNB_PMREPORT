<?php session_start(); ?>
<?php include("../service/check_login_page.php"); ?>
<?php
require_once("../service/condb.php");
$member_id = $_GET['member_id'];
$sqli = "SELECT * FROM member 
         INNER JOIN department
         ON department.department_id = member.department_id
         WHERE member.member_id = $member_id";
$resulti = mysqli_query($condb, $sqli);
$sql = "SELECT * FROM department ORDER BY department_id asc";
$result = mysqli_query($condb, $sql);
$count = 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>แก้ไขข้อมูลสมาชิก - pmreports</title>
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

        .card-footer {
            text-align: center;
        }


        .card-header {
            background: #004385;
            color: white;
        }
    </style>
    <script>
        function archiveFunction() {
            event.preventDefault(); // prevent form submit
            var form = event.target.form; // storing the form
            Swal.fire({
                title: 'ยืนยันการแก้ไข?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.isConfirmed) {
                form.submit();
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
                <div class="card card-primary">
                    <div class="card-header" style="background: #004385;color: white;">
                        <h3 class="card-title">แก้ไขข้อมูลสมาชิก</h3>
                    </div>
                    <?php
                    foreach ($resulti as $valuei) {
                    ?>
                        <form action="back_update_member1.php" id="" method="post" enctype="multipart/form-data" >
                            <input type="hidden" name="member_id" value="<?php echo $member_id ?>">

                            <div class="card-body">

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12" data-select2-id="56">
                                            <div class="form-group" data-select2-id="55">
                                                <label>ชื่อ-สกุล</label>
                                                <input type="text" name="name" class="form-control" required placeholder="กรอกชื่อ-สกุล" value="<?php echo $valuei["name"] ?>" minlength="2">
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6" data-select2-id="56">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">เบอร์โทรศัพท์</label>
                                                <input type="text" class="form-control" name="tel" id="m_tell" placeholder="กรอกเบอร์โทรศัพท์" value="<?php echo $valuei["tel"] ?>" required>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12" data-select2-id="56">
                                            <label for="exampleInputEmail1">Username</label>
                                            <input type="text" class="form-control" name="username" id="m_email" placeholder="กรอกอีเมล" value="<?php echo $valuei["username"] ?>" required>
                                        </div>
                                        <!-- <div class="col-md-6" data-select2-id="56">
                                            <label for="exampleInputEmail1">สถานะภาพ</label>
                                            <select id="" name="status" class="select2" style="width: 100%;" required>
                                                <option value="<?php echo $valuei["status"] ?>"><?php echo $valuei["status"] ?></option>
                                                <option value="พนักงานมหาวิทยาลัย">พนักงานมหาวิทยาลัย</option>
                                                <option value="พนักงานพิเศษ">พนักงานพิเศษ</option>
                                                <option value="ข้าราชการ">ข้าราชการ</option>
                                            </select>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>ตำแหน่งงาน</label>
                                    <select id="m_position" name="department_id" class="select2" style="width: 100%;" required>
                                        <option value="<?php echo $valuei["department_id"] ?>"><?php echo $valuei["department_name"] ?></option>
                                        <?php foreach ($result as $row) {
                                            if ($row['department_name']) { ?>
                                                <option value="<?php echo $row["department_id"] ?>"><?php echo $row["department_name"] ?></option>

                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary" onclick="archiveFunction()"><i class="fas fa-save"></i> อัปเดตข้อมูล</button>
                                </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php include("../include/footer.php"); ?>

    <script>
        $(function() {
            $('.select2').select2()
        });
    </script>
</body>