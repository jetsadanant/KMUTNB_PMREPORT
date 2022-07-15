<?php
require_once("../service/condb.php");
?>
<script>
    function logout() {
        event.preventDefault(); // prevent form submit
        var form = event.target.form; // storing the form
        Swal.fire({
            title: 'ออกจากระบบ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'ออกจากระบบ สำเร็จ!',
                    icon: 'success'
                }).then((result) => {
                    window.location = "../../logout.php";
                })
            }
        })
    }
</script>

<body class="sidebar-mani layout-fixed sidebar-closed sidebar-collapse " style="height: auto;">
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index.php" class="brand-link">
            <img src="../../assets/images/favicons/logo.png" alt="AdminLTE Logo" class="brand-image " style="">
            <span class="brand-text font-weight-light">PMREPORTS</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block"><?php echo  $_SESSION["member_name"]; ?></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                ข้อมูลปฎิบัติงานพนักงาน
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="report.php" class="nav-link">
                            <i class="nav-icon fas fa-paper-plane"></i>
                            <p>
                                รายงานผลการปฎิบัติงาน
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="feedback.php" class="nav-link clicks">
                            <i class="nav-icon fas  fa-comment"></i>
                            <p>
                                ข้อเสนอแนะ
                            </p>
                            <span class="badge bg-danger count" style="border-radius:10px;"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="history_feedback.php" class="nav-link">
                            <i class="nav-icon fas fad fa-history"></i>
                            <p>
                                ประวัติส่งข้อเสนอแนะ
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="summary.php" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                สรุปผลการรายงานของพนักงาน
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="view_summary.php" class="nav-link">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>
                                สรุปผลการรายงาน
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link" onclick="logout()" href="">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>ออกจากระบบ</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
                <div class="os-scrollbar-track">
                    <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
                </div>
            </div>
            <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
                <div class="os-scrollbar-track">
                    <div class="os-scrollbar-handle" style="height: 48.933%; transform: translate(0px, 0px);"></div>
                </div>
            </div>
            <!-- <div class="os-scrollbar-corner"></div> -->
        </div>
        <!-- /.sidebar -->
    </aside>
</body>