<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="../../assets/bootstrap/template/plugins/fontawesome-free/css/all.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../../assets/bootstrap/template/dist/css/adminlte.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4  ใช้-->
<link rel="stylesheet" href="../../assets/bootstrap/template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- iCheck ม่น่าจะใช้-->
<link rel="stylesheet" href="../../assets/bootstrap/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- JQVMap -->
<!-- <link rel="stylesheet" href="../../assets/bootstrap/template/plugins/jqvmap/jqvmap.min.css"> -->
<!-- overlayScrollbars อาจจะไม่ได้ใช้-->
<link rel="stylesheet" href="../../assets/bootstrap/template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Daterange picker -->
<!-- <link rel="stylesheet" href="../../assets/bootstrap/template/plugins/daterangepicker/daterangepicker.css"> -->
<!-- summernote ไม่ได้ใช้แล้ว -->
<link rel="stylesheet" href="../../assets/bootstrap/template/plugins/summernote/summernote-bs4.min.css">
<!-- SimpleMDE -->
<!-- <link rel="stylesheet" href="../../assets/bootstrap/template/plugins/simplemde/simplemde.min.css"> -->
<!-- CodeMirror -->
<!-- <link rel="stylesheet" href="../../assets/bootstrap/template/plugins/codemirror/codemirror.css">
<link rel="stylesheet" href="../../assets/bootstrap/template/plugins/codemirror/theme/monokai.css"> -->
<!-- DataTables -->
<link rel="stylesheet" href="../../assets/bootstrap/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../assets/bootstrap/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../../assets/bootstrap/template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="../../assets/bootstrap/template/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../../assets/bootstrap/template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- daterange picker ตัวเลือกวันที่ -->
<link rel="stylesheet" href="../../assets/bootstrap/template/plugins/daterangepicker/daterangepicker.css">
<!-- iCheck for checkboxes and radio inputs ไม่น่าจะใช้-->
<link rel="stylesheet" href="../../assets/bootstrap/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- Bootstrap Color Picker  ไม่น่าจะใช้-->
<link rel="stylesheet" href="../../assets/bootstrap/template/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
<!-- Select2 -->
<!-- <link rel="stylesheet" href="../../assets/bootstrap/template/plugins/select2/css/select2.min.css"> -->
<!-- <link rel="stylesheet" href="../../assets/bootstrap/template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"> -->
<!-- *** Bootstrap4 Duallistbox ไม่น่าจะใช้ เหมือนselect2 เปนตัวย้ายselect จากขวาไปซ้าย (น่าใช้)-->
<link rel="stylesheet" href="../../assets/bootstrap/template/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
<!-- BS Stepper ไม่น่าจะใช้  -->
<link rel="stylesheet" href="../../assets/bootstrap/template/plugins/bs-stepper/css/bs-stepper.min.css">
<!-- dropzonejs input file แบบลากวาง ไม่น่าใช้ แต่น่าสนใจ-->
<link rel="stylesheet" href="../../assets/bootstrap/template/plugins/dropzone/min/dropzone.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../../assets/bootstrap/template/dist/css/adminlte.min.css">
<!-- sweetalert2 -->
<link rel="stylesheet" href="../../assets/bootstrap/template/plugins/sweetalert2/sweetalert2.min.css">

<script src="../../assets/js/chart.js"></script>
<script src="../../assets/js/autosize.min.js"></script>

<style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Sarabun&display=swap');

    body {
        font-family: 'Sarabun', sans-serif;
        /* font-size: 48px; */
        font-weight: 100;
    }

    /* Chart.js */
    @keyframes chartjs-render-animation {
        from {
            opacity: .99
        }

        to {
            opacity: 1
        }
    }

    .chartjs-render-monitor {
        animation: chartjs-render-animation 1ms
    }

    .chartjs-size-monitor,
    .chartjs-size-monitor-expand,
    .chartjs-size-monitor-shrink {
        position: absolute;
        direction: ltr;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        overflow: hidden;
        pointer-events: none;
        visibility: hidden;
        z-index: -1
    }

    .chartjs-size-monitor-expand>div {
        position: absolute;
        width: 1000000px;
        height: 1000000px;
        left: 0;
        top: 0
    }

    .chartjs-size-monitor-shrink>div {
        position: absolute;
        width: 200%;
        height: 200%;
        left: 0;
        top: 0
    }
</style>