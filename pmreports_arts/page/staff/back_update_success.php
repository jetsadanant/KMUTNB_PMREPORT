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
// print_r($_POST);
// print_r($_FILES);
// echo "</pre>";
// exit();
$member_id = $_SESSION['member_id'];
$send_report_id = $_POST['send_report_id'];
$report_id = $_POST['report_id'];
$header = $_POST['header'];
$detail = $_POST['detail'];
$workplace = $_POST['workplace'];
$job_type = $_POST['job_type'];
$success = $_POST['success'];
$start_range = $_POST['start_range'];
$end_range = $_POST['end_range'];
$problem = $_POST['problem'];
$his_success = $_POST['his_success'];
$his_date = $_POST['his_date'];
$file = $_FILES['file'];
// echo var_dump($success);
// exit();
// Don't update file
if ($file['size'] == 0) {
    $search_file = "SELECT file FROM report WHERE report_id=" . $report_id . "";
    $result = mysqli_query($condb, $search_file) or die("Error in query: $search_file ");
    $row = mysqli_fetch_array($result);
    // echo $row['file'];
    $files = $row['file'];
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
        his_success,
        his_date,
        file
    )
    VALUES
    (
        '$header',
        '$detail',
        '$workplace',
        '$job_type',
        '$success',
        '$start_range',
        '$end_range',
        '$problem',
        '$his_success',
        '$his_date',
        '$files'
    )
    ";
    $query = mysqli_query($condb, $sql);
    $last_report_id = mysqli_insert_id($condb);
    $search_flow = "SELECT flow_report FROM member 
    INNER JOIN department
    ON member.department_id = department.department_id
    WHERE member_id = $member_id";
    $search_flow2 = mysqli_query($condb, $search_flow) or die("Error in query: $search_flow ");
    $row_search_flow = mysqli_fetch_array($search_flow2);
    $row_search_flows = $row_search_flow['flow_report'];
    $sql3 = "INSERT INTO send_report
    (
        member_send_id,
        department_receive,
        report_id
    ) 
    VALUES
    (
    '$member_id',
    '$row_search_flows',
    '$last_report_id'
    )";
    $query3 = mysqli_query($condb, $sql3);
    $last_sent_report_id = mysqli_insert_id($condb);

    $sql4 = "UPDATE send_feedback SET
    sf_sent_report_id = $last_sent_report_id WHERE sf_sent_report_id = $send_report_id";
    mysqli_query($condb, $sql4);

    $delete_send_report = "DELETE FROM send_report WHERE send_report_id = $send_report_id";
    $delete_send_reports = mysqli_query($condb, $delete_send_report);
    $delete_report = "DELETE FROM report WHERE report_id = $report_id";
    mysqli_query($condb, $delete_report);
} else {
    if (isset($file["name"])) {
        $errors     = array();
        $value_file = 1;
        $maxsize    = 4194304;
        $acceptable = array(
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel', 
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        if (($_FILES['file']['size'] >= $maxsize)) {
            $errors[] = 'File too large. File must be less than 4 megabytes.';
        }
        if ($_FILES["file"]["size"] == 0) {
            $value_file = 0;
        }
        if ((!in_array($_FILES['file']['type'], $acceptable)) && (!empty($_FILES["file"]["type"]))) {
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
            $type = strrchr($_FILES['file']['name'], ".");
            //ตั้งชื่อไฟล์ใหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
            $newname = $date . $numrand . $type;
            $path_copy = $path . $newname;
            $path_link = "m_Img/" . $newname;
            $GLOBALS['newnames'] = $newname;
            //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
            move_uploaded_file($_FILES['file']['tmp_name'], $path_copy);
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
                    his_success,
                    his_date,
                    file
                )
                VALUES
                (
                    '$header',
                    '$detail',
                    '$workplace',
                    '$job_type',
                    '$success',
                    '$start_range',
                    '$end_range',
                    '$problem',
                    '$his_success',
                    '$his_date',
                    '$newname'
                )
                ";
            $query = mysqli_query($condb, $sql);
            $last_report_id = mysqli_insert_id($condb);
            $search_flow = "SELECT flow_report FROM member 
                INNER JOIN department
                ON member.department_id = department.department_id
                WHERE member_id = $member_id";
            $search_flow2 = mysqli_query($condb, $search_flow) or die("Error in query: $search_flow ");
            $row_search_flow = mysqli_fetch_array($search_flow2);
            $row_search_flows = $row_search_flow['flow_report'];
            $sql3 = "INSERT INTO send_report
                (
                    member_send_id,
                    department_receive,
                    report_id
                ) 
                VALUES
                (
                '$member_id',
                '$row_search_flows',
                '$last_report_id'
                )";
            $query3 = mysqli_query($condb, $sql3);
            $last_sent_report_id = mysqli_insert_id($condb);

            $sql4 = "UPDATE send_feedback SET
                sf_sent_report_id = $last_sent_report_id WHERE sf_sent_report_id = $send_report_id";
            mysqli_query($condb, $sql4);

            // delete last file
            $sql2 = "SELECT file FROM report WHERE report_id = $report_id";
            $result2 = mysqli_query($condb, $sql2) or die("Error in query: $sql2 ");
            $row = mysqli_fetch_array($result2);
            $rowname = $row['file']; //ฟิวที่ใว้เก็บชื่อรูปภาพในฐานข้อมูล			 
            $file = $path . $rowname;
            if (unlink($file)) {
                // echo ("deleted $file");
            } else {
                echo ("error");
            }

            $delete_send_report = "DELETE FROM send_report WHERE send_report_id = $send_report_id";
            $delete_send_reports = mysqli_query($condb, $delete_send_report);
            $delete_report = "DELETE FROM report WHERE report_id = $report_id";
            $delete_reports = mysqli_query($condb, $delete_report);

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
mysqli_close($condb);
// echo "<script type='text/javascript'>";
// // echo "alert('Upload File Succesfuly');";
// echo "window.location = 'report.php'; ";
// echo "</script>";
echo "<script>";
    echo "Swal.fire({
        icon: 'success',
        title: 'อัปเดตรายงานสำเร็จ!',
        // text: 'Something went wrong!'
      }).then((result)=>{
        if(result){
        window.location.href = 'report.php';
        }
    })";
    echo "</script>";
// if ($query3) {
//     echo "<script type='text/javascript'>";
//     echo "alert('Upload File Succesfuly');";
//     echo "window.location = 'report.php'; ";
//     echo "</script>";
// } else {
//     echo "<script type='text/javascript'>";
//     echo "alert('Error back to upload again');";
//     echo "</script>";
// }
?>
</body>