<?php
// unset($_COOKIE['username']);
// setcookie("username", "",time()-86400,"/");
// setcookie("username", "time",time()+86400,"/");
// echo $_COOKIE['username'];
// exit();
if(isset($_COOKIE["username"])){
	if(isset($_SESSION["member_name"])){
	
		$sql = "SELECT * FROM member 
			INNER JOIN department
			ON member.department_id = department.department_id
			WHERE  username = '" . $_COOKIE["username"] . "'";
			//!!!
		$result = mysqli_query($condb, $sql) or die("Error in query: $sql ");
		$row = mysqli_fetch_array($result);
		if ($row["level"] == "boss") {
			header("Location:page/boss/");
		} elseif ($row["level"] == "staff") {
			header("Location: page/staff/");
		} elseif ($row["level"] == "employee") {
			header("Location: page/emp/");
		}else{
			echo "<script>";
			echo "Swal.fire({
				icon: 'error',
				title: 'โปรด Login เข้าสู่ระบบ!',
				// text: 'Something went wrong!'
			  }).then((result)=>{
				if(result){
				window.location.href = 'index.php';
				}
			});";
			echo "</script>";
		}
	}else{
		setcookie('username', "", time() - 86400 , "/");
		echo "<script>";
        echo "window.location.href = 'index.php';";
        echo "</script>";
	}
}
?>