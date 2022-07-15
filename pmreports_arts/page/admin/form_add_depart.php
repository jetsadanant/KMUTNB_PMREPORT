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
    <title>เพิ่มข้อมูลตำแหน่งงาน - pmreports</title>
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
                        <h3 class="card-title">เพิ่มข้อมูลตำแหน่งงาน</h3>
                    </div>
                    <form action="back_add_depart.php" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">ชื่อตำแหน่งงาน</label>
                                <input type="input" name="department" class="form-control" id="depart" placeholder="กรอกชื่อตำแหน่งงาน" required>
                            </div>
                            <div class="form-group ">

                                <label class="col-sm-2 col-form-label">สิทธิ์การเข้าถึง</label>
                                <div class="col">
                                    <select class="select2 form-control" name="level" style="width: 100%;" required>
                                        <!-- <option value="admin">admin</option> -->
                                        <option value="boss">boss</option>
                                        <option value="staff">staff</option>
                                        <option value="employee">employee</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>ส่งข้อมูลรายงาน</label>
                                        <select class="form-control select2" name="flow_report[]" multiple="multiple" data-placeholder="" style="width: 100%;">
                                            <!-- <option value="ไม่มี">ไม่มี</option> -->
                                            <?php foreach ($result as $row) {
                                                if ($row['department_name'] != "admin") { ?>
                                                    <option value="<?php echo $row["department_name"] ?>"><?php echo $row["department_name"] ?></option>

                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>ดูข้อมูลรายงาน </label>
                                        <select class="form-control select2" name="flow_estimate[]" id="all" data-select="false" multiple="multiple" style="width: 100%;">
                                            <!-- <option value="ไม่มี">ไม่มี</option> -->
                                            <?php foreach ($result as $row) {
                                                if ($row['department_name'] != "admin") { ?>
                                                    <option value="<?php echo $row["department_name"] ?>"><?php echo $row["department_name"] ?></option>

                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
                        </div>

                    </form>
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