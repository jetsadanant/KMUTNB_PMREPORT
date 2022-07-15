<!DOCTYPE html>
<html lang="en">
<head>
   <!-- SweetAlert2 -->
   <script src="../../assets/bootstrap/template/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="../../assets/bootstrap/template/plugins/sweetalert2/sweetalert2.min.css">
</head>
<body>
<?php
require_once("../service/condb.php");  //ไฟล์เชื่อมต่อกับ database 
$department_id = $_POST['department_id']; //รับค่าไฟล์จากฟอร์ม	
$name = $_POST['name']; //รับค่าไฟล์จากฟอร์ม	
// $tel = $_POST['tel']; //รับค่าไฟล์จากฟอร์ม	
$username = $_POST['username']; //รับค่าไฟล์จากฟอร์ม	
// $status = $_POST['status']; //รับค่าไฟล์จากฟอร์ม	

$check = "select * from member  where username = '$username' ";
$result1 = mysqli_query($condb,$check) or die("Error in query: $sql ");
$num = mysqli_num_rows($result1); 
if($num == 0){
        $sql = "INSERT INTO member
        (
        name,
        username,
        department_id
        ) 
        VALUES
        (
        '$name',
        '$username',
        '$department_id'
        )";
    
    $result = mysqli_query($condb, $sql) or die("Error in query: $sql ");
    if ($result) {

        echo "<script>";
        echo "Swal.fire({
            icon: 'success',
            title: 'เพิ่มสมาชิก สำเร็จ !',
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
            title: 'Error back to add member again !',
            // text: 'Something went wrong!'
          }).then((result)=>{
            if(result){
            window.location.href = 'form_add_member1.php';
            }
        })";
        echo "</script>";
    }
}else{
    echo "<script>";
    echo "Swal.fire({
        icon: 'warning',
        title: 'มีผู้ใช้ username นี้แล้ว กรุณาสมัครใหม่อีกครั้ง !',
        // text: 'Something went wrong!'
      }).then((result)=>{
        if(result){
        window.location.href = 'form_add_member1.php';
        }
    })";
    echo "</script>";
}
mysqli_close($condb);
?>
</body>