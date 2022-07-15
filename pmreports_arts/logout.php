<?php
    session_start();
    session_destroy();
    // setcookie("user", "", time() - 3600);
    // unset($_COOKIE['username']);
    // setcookie("username", "", time() - 86400);
    setcookie("username", "",time()-86400,"/");
    header("Location:index.php");
?>