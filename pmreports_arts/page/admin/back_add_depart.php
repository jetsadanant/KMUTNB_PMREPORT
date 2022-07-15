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
$department = $_POST['department']; //รับค่าไฟล์จากฟอร์ม	
$level = $_POST['level']; //รับค่าไฟล์จากฟอร์ม	
$flow_report = $_POST['flow_report']; //รับค่าไฟล์จากฟอร์ม	
$flow_estimate = $_POST['flow_estimate']; //รับค่าไฟล์จากฟอร์ม	
$flow_report = implode(",",$flow_report);
$flow_estimate = implode(",",$flow_estimate);
$sql = "INSERT INTO department
    (
    department_name,
    level,
    flow_report,
    flow_estimate
    ) 
    VALUES
    (
    '$department',
    '$level',
    '$flow_report',
    '$flow_estimate'
    )";
$result = mysqli_query($condb, $sql) or die("Error in query: $sql ");
mysqli_close($condb);
if ($result) {
        echo "<script>";
        echo "Swal.fire({
            icon: 'success',
            title: 'เพิ่มตำแหน่งงาน สำเร็จ !',
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
        icon: 'error',
        title: 'Error back to add member again !',
        // text: 'Something went wrong!'
      }).then((result)=>{
        if(result){
        window.location.href = 'form_add_depart.php';
        }
    })";
    echo "</script>";
}
?>
</body>