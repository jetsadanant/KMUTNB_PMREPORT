<!DOCTYPE html>
<html lang="en">
    <head>
         <!-- SweetAlert2 -->
    <script src="../assets/bootstrap/template/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="../assets/bootstrap/template/plugins/sweetalert2/sweetalert2.min.css">
    </head>
    <body>
<?php
session_start();
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
//! ปิดแสดง Error   
error_reporting(0);
require_once("../page/service/condb.php");
$username = $_POST['username'];
$password = $_POST['password'];
$password = md5($password);
// $password = md5($password);
$sql = "SELECT * FROM login 
    WHERE  username = '" . $username . "' AND password = '" . $password . "' ";
// echo $sql;
$result = mysqli_query($condb, $sql) or die("Error in query: $sql ");
$row = mysqli_fetch_array($result);

// exit();
echo "<script>";
echo "const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })";
echo "</script>";
if ($username == $row["username"] and $password == $row["password"]) {
    $_SESSION["member_name"] = 'admin';
    $_SESSION["check_login"] = 1;
    header("Location: ../page/admin/");
} else {
    echo "<script>";
        // echo "alert('Username หรือ Password ไม่ถูกต้อง !!!');";
        // echo "window.location = 'index.php'; ";
        echo "Swal.fire({
            icon: 'error',
            title: 'Username หรือ Password ไม่ถูกต้อง !!!',
            // text: 'Something went wrong!'
          }).then((result)=>{
            if(result){
            window.location.href = 'index.php';
            }
        })";
        echo "</script>";
}
?>
</body>