<!DOCTYPE html>
<html lang="en">
<head>
    <!-- SweetAlert2 -->
    <script src="../../assets/bootstrap/template/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="../../assets/bootstrap/template/plugins/sweetalert2/sweetalert2.min.css">
</head>
<body>
</body>
<?php
require_once("../service/condb.php");
$member_id = $_POST['member_id'];
$department_id = $_POST['department_id']; //รับค่าไฟล์จากฟอร์ม	
$name = $_POST['name']; //รับค่าไฟล์จากฟอร์ม	
// $tel = $_POST['tel']; //รับค่าไฟล์จากฟอร์ม	
$username = $_POST['username']; //รับค่าไฟล์จากฟอร์ม	
// $status = $_POST['status']; //รับค่าไฟล์จากฟอร์ม	
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// $GLOBALS['sql'] = "UPDATE member SET
$sql = "UPDATE member SET
    name ='$name',
    username = '$username',
    department_id = '$department_id'
    WHERE member_id = '$member_id'
    ";

$check = "select * from member  where username = '$username' ";
$result1 = mysqli_query($condb, $check) or die("Error in query: $sql ");
// print_r($result1);
$result_username = mysqli_fetch_array($result1);
// $result_username = mysqli_fetch_array($result1);
// print_r($result_username);
$num = mysqli_num_rows($result1);
// echo $num;
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
                window.location.href = 'index.php';
                }
            })";
        echo "</script>";
    }
} elseif ($result_username['username'] == $username && $result_username['member_id'] == $member_id) {
    $result = mysqli_query($condb, $sql) or die("Error in query: $sql ");
    if ($result) {
            echo "<script>";
            echo "Swal.fire({
            icon: 'success',
            title: 'อัปเดตสมาชิก สำเร็จ !',
            // text: 'Something went wrong!'
          }).then((result)=>{
            if(result){
            window.location.href = 'index.php';
            }
        })";
            echo "</script>";
        // echo "HI";
    } else {
        echo "<script>";
        echo "Swal.fire({
            icon: 'success',
            title: 'Error back to edit again',
            // text: 'Something went wrong!'
          }).then((result)=>{
            if(result){
            window.location.href = 'index.php';
            }
        })";
        echo "</script>";
    }
} elseif ($num > 0) {
    echo "<script>";
    echo "Swal.fire({
        icon: 'warning',
        title: 'มีผู้ใช้ username นี้แล้ว !',
        // text: 'Something went wrong!'
      }).then((result)=>{
        if(result){
            window.location='edit_member1.php?member_id=" . $member_id . "';
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
        window.location.href = 'index.php';
        }
    })";
    echo "</script>";
}
mysqli_close($condb);
?>