<?php session_start(); ?>
<?php include("../service/check_login_page.php"); ?>
<?php
require_once("../service/condb.php");
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
    <title>เพิ่มสมาชิก - pmreports</title>
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
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include("nav.php"); ?>
        <?php include("../include/sidebar_admin.php"); ?>
        <div class="content-wrapper" style="min-height: 608px;">
            <div class="contain">
                <div class="card card-primary">
                    <div class="card-header" style="background: #004385;color: white;">
                        <h3 class="card-title">เพิ่มสมาชิก</h3>
                    </div>
                    <form action="back_addmember1.php" id="" method="post" onSubmit="return chkpsw(this)" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12" data-select2-id="56">
                                        <div class="form-group" data-select2-id="55">
                                            <label>ชื่อ-นามสกุล</label>
                                            <input type="text" name="name" class="form-control" required placeholder="กรอกชื่อ-นามสกุล" value="" minlength="2">
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6" data-select2-id="56">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">เบอร์โทรศัพท์</label>
                                            <input type="text" class="form-control" name="tel" id="m_tell" placeholder="กรอกเบอร์โทรศัพท์" required>
                                        </div>
                                    </div> -->

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12" data-select2-id="56">
                                    <label for="exampleInputEmail1">Username</label>
                                    <input type="text" class="form-control" name="username" id="m_email" placeholder="กรอก username" required>
                                    </div>
                                    <!-- <div class="col-md-6" data-select2-id="56">
                                    <label for="exampleInputEmail1">สถานะภาพ</label>
                                    <select id="" name="status" class="select2" style="width: 100%;" required>
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
                                    <?php foreach ($result as $row) {
                                        if ($row['department_name']) { ?>
                                            <option value="<?php echo $row["department_id"] ?>"><?php echo $row["department_name"] ?></option>

                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include("../include/footer.php"); ?>
    <script language="Javascript">
        function chkpsw(form) {
            password1 = form.pass1.value;
            password2 = form.pass2.value;

            // ถ้าช่่องรหัสผ่านไม่ถูกกรอก
            if (password1 == '')
                alert("กรุณากรอกรหัสยืนยันอีกครั้ง");

            // ถ้าช่่องยืนยันรหัสผ่านไม่ถูกกรอก
            else if (password2 == '')
                alert("กรุณากรอกรหัสยืนยันอีกครั้ง");

            //ถ้าทั้งสองช่องไม่ตรงกัน   ให้แจ้งผู้ใช้  และ  return false
            else if (password1 != password2) {
                alert("\n รหัสผ่านของคุณไม่ตรงกัน")
                return false;
            }

            //ถ้าทั้งสองช่องตรงกัน  return true
            else {

                alert("เพิ่มสมาชิกเรียบร้อย")
                return true;
            }
        }
    </script>

    <script>
        $(function() {
            $('.select2').select2()
        });
        $(function() {
            $('.select22').select2()
        });
    </script>
</body>