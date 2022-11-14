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
<div class="register-box">
  <div class="register-logo">
  <h3>ระบบเบิก-จ่าย<br>วัสดุสิ้นเปลืองและครุภัณฑ์<br>ในสาขาวิชาเทคโนโลยีโลจิสติกส์ </h3>
  </div>
  
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">สมัครสมาชิกใหม่</p>
        <?php if(isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
            <?php 
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php } ?>
        <?php if(isset($_SESSION['success'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                ?>
            </div>
        <?php } ?>
      <form action="signup_db.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="รหัสนักศึกษา" name="u_code" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-school"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="ชื่อจริง" name="firstname" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="นามสกุล" name="lastname" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="อีเมล" name="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="รหัสผ่าน" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน" name="c_password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="ไอดีไลน์" name="idline" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-comment"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="tel" class="form-control" placeholder="เบอร์โทร" name="phone" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               ยินยอมข้อตกลง <a href="#">อ่าน</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="signup" class="btn btn-primary btn-block">สมัครสมาชิก</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <span>เป็นสมาชิกแล้ว</span><a href="loginpage.php" class="text-center"> เข้าสู่ระบบที่นี้!</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
