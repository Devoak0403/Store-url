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
    <div class="row">
        <div class="col-lg-12">
            <div class="login-box">
              <div class="login-logo">
                <h3>เข้าสู่ระบบ</h3>
              </div>
              <!-- /.login-logo -->
              <div class="card">
                <div class="card-body login-card-body">
                  <p class="login-box-msg"></p>

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
            
                  <form action="signin_db.php" method="post">
                    <div class="input-group mb-3">
                      <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-envelope"></span>
                        </div>
                      </div>
                    </div>
                    <div class="input-group mb-3">
                      <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-lock"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-8">
                        <div class="icheck-primary">
                          <input type="checkbox" id="remember">
                          <label for="remember">
                            Remember Me
                          </label>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-4">
                        <button type="submit" name="signin" class="btn btn-primary btn-block">เข้าสู่ระบบ</button>
                      </div>
                      <!-- /.col -->
                    </div>
                  </form>
            
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
