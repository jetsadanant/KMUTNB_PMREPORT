<!DOCTYPE html>
<html lang="en">
<head>
   <!-- SweetAlert2 -->
   <script src="../../assets/bootstrap/template/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="../../assets/bootstrap/template/plugins/sweetalert2/sweetalert2.min.css">
</head>
<body>
<?php
session_start();
require_once("../service/condb.php");
// echo "<pre>";
// print_R($_POST);
// echo "</pre>";
$member_id = $_SESSION["member_id"];
$send_report_id = $_POST["send_report_id"];
$member_send_id = $_POST["member_send_id"];
$header_name = $_POST["header_name"];
$detail = $_POST["detail"];
$sql = "INSERT INTO feedback
            (
            header,
            detail
            ) 
            VALUES
            (
            '$header_name',
            '$detail'
            )";
$query = mysqli_query($condb, $sql);
$last_report_id = mysqli_insert_id($condb);
$sql2 = "INSERT INTO send_feedback
            (
                member_send_id,
                member_receive_id,
                sf_sent_report_id,
                feedback_id
            ) 
            VALUES
            (
            '$member_id',
            '$member_send_id',
            '$send_report_id',
            '$last_report_id'
            )";
$query2 = mysqli_query($condb, $sql2);
// if (mysqli_affected_rows($condb)) {
//     // echo "Record delete successfully";
// }
mysqli_close($condb);
if ($query2) {
    // echo "<script type='text/javascript'>";
    // // echo "alert('Delete Succesfuly');";
    // echo "window.location = 'index.php'; ";
    // echo "</script>";
    echo "<script>";
    echo "Swal.fire({
        icon: 'success',
        title: 'ส่งข้อเสนอแนะสำเร็จ!',
        // text: 'Something went wrong!'
      }).then((result)=>{
        if(result){
        window.location.href = 'index.php';
        }
    })";
    echo "</script>";
} else {
    echo "<script>";
    echo "Swal.fire({
        icon: 'error',
        title: 'ส่งข้อเสนอแนะ ไม่สำเร็จ!',
        // text: 'Something went wrong!'
      }).then((result)=>{
        if(result){
        window.location.href = 'send_feedback.php';
        }
    })";
    echo "</script>";
}
?>
</body>