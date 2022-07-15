<?php session_start(); ?>
<?php include("../service/check_login_page.php"); ?>
<?php require_once("../service/condb.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ฟอร์มส่งข้อเสนอแนะ - pmreports</title>
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

        .card-body {
            color: #495057;
        }

        table {
            text-align: center;
        }
    </style>
    <script>
        function archiveFunction() {
            event.preventDefault(); // prevent form submit
            var form = event.target.form; // storing the form
            Swal.fire({
                title: 'ยืนยันการส่ง?',
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
        <?php include("../include/sidebar_boss.php"); ?>
        <div class="content-wrapper" style="min-height: 608px;">
            <div class="contain">
                <div class="card">
                    <div class="card-header ">
                        <div>
                            <h3 class="card-title">ฟอร์มส่งข้อเสนอแนะ</h3>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php
                        $send_report_id = $_GET['send_report_id'];
                        $report_id = $_GET['report_id'];
                        $member_send_name = $_GET['member_send_name'];
                        $member_send_id = $_GET['member_send_id'];
                        $report_id = explode(",", $report_id);
                        ?>
                        <label>ชื่อพนักงาน : <?php echo $member_send_name ?></label>
                        <form action="back_send_feedback.php" method="post">
                            <label for="">หัวข้อรายงาน</label>
                            <select class="select2 form-control" name="header_name" required>
                                <?php
                                require_once("../service/condb.php");
                                foreach ($report_id as $value) {
                                    $sql = "SELECT * FROM report WHERE report_id = $value";
                                    $result = mysqli_query($condb, $sql);
                                ?>
                                    <?php foreach ($result as $row) {
                                        if ($row['header']) { ?>
                                            <option value="<?php echo $row["header"] ?>"><?php echo $row["header"] ?></option>

                                <?php }
                                    }
                                } ?>
                            </select>
                            <br>
                            <div class="form_group">
                                <label for="">รายละเอียดข้อความ</label>
                                <textarea class="form-control" name="detail" id="" cols="30" rows="5" required></textarea>
                                <input type="hidden" name="member_send_id" value="<?php echo $member_send_id ?>">
                                <input type="hidden" name="send_report_id" value="<?php echo $send_report_id ?>">
                                <br>
                                <div class="" style="text-align: center;">
                                    <button style="padding: 10px; text-alight:center;" type="submit" class="btn btn-danger" onclick="archiveFunction()"><i class="fas fa-paper-plane"></i> ส่งข้อเสนอแนะ</button>
                                </div>
                            </div>
                        </form>
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
            $('.select2').select2()
        });
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
    <!-- Text Area -->
    <script>
        $('textarea').each(function() {
            this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
        }).on('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    </script>
</body>