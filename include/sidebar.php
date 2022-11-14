<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-orange elevation-4">
    <!-- Brand Logo -->
    <a href="index_admin.php" class="brand-link text-center bg-gray-dark">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: ."> -->
      <span class="brand-text font-weight-width">Store URL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- <div class="user-panel mt-3 mb-3 d-flex justify-content-center">
      </div> -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item ">
            <?php 
            if (isset($_SESSION['admin_login'])) {
                $user_id = $_SESSION['admin_login'];
                $stmt = $conn->query("SELECT * FROM users WHERE u_id = $user_id");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            if(isset($_SESSION['admin_login'])) {
              echo '
              <a href="#" class="nav-link bg-indigo ">
                <p class="text-light">
                  สวัสดี :: '.$row['fullname'].'
                  <i class="right fas fa-angle-down"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item bg-danger">
                  <a href="logout.php" class="nav-link active">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>ออกจากระบบ</p>
                  </a>
                </li>
              </ul>
              
              ';
            } else {
              echo '
              <li class="nav-item bg-primary">
                <a href="loginpage.php" class="nav-link ">
                  <i class="nav-icon fas fa-in"></i>
                  <p>
                    เข้าสู่ระบบ
                  </p>
                </a>
              </li>
              ';
            }
            ?>
          </li>

          
          
          <li class="nav-header">---------------------------------------------</li>
          <li class="nav-item menu ">
            <a href="index_admin.php" class="nav-link ">
              <i class="nav-icon fas fa-home"></i>
              <p>
                หน้าหลัก
              </p>
            </a>
          </li>
          <li class="nav-header">การจัดการ</li>
          <li class="nav-item menu ">
            <a href="manage_user.php" class="nav-link ">
              <i class="nav-icon fas fa-users"></i>
              <p>
                ข้อมูลผู้ใช้ระบบ
              </p>
            </a>
          </li>
          <li class="nav-item menu ">
            <a href="manage_url.php" class="nav-link ">
              <i class="nav-icon fas fa-link"></i>
              <p>
                ข้อมูล Url
              </p>
            </a>
          </li>
          <!-- <li class="nav-item ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-users"></i>
              <p>
                ข้อมูลผู้ใช้ระบบ
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="form_user.php" class="nav-link active">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>เพิ่มข้อมูล</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="manage_user.php" class="nav-link active">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>ข้อมูลผู้ใช้ระบบ</p>
                </a>
              </li>
            </ul>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>