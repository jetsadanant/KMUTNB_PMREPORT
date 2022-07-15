<?php 
if(!isset($_SESSION["member_name"])){
    echo "<script>";
        echo "window.location = '../service/sweet_login_page.php'; ";
    echo "</script>";
}