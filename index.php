<?php   
session_start();    
require_once 'config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'include/header.php'; ?>
</head>
<body class="hold-transition login-page">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="login-box">
              <div class="login-logo">
                <h3>ยินดีต้อนรับ</h3>
              </div>
              <!-- /.login-logo -->
              <div class="card">
                <div class="card-body text-center">
                  <p class="login-box-msg"></p>
                    <div class="input-group mb-3 text-center">
                      <a href="index_admin.php" class="text-center">เข้าสู่เว็บไซต์</a>
                    </div>
            
                </div>
                <!-- /.login-card-body -->
              </div>
            </div>
        </div>
    </div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
