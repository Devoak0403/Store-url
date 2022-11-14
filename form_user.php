<?php 

    session_start();
    require_once 'config/db.php';
    require_once 'class/date.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: loginpage.php');

    }

    if (isset($_GET['delete'])) {
      $delete_id = $_GET['delete'];
      $deletestmt = $conn->query("DELETE FROM item_a WHERE  a_id='$delete_id'");
      
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
            <h1 class="m-0">เพิ่มผู้ใช้งานระบบ</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index_admin.php">หน้าหลัก</a></li>
              <li class="breadcrumb-item active">เพิ่มผู้ใช้งานระบบ</li>
            </ol> 
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="sql/insert_user.php" method="POST">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">รหัสนักศึกษา</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="u_code">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ชื่อ</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control " name="firstname">
                                </div>
                                <label for="inputEmail3" class="col-sm-2 col-form-label">นามสกุล</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="lastname">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">อีเมล</label>
                                <div class="col-sm-10">
                                <input type="email" class="form-control" name="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">รหัสผ่าน</label>
                                <div class="col-sm-10">
                                <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ยืนยันรหัสผ่าน</label>
                                <div class="col-sm-10">
                                <input type="password" class="form-control" name="c_password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ไอดีไลน์</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="idline">
                                </div>
                                <label for="inputEmail3" class="col-sm-2 col-form-label">เบอร์โทร</label>
                                <div class="col-sm-4">
                                <input type="tel" class="form-control" name="phone">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ระดับผู้ใช้งาน</label>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                      <select class="custom-select rounded-0" name="urole">
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                      </select>
                                    </div>   
                                </div>
                            </div>
                            
                            <div class="form-group justify-content-end  mt-4">
                                <div class="col-4">
                                  <button name="submit" type="submit" id="btnadditem" class="btn btn-outline-primary ">ตกลง</button>
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
    
</body>
</html>
