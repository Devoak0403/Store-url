<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-orange elevation-4">
    <!-- Brand Logo -->
    <a href="index_admin.php" class="brand-link text-center bg-gray-dark">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: ."> -->
      <span class="brand-text font-weight-width">Logistics Technology</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 mb-3 d-flex justify-content-center">
        <div class="info  ">
        <?php
            if (isset($_SESSION['user_login'])) {
              $user_id = $_SESSION['user_login'];
              $stmt = $conn->query("SELECT * FROM users WHERE u_id = $user_id");
              $stmt->execute();
              $row = $stmt->fetch(PDO::FETCH_ASSOC);

              $user_name = $row['firstname'] . ' ' . $row['lastname'];
              echo "<p >สวัสดีคุณ : $user_name <br>
              <a href='logout.php' class='btn btn-outline-warning btn-sm mt-2 btn-block'>ออกจากระบบ</a>
              </p>";
              } else {
              echo "<a href='loginpage.php' class='btn btn-outline-primary btn-block '>เข้าสู่ระบบ</a>";
            } 
            ?>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu ">
            <a href="index_user.php" class="nav-link ">
              <i class="nav-icon fas fa-home"></i>
              <p>
                หน้าหลัก
              </p>
            </a>
          </li>
          <li class="nav-item menu ">
            <a href="form_lent_user.php" class="nav-link ">
              <i class="nav-icon fas fa-hand-holding"></i>
              <p>
                แจ้งเบิก
              </p>
            </a>
          </li>
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>