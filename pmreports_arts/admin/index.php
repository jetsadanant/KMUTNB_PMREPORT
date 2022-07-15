<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin login - pmreports</title>
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/favicons/logo.png">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap/template_login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap/template_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap/template_login/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap/template_login/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap/template_login/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap/template_login/css/util.css">
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap/template_login/css/main.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/bootstrap/template/plugins/fontawesome-free/css/all.min.css">
<style>
    /* @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@300&family=Sarabun&display=swap'); */

    /* @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap'); */
    @import url('https://fonts.googleapis.com/css2?family=Sarabun&display=swap');
    body {
        font-family: 'Sarabun', sans-serif;
        /* font-size: 48px; */
        /* font-weight: 100; */
    }
    .title2{
        font-family: 'Sarabun', sans-serif;
        font-weight: bold;
        font-size: 35px;
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
        /* background: -webkit-linear-gradient(-135deg, #033860, #033860);
        background: -o-linear-gradient(-135deg, #05B2DC, #033860);
        background: -moz-linear-gradient(-135deg, #05B2DC, #076B96);
        background: linear-gradient(-135deg, #05B2DC, #033860); */
        background: -webkit-linear-gradient(-135deg, #414141, #414141);
        background: -o-linear-gradient(-135deg, #4B4B4B, #4B4B4B);
        background: -moz-linear-gradient(-135deg, #4B4B4B, #4B4B4B);
        background: linear-gradient(-135deg, #4B4B4B, #414141);
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
        padding: 90px 100px 45px 105px;
        /* box-shadow: 1px 5px 10px #BFC9CA; */
    }

    img {
        margin-top: -35px;
        text-align: center;
        width: 100%;
    }

    form {
        margin-top: -5px;
    }

    .title {
        /* font-family: 'Roboto Mono', monospace; */
        font-size: 25px;
        color:#033860;
        line-height: 2.2;
        text-align: center;
        /* word-spacing: 20px; */
        font-style: 25px;
        font-weight: 800;
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
        color:#033860;
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
            margin-left: 45px;
            width: 80%;
        }
        .title {
        /* font-family: 'Roboto Mono', monospace; */
        font-size: 20px;
        color:#033860;
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
                    <img src="../assets/images/favicons/logo.png" alt="IMG">
                    </br>
                    <p class="title">
                    FAA : Performance Report
                    </p>
                </div>

                <form class="login100-form validate-form" action="check_admin_login.php" method="post">
                    <span class="login100-form-title title2">
                       Admin Login
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="โปรดทำการกรอก Username">
                        <input class="input100" type="text" name="username" placeholder="Username" require>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fas fa-user" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="โปรดทำการกรอก Password">
                        <input class="input100" type="password" name="password" placeholder="Password" require>
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
                </form>
            </div>
        </div>
    </div>
  <!--===============================================================================================-->
  <script src="../assets/bootstrap/template_login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="../assets/bootstrap/template_login/vendor/bootstrap/js/popper.js"></script>
    <script src="../assets/bootstrap/template_login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="../assets/bootstrap/template_login/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="../assets/bootstrap/template_login/vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="../assets/bootstrap/template_login/js/main.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script> -->
    
</body>
</html>