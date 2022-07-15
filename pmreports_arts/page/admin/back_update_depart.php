<!DOCTYPE html>
<html lang="en">
<head>
    <!-- SweetAlert2 -->
    <script src="../../assets/bootstrap/template/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="../../assets/bootstrap/template/plugins/sweetalert2/sweetalert2.min.css">
</head>
<body>
    <?php
    require_once("../service/condb.php");  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // exit();
    $department_id = $_POST['department_id'];
    $department_name = $_POST['department_name']; //รับค่าไฟล์จากฟอร์ม	
    $level = $_POST['level']; //รับค่าไฟล์จากฟอร์ม	
    $flow_report = $_POST['flow_report'];
    $flow_estimate = $_POST['flow_estimate'];
    if (!isset($flow_report)) {
        $flow_report = '';
    } else {
        $flow_report = implode(",", $flow_report);
    }
    if (!isset($flow_estimate)) {
        $flow_estimate = '';
    } else {
        $flow_estimate = implode(",", $flow_estimate);
    }

    $sql = "UPDATE department SET
    department_name ='$department_name',
    level = '$level',
    flow_report = '$flow_report',
    flow_estimate = '$flow_estimate'
    WHERE department_id = $department_id
    ";

    $check = "select * from department  where department_name = '$department_name' ";
    $result1 = mysqli_query($condb, $check) or die("Error in query: $check ");
    $result_depart = mysqli_fetch_array($result1);
    $num = mysqli_num_rows($result1);

    if ($num == 0) {
        $result = mysqli_query($condb, $sql) or die("Error in query: $sql ");
		if ($result) {
            echo "<script>";
            echo "Swal.fire({
                icon: 'success',
                title: 'อัปเดตสมาชิก สำเร็จ !',
                // text: 'Something went wrong!'
              }).then((result)=>{
                if(result){
                window.location.href = 'department.php';
                }
            })";
            echo "</script>";
        }
    } elseif ($result_depart['department_name'] == $department_name && $result_depart['department_id'] == $department_id) {
        $result = mysqli_query($condb, $sql) or die("Error in query: $sql ");
        if ($result) {
            // exit();
            echo "<script>";
            echo "Swal.fire({
            icon: 'success',
            title: 'อัปเดตตำแหน่งงาน สำเร็จ !',
            // text: 'Something went wrong!'
          }).then((result)=>{
            if(result){
            window.location.href = 'department.php';
            }
        })";
            echo "</script>";
        } else {
            echo "<script>";
            echo "Swal.fire({
            icon: 'success',
            title: 'Error back to edit again',
            // text: 'Something went wrong!'
          }).then((result)=>{
            if(result){
            window.location.href = 'department.php';
            }
        })";
            echo "</script>";
        }
    } elseif ($num > 0) {
        echo "<script>";
        echo "Swal.fire({
            icon: 'warning',
            title: 'มีผู้ใช้ department นี้แล้ว กรุณากรอกใหม่อีกครั้ง !',
            // text: 'Something went wrong!'
          }).then((result)=>{
            if(result){
                window.location='edit_depart.php?department_id=" . $department_id . "';
            }
        })";
        echo "</script>";
    } else {
        echo "<script>";
        echo "Swal.fire({
        icon: 'success',
        title: 'Error back to edit again',
        // text: 'Something went wrong!'
      }).then((result)=>{
        if(result){
        window.location.href = 'department.php';
        }
    })";
        echo "</script>";
    }
    mysqli_close($condb);
    ?>
</body>