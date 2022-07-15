<?php session_start(); ?>
<?php include("../service/check_login_page.php"); ?>
<?php
require_once("../service/condb.php");
$department_id = $_GET['department_id'];
$sqli = "SELECT * FROM department
WHERE department_id = $department_id";
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
    <title>แก้ไขข้อมูลตำแหน่งงาน - pmreports</title>
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
                        <h3 class="card-title">แก้ไขข้อมูลตำแหน่งงาน</h3>
                    </div>
                    <?php
                    foreach ($resulti as $valuei) {
                    ?>
                        <form action="back_update_depart.php" method="post">
                            <input type="hidden" name="department_id" value="<?php echo $department_id ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ชื่อตำแหน่งงาน</label>
                                    <input value="<?php echo $valuei['department_name'] ?>" name="department_name" type="input" class="form-control" id="depart" placeholder="กรอกชื่อตำแหน่งงาน" required>
                                </div>
                                <div class="form-group ">
                                    <label class="col-sm-2 col-form-label">สิทธิ์การเข้าถึง</label>
                                    <select class="select2 form-control" name="level" style="width: 100%;" required>
                                        <option value="<?php echo $valuei['level'] ?>"><?php echo $valuei['level'] ?></option>
                                        <option value="boss">boss</option>
                                        <option value="staff">staff</option>
                                        <option value="employee">employee</option>
                                    </select>
                                </div>
                               
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>ส่งข้อมูลรายงาน</label>
                                            <select class="form-control select2" name="flow_report[]" multiple="multiple" data-placeholder="" style="width: 100%;" required>
                                            <!-- <option value="ไม่มี">ไม่มี</option> -->

                                                <?php
                                                $new_text = explode(',', $valuei['flow_report']);
                                                $x = 0;
                                                // echo "<pre>";
                                                // print_r($result);
                                                // echo "</pre>";
                                                // echo "<pre>";
                                                // print_r($new_text);
                                                // echo "</pre>";
                                                foreach ($result as $row) {
                                                    foreach ($new_text as $value2) {
                                                        $i = 0;
                                                        if ($value2 == $row['department_name']) {
                                                ?>
                                                            <option value='<?php echo $row['department_name'] ?>' selected><?php echo $row['department_name'] ?></option>
                                                        <?php
                                                            $x = 1;
                                                        }
                                                        ?>
                                                    <?php
                                                    }
                                                    if ($x != 1) {
                                                    ?>
                                                        <option value='<?php echo $row['department_name'] ?>'><?php echo $row['department_name'] ?></option>
                                                <?php
                                                    }
                                                    $x = 0;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>ดูข้อมูลรายงาน </label>
                                            <select class="form-control select2" name="flow_estimate[]" id="all" data-select="false" multiple="multiple" style="width: 100%;" required>
                                            <!-- <option value="ไม่มี">ไม่มี</option> -->
                                                <?php
                                                $new_text = explode(',', $valuei['flow_estimate']);
                                                $x = 0;
                                                // echo "<pre>";
                                                // print_r($result);
                                                // echo "</pre>";
                                                // echo "<pre>";
                                                // print_r($new_text);
                                                // echo "</pre>";
                                                foreach ($result as $row) {
                                                    foreach ($new_text as $value2) {
                                                        $i = 0;
                                                        if ($value2 == $row['department_name']) {
                                                ?>
                                                            <option value='<?php echo $row['department_name'] ?>' selected><?php echo $row['department_name'] ?></option>
                                                        <?php
                                                            $x = 1;
                                                        }
                                                        ?>
                                                    <?php
                                                    }
                                                    if ($x != 1) {
                                                    ?>
                                                        <option value='<?php echo $row['department_name'] ?>'><?php echo $row['department_name'] ?></option>
                                                <?php
                                                    }
                                                    $x = 0;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
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