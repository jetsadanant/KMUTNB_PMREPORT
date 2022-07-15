<!DOCTYPE html>
<html lang="en">
<head>
   <!-- SweetAlert2 -->
   <script src="assets/bootstrap/template/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="assets/bootstrap/template/plugins/sweetalert2/sweetalert2.min.css">
</head>
<body>
</body>
<?php
session_start();
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
//! ปิดแสดง Error   
error_reporting(0);
// http://localhost/pmreports_new1/
require_once("page/service/condb.php");
require_once("user_api.php");

// ! Check ICIT Account
if(($response = curl_exec($ch)) === false){
	echo 'Curl error: ' . curl_errno($ch) . ' - ' . curl_error($ch);
}else{


	$json_data = json_decode($response, true);
	if(!isset($json_data['api_status'])){
		echo 'API Error ' . print_r($response, true);
		// echo 'API Error ' . print_r($response, true);
	}elseif($json_data['api_status'] == 'success'){
		// echo 'Login success';
		// echo "<br />=============================";
		// echo "<br />Username: " . $json_data['userInfo']['username'];
		// echo "<br />Displayname: " . $json_data['userInfo']['displayname'];
		// echo "<br />Firstname EN: " . $json_data['userInfo']['firstname_en'];
		// echo "<br />Lirstname EN: " . $json_data['userInfo']['lastname_en'];
		// echo "<br />pid: " . $json_data['userInfo']['pid'];
		// echo "<br />Email: " . $json_data['userInfo']['email'];
		// echo "<br />Birthdate: " . $json_data['userInfo']['birthdate'];
		// echo "<br />Account type: " . $json_data['userInfo']['account_type'];

        // ? Check Username ICIT with Database
        // $sql = "SELECT * FROM member 
        // INNER JOIN department
        // ON member.department_id = department.department_id
        // WHERE  username = '" . $json_data['userInfo']['username'] . "' AND name = '" . $json_data['userInfo']['displayname'] . "' ";
        $sql = "SELECT * FROM member 
        INNER JOIN department
        ON member.department_id = department.department_id
        WHERE  username = '" . $json_data['userInfo']['username'] . "'";
        //!!!
        $result = mysqli_query($condb, $sql) or die("Error in query: $sql ");
        $row = mysqli_fetch_array($result);
        // echo "<pre>";
        // print_r($row);
        // echo "</pre>";
        if ($row["level"] == "boss") {
            $_SESSION["level"] = $row["level"];
            setcookie('username', $row["username"], time() + 86400 , "/");
            $_SESSION["member_id"] = $row["member_id"];
            $_SESSION["member_name"] = $row["name"];
            $_SESSION["department_id"] = $row["department_id"];
            $_SESSION["department_name"] = $row["department_name"];
            $_SESSION["check_login"] = 1;
            header("Location:page/boss/");
        } elseif ($row["level"] == "staff") {
            $_SESSION["level"] = $row["level"];
            setcookie('username', $row["username"], time() + 86400, "/");
            $_SESSION["member_id"] = $row["member_id"];
            $_SESSION["member_name"] = $row["name"];
            $_SESSION["department_id"] = $row["department_id"];
            $_SESSION["department_name"] = $row["department_name"];
            $_SESSION["check_login"] = 1;
            header("Location: page/staff/");
        } elseif ($row["level"] == "employee") {
            $_SESSION["level"] = $row["level"];
            setcookie('username', $row["username"], time() + 86400, "/");
            $_SESSION["member_id"] = $row["member_id"];
            $_SESSION["member_name"] = $row["name"];
            $_SESSION["department_id"] = $row["department_id"];
            $_SESSION["department_name"] = $row["department_name"];
            $_SESSION["check_login"] = 1;
            header("Location: page/emp/");
        }else{
            // echo "ไม่มี Username นี้ในระบบ !";
            echo "<script>";
            // echo "alert('ไม่มี Username นี้ในระบบ !!!');";
            echo "Swal.fire({
                icon: 'error',
                title: 'ไม่มี Username นี้ในระบบ !!!',
                // text: 'Something went wrong!'
              }).then((result)=>{
                if(result){
                window.location.href = 'index.php';
                }
            })";
            // echo "window.location = 'index.php'; ";
            echo "</script>";
        }

	}elseif($json_data['api_status'] == 'fail'){ //password ไม่ถูกต้อง
		// echo "API Error: " . $json_data['api_status_code'] . ' - ' . $json_data['api_message'];
        // echo "alert('Username หรือ Password ไม่ถูกต้อง !!!');";
        // echo "window.location = 'index.php'; ";
        echo "<script>";
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
	}else{
		echo "Internal Error";
	}
}
curl_close($ch);
exit();
// ! End Check ICIT Account
// $email = $_POST['email'];
// $pass = $_POST['password'];

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
$email = $_POST['email'];
$password = $_POST['password'];
$password = md5($password);
$sql = "SELECT * FROM member 
    INNER JOIN department
    ON member.department_id = department.department_id
    WHERE  email = '" . $email . "' AND password = '" . $password . "' ";
// echo $sql;
$result = mysqli_query($condb, $sql) or die("Error in query: $sql ");
$row = mysqli_fetch_array($result);
// exit();
if ($email == $row["email"] and $password == $row["password"]) {
    $_SESSION["level"] = $row["level"];
    $_SESSION["member_id"] = $row["member_id"];
    $_SESSION["member_name"] = $row["first_name"] . " " . $row["last_name"];
    $_SESSION["department_id"] = $row["department_id"];
    $_SESSION["department_name"] = $row["department_name"];
    $_SESSION["check_login"] = 1;
    // $_SESSION["m_Img"] = $row["m_Img"];
    //! Check $_SESSION
    // echo "<pre>";
    // print_r($_SESSION);
    // echo "</pre>";
    // echo $_SESSION["Email"];
    // echo $_SESSION["Name"];
    // echo $_SESSION["Department"];
    // exit();
    if ($_SESSION["level"] == "admin") {
        header("Location: page/admin/");
    } elseif ($_SESSION["level"] == "boss") {
        header("Location:page/boss/");
    } elseif ($_SESSION["level"] == "staff") {
        // echo "<script>";
        // echo "const Toast = Swal.mixin({
        //     toast: true,
        //     position: 'top-end',
        //     showConfirmButton: false,
        //     timer: 3000,
        //     timerProgressBar: true,
        //     didOpen: (toast) => {
        //       toast.addEventListener('mouseenter', Swal.stopTimer)
        //       toast.addEventListener('mouseleave', Swal.resumeTimer)
        //     }
        //   })
          
        //   Toast.fire({
        //     icon: 'success',
        //     title: 'Signed in successfully'
        //   }).then((result)=>{
        //       if(result){
        //         window.location.href = 'page/staff/index.php';
        //       }
        //   })";
            // echo "window.location.href = 'page/staff/index.php';";
        //   echo "</script>";
        header("Location: page/staff/");
    } elseif ($_SESSION["level"] == "employee") {
        header("Location: page/emp/");
    }
} else {
    // exit();
    echo "<script>";
    echo "alert('email หรือ Password ไม่ถูกต้อง !!!');";
    echo "window.location = 'index.php'; ";
    echo "</script>";
    // header("Location: login.php");
}
?>