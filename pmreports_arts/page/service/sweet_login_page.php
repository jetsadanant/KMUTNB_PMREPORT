<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>check login - pmreports</title>
    <?php include('../include/meta.php') ?>
    <?php include("../include/head.php"); ?>
    <?php include("../include/footer.php"); ?>
</head>
<body>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'โปรด Login เข้าสู่ระบบ!',
            // text: 'Something went wrong!'
          }).then((result)=>{
            if(result){
            window.location.href = '../../index.php';
            }
        });
    </script>
</body>
</html>