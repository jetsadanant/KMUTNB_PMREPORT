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
// !!!! กำหนด session
$member_id = $_SESSION['member_id'];
$department_id = $_SESSION['department_id'];
$header = $_POST['header'];
$detail = $_POST['detail'];
$workplace = $_POST['workplace'];
$job_type = $_POST['job_type'];
$success = $_POST['success'];
$start_range = $_POST['start_range'];
$end_range = $_POST['end_range'];
$file = $_FILES['file'];
$problem = $_POST['problem'];
//!!! CHECK FILE
$newnames = [];
for ($i = 0; $i < count($file["name"]); $i++) {
    $errors     = array();
    $value_file = 1;
    $maxsize    = 4194304;
    if (isset($file["name"][$i])) {
        $acceptable = array(
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel', 
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        if (($_FILES['file']['size'][$i] >= $maxsize)) {
            $errors[] = 'File too large. File must be less than 4 megabytes.';
        }
        if ($_FILES["file"]["size"][$i] == 0) {
            $value_file = 0;
        }

        if ((!in_array($_FILES['file']['type'][$i], $acceptable)) && (!empty($_FILES["file"]["type"][$i]))) {
            $errors[] = 'Invalid file type. Only PDF types are accepted.';
        }
        if (count($errors) === 0 && $value_file == 1) {
            //ฟังก์ชั่นวันที่
            date_default_timezone_set('Asia/Bangkok');
            $date = date("Ymd");
            //ฟังก์ชั่นสุ่มตัวเลข
            $numrand = (mt_rand());
            //โฟลเดอร์ที่จะ upload file เข้าไป 
            $path = "../../assets/files/";
            //เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
            $type = strrchr($_FILES['file']['name'][$i], ".");
            //ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
            $newname = $date . $numrand . $type;
            $path_copy = $path . $newname;
            $path_link = "m_Img/" . $newname;
            array_push($newnames, $newname);
            //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
            move_uploaded_file($_FILES['file']['tmp_name'][$i], $path_copy);
        } elseif ($value_file == 0) {
            array_push($newnames, '');
        } else {
            foreach ($errors as $error) {
                echo '<script>alert("' . $error . '");</script>';
                echo "<script>";
                echo "window.location='form_report.php';";
                echo "</script>";
            }
            die(); //Ensure no more processing is done
        }
    }
}
//! END CHECK FILE
// print_r($newnames);

$sql2 = "SELECT flow_report FROM department WHERE department_id = $department_id";
$query2 = mysqli_query($condb, $sql2);
$row2 = mysqli_fetch_array($query2);
$values = $row2['flow_report'];
for ($x = 0; $x < count($header); $x++) {
    $sql = "INSERT INTO report
    (
        header,
        detail,
        workplace,
        job_type,
        success,
        working_range_start,
        working_range_end,
        problem,
        file
    )
    VALUES
    (
        '$header[$x]',
        '$detail[$x]',
        '$workplace[$x]',
        '$job_type[$x]',
        '$success[$x]',
        '$start_range[$x]',
        '$end_range[$x]',
        '$problem[$x]',
        '$newnames[$x]'
    )
    ";
    // !
    $query = mysqli_query($condb, $sql);
    $last_report_id = mysqli_insert_id($condb);
    $sql3 = "INSERT INTO send_report
    (
        member_send_id,
        department_receive,
        report_id
    ) 
    VALUES
    (
    '$member_id',
    '$values',
    '$last_report_id'
    )";
    $query3 = mysqli_query($condb, $sql3);
}
mysqli_close($condb);

if ($query3) {
    // echo "<script type='text/javascript'>";
    // echo "window.location = 'report.php'; ";
    // echo "</script>";
    echo "<script>";
    echo "Swal.fire({
        icon: 'success',
        title: 'บันทึกรายงานสำเร็จ!',
        // text: 'Something went wrong!'
      }).then((result)=>{
        if(result){
        window.location.href = 'report.php';
        }
    })";
    echo "</script>";
} else {
    // echo "<script type='text/javascript'>";
    // echo "alert('Error back to upload again');";
    // echo "</script>";
    echo "<script>";
    echo "Swal.fire({
        icon: 'error',
        title: 'บันทึกรายงานไม่สำเร็จ!',
        // text: 'Something went wrong!'
      }).then((result)=>{
        if(result){
        window.location.href = 'form_report.php';
        }
    })";
    echo "</script>";
}
?>
</body>