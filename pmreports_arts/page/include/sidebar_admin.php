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
    <!-- <center> -->
    <a href="index.php" class="brand-link ">
      <img src="../../assets/images/favicons/logo.png" alt="AdminLTE Logo" class="brand-image " style="">
      <!-- img-circle elevation- -->
      <h4 class="brand-text font-weight-light">PMREPORTS</h4>
    </a>
    <!-- </center> -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="display:block;">
        <div class="image">
        </div>
        <div class="info text-center" style="text-align: center;">
          <a href="#" class="d-block">
            <h5><?php echo $_SESSION["member_name"] ?></h5>
          </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                จัดการข้อมูลสมาชิก
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="department.php" class="nav-link">
              <!-- <i class="nav-icon fas fa-list"></i> -->
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                จัดการตำแหน่งงาน
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="" class="nav-link" onclick="logout()" href="">
              <!-- <i class="nav-icon far fa-circle text-info"></i> -->
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>ออกจากระบบ</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
  </aside>
</body>