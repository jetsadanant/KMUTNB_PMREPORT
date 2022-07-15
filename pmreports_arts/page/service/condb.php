<?php
    $condb = mysqli_connect("localhost","pmreports","P&$8532#","pmreports") 
    // $condb = mysqli_connect("localhost","root","","oprs_new2") 
    or die("Error : ". mysqli_error($condb));
    //set utf-8
    mysqli_query($condb , "SET NAMES 'utf8' "); 
    //set time zone
    date_default_timezone_set("Asia/Bangkok");
?>