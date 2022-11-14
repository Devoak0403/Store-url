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
      $deletestmt = $conn->query("DELETE FROM users WHERE  u_id ='$delete_id'");
      
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'include/header.php'; ?>
</head>
<body class="hold-transition sidebar-fixed layout-navbar-fixed ">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <?php include 'include/navbar.php'; ?>

  <?php include 'include/sidebar.php'; ?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-2">ข้อมูลผู้ใช้งานระบบ</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container">
          <div class="row">
            <div class="col-lg-12">

            <a><button type="button" class="btn bg-indigo mb-3" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">เพิ่ม User</button></a>

              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูล</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="insert_user.php" method="POST">
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">ชื่อ นามสกุล :</label>
                          <input type="text" class="form-control" name="fullname" required>
                        </div>
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">อีเมล :</label>
                          <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">รหัสผ่าน :</label>
                          <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">ยืนยันรหัสผ่าน :</label>
                          <input type="password" class="form-control" name="c_password" required>
                        </div>
                        <div class="form-group ">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">ระดับผู้ใช้งาน</label>
                            <div class="col-sm-4">
                                <div class="form-group">
                                  <select class="form-control" name="urole">
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                  </select>
                                </div>   
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                          <button type="reset" name="reset" class="btn btn-warning">ล้าง</button>
                          <button type="submit" name="submit" class="btn btn-primary">บันทึก</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-body">
                  <table id="example1"class="table table-bordered table-striped" >
                    <thead>
                      <tr class="text-center">
                        <th> #</th>
                        <th > ชื่อ นามสกุล</th>
                        <th> อีเมล</th>
                        <th> ระดับผู้ใช้ </th>
                        <th> บันทึกเมื่อ</th>
                        <th> ดำเนินการ </th>
                      </tr>
                    </thead>

                      <?php
                                $stmt=$conn->query("SELECT * FROM users");
                                
                                $stmt->execute();
                                $rows = $stmt->fetchAll();

                                if (!$rows) {
                                    echo "<tr><td colspan='8' class='text-center'>ไม่มีข้อมูลในระบบ</td></tr>";
                                } else {
                                  $i = 1;
                                    foreach ($rows as $row2) {
                            
                            ?>
                        <tr>
                            <td width="5%"><div align="center"><?= $i;?></td>
                            <td width="30%"><?= $row2['fullname'];?></td>
                            <td width="20%"><?= $row2['email'];?></td>
                            <td width="10%"><div align="center"><?= $row2['urole'];?></td>
                            <td width="10%"><div align="center"><?=DBThaiShortDate($row2['dateCreate']);?></td>
                            
                            <td  width="15%"><div align="center">
                              <a href="updateform_user.php?u_id=<?= $row2['u_id']; ?>" class="btn btn-warning btn-sm  mt-1"><i class="fas fa-edit"></i></a>
                              <a href="?delete=<?= $row2['u_id']; ?>" data-id="<?= $row2['u_id'];?>" class="btn btn-danger btn-sm delitem1-btn mt-1" id="delitem1-btn" ><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php $i++;
                      } } ?>
                    <tbody>
                    </tbody>
                  </table>
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
                text: "ข้อมูลจะถูกลบอย่างถาวร!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่ ฉันต้องการลบ !',
                cancelButtonText: 'ยกเลิก !',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                                url: 'manage_user.php',
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
