<?php 

    session_start();
    require_once 'config/db.php';
    require_once 'class/date.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: loginpage.php');

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'include/header.php'; ?>
</head>
<body class="hold-transition layout-navbar-fixed ">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <?php include 'include/navbar.php'; ?>

  <?php include 'include/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-2">แก้ไขข้อมูล User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="update_user.php" method="POST">
                              <?php 
                                  if (isset($_GET['u_id'])) {
                                      $id = $_GET['u_id'];
                                      $stmt = $conn->query("SELECT * FROM users WHERE u_id = '$id'");
                                      $stmt->execute();
                                      $row = $stmt->fetch();
                                  }
                              ?>
                            <input type="text" class="form-control" name="u_id" value="<?=$row['u_id'];?>" hidden>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ชื่อ นามสกุล</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" name="fullname" value="<?=$row['fullname'];?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">อีเมล</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" value="<?=$row['email'];?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">รหัสผ่าน</label>
                                <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ยืนยันรหัสผ่าน</label>
                                <div class="col-sm-10">
                                <input type="password" class="form-control" name="c_password" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ระดับผู้ใช้งาน</label>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                      <select class="form-control" name="urole">
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                      </select>
                                    </div>   
                                </div>
                            </div>
                            <div class="form-group justify-content-end  mt-4">
                                <div class="col-4">
                                  <button name="update" type="submit" id="btnadditem" class="btn btn-outline-primary ">ตกลง</button>
                                  <button type="reset" id="btnreitem" class="btn btn-outline-danger ">ยกเลิก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
  </div>
  <?php include 'include/footer.php'; ?>
</div>
  <?php include 'include/footer_script.php'; ?>

  <script>
        $(".delitem1-btn").click(function(e) {
            var ID = $(this).data('id');
            e.preventDefault();
            deletefileConfirm(ID);
        })
        
        function deletefileConfirm(ID) {
            Swal.fire({
                title: 'คุณแน่ใจไหม ? ',
                text: "ข้อมูลจะถูกลบอย่างถาวร *รวมถึงไฟล์ที่จัดเก็บในฐานข้อมูลด้วย!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่ ฉันต้องการลบ!',
                cancelButtonText: 'ยกเลิก!',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                                url: 'form_item.php',
                                type: 'GET',
                                data: 'delete=' + ID,
                            })
                            .done(function() {
                                Swal.fire({
                                    title: 'สำเร็จ',
                                    text: 'ข้อมูลถูกลบสำเร็จ!',
                                    icon: 'success',
                                }).then(() => {
                                    window.location.reload();
                                })
                            })
                            .fail(function() {
                                Swal.fire('มีบางอย่างผิดพลาด!', 'error')
                                window.location.reload();
                            });
                    });
                },
            });
        }
    </script>
    
    <script>
        $(".delitem2-btn").click(function(e) {
            var ID = $(this).data('id');
            e.preventDefault();
            deletefileConfirm(ID);
        })
        
        function deletefileConfirm(ID) {
            Swal.fire({
                title: 'คุณแน่ใจไหม ? ',
                text: "ข้อมูลจะถูกลบอย่างถาวร *รวมถึงไฟล์ที่จัดเก็บในฐานข้อมูลด้วย!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่ ฉันต้องการลบ!',
                cancelButtonText: 'ยกเลิก!',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                                url: 'form_item.php',
                                type: 'GET',
                                data: 'delete2=' + ID,
                            })
                            .done(function() {
                                Swal.fire({
                                    title: 'สำเร็จ',
                                    text: 'ข้อมูลถูกลบสำเร็จ!',
                                    icon: 'success',
                                }).then(() => {
                                    window.location.reload();
                                })
                            })
                            .fail(function() {
                                Swal.fire('มีบางอย่างผิดพลาด!', 'error')
                                window.location.reload();
                            });
                    });
                },
            });
        }
    </script> 
</body>
</html>
