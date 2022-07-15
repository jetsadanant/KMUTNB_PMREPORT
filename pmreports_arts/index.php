<?php
session_start(); 
require_once("page/service/condb.php");
require_once("check_cookie.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - pmreports</title>
    <!-- Section Meta tag -->
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/logo.png">
    <script src="assets/bootstrap/template/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="assets/bootstrap/template/plugins/sweetalert2/sweetalert2.min.css">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/template_login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/template_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/template_login/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/template_login/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/template_login/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/template_login/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/template_login/css/main.css">




    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/bootstrap/template/plugins/fontawesome-free/css/all.min.css">


<style>
    @import url('https://fonts.googleapis.com/css2?family=Sarabun&display=swap');
    body {
        font-family: 'Sarabun', sans-serif;
        /* font-size: 48px; */
        /* font-weight: 100; */
    }
    .container-login100 {
        width: 100%;
        min-height: 100vh;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        padding: 15px;
        background: #033860;
        background: -webkit-linear-gradient(-135deg, #033860, #033860);
        background: -o-linear-gradient(-135deg, #05B2DC, #033860);
        background: -moz-linear-gradient(-135deg, #05B2DC, #076B96);
        background: linear-gradient(-135deg, #05B2DC, #033860);
    }

    .login100-form-btn {
        background: rgba(0, 129, 185, 0.8);
        font-size: 18px;
    }

    .login100-form-btn:hover {
        background: #2ECC71;
    }

    .input100:focus+.focus-input100+.symbol-input100 {
        color: rgba(0, 129, 185, 0.8);
        padding-left: 28px;
    }

    .focus-input100 {
        display: block;
        position: absolute;
        border-radius: 25px;
        bottom: 0;
        left: 0;
        z-index: -1;
        width: 100%;
        height: 100%;
        box-shadow: 0px 0px 0px 0px;
        color: rgba(0, 129, 185, 0.8);
    }

    .wrap-login100 {
        width: 960px;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        /* justify-content: space-evenly; */
        padding: 80px 100px 40px 95px;
        /* padding: 69px 60px 52px 62px; */
        /* padding: 70px 20px ; */
        /* box-shadow: 1px 5px 10px #BFC9CA; */
    }

    /* img {
        text-align: center;
        width: 80%;
    } */
    .img2{
        text-align: center;
        width: 70%;
    }

    form {
        margin-top: -20px;
    }

    .title {
        /* font-family: 'Roboto Mono', monospace; */
        font-size: 25px;
        color: #033860;
        line-height: 2.2;
        text-align: center;
        /* word-spacing: 20px; */
        font-style: 25px;
        font-weight: 800;
    }
    .txt2{
        font-size: 16px;
        color: #033860;
    }

    @media (max-width: 992px) {
        .wrap-login100 {
            padding: 90px 90px 50px 85px;
        }

        .login100-pic {
            margin-top: 40px;
            width: 35%;
        }

        .login100-form {
            width: 50%;
        }
        .title {
        /* font-family: 'Roboto Mono', monospace; */
        font-size: 20px;
        color: #033860;
        line-height: 2.2;
        text-align: center;
        /* word-spacing: 20px; */
        font-style: 25px;
        font-weight: 800;
        }
    }

    @media (max-width: 768px) {
        .wrap-login100 {
            padding: 100px 80px 33px 80px;
        }

        .login100-pic {
            display: none;
        }

        .login100-form {
            margin-left: 50px;
            text-align: center;
            width: 75%;
        }
        .title {
        /* font-family: 'Roboto Mono', monospace; */
        font-size: 20px;
        color: #033860;
        line-height: 2.2;
        text-align: center;
        /* word-spacing: 20px; */
        font-style: 25px;
        font-weight: 800;
        }
    }

    @media (max-width: 576px) {
        .wrap-login100 {
            padding: 100px 15px 33px 15px;
        }

    }
</style>
</head>
<body class="login-page">
    <!-- login -->
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic">
                    <img src="assets/images/favicons/logo.png" alt="IMG"><br>
                    <p class="title">
                        FAA : Performance Report
                    </p>
                </div>

                <form class="login100-form validate-form" action="check_login.php" method="post">
                    <span class="login100-form-title">
                        <a href="https://account.kmutnb.ac.th">
                        <img src="assets/logo/icit_account_logo.png" alt="IMG" class="img2">
                        </a>
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="โปรดทำการกรอก Username">
                        <input class="input100" type="text" name="username" placeholder="Username">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        <i class="fas fa-user" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="โปรดทำการกรอก Password">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            เข้าสู่ระบบ
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        
                        <a class="txt2" href="https://account.kmutnb.ac.th/web/recovery/index">
                        ลืมรหัสผ่าน?
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- /login -->
    <!--===============================================================================================-->
    <script src="assets/bootstrap/template_login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets/bootstrap/template_login/vendor/bootstrap/js/popper.js"></script>
    <script src="assets/bootstrap/template_login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets/bootstrap/template_login/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="assets/bootstrap/template_login/vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="assets/bootstrap/template_login/js/main.js"></script>

</body>
</html>