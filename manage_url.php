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
      $deletestmt = $conn->query("DELETE FROM link_db WHERE  l_id='$delete_id'");
      
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
            <h1 class="m-2">ข้อมูล URL</h1>
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

              <a><button type="button" class="btn bg-indigo mb-3" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">เพิ่ม URL</button></a>

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
                      <form action="insert_url.php" method="POST">
                        <input type="text" name="u_id" value="<?=$row['u_id'];?>" hidden>
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">ชื่อ Title:</label>
                          <input type="text" class="form-control" name="l_title" required>
                        </div>
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">URL:</label>
                          <input type="text" class="form-control" name="l_url" required>
                        </div>
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">รายละเอียด:</label>
                          <textarea class="form-control" rows="4" name="l_description" required></textarea>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
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
                        <th width="10%"> #</th>
                        <th width="60%"> ชื่อ title</th>
                        <th width="15%"> บันทึกเมื่อ</th>
                        <th width="20%"> ดำเนินการ </th>
                      </tr>
                    </thead>

                      <?php
                                $stmt=$conn->query("SELECT * FROM link_db");
                                
                                $stmt->execute();
                                $rows = $stmt->fetchAll();

                                if (!$rows) {
                                    echo "<tr><td colspan='8' class='text-center'>ไม่มีข้อมูลในระบบ</td></tr>";
                                } else {
                                    $i = 1;
                                    foreach ($rows as $row2) {
                                    
                            ?>
                        <tr>
                          <td ><div align="center"><?= $i;?></td>
                          <td ><?= $row2['l_title'];?></td>
                          <td ><div align="center"><?=DBThaiShortDate($row2['dateCreate']);?></td>
                        <td ><div align="center">
                          <a href="info_url.php?l_id=<?=$row2['l_id'];?>" class="btn bg-indigo btn-sm  mt-1" id="" ><i class="fas fa-folder-open"></i></a>
                          <a href="updateform_url.php?l_id=<?= $row2['l_id']; ?>" class="btn btn-warning btn-sm  mt-1"><i class="fas fa-edit"></i></a>
                          <a href="?delete=<?= $row2['l_id']; ?>" data-id="<?= $row2['l_id'];?>" class="btn btn-danger btn-sm delitem1-btn mt-1" id="delitem1-btn" ><i class="fas fa-trash"></i></a>
                        </td>
                        </tr>
                        <?php $i++; 
                        }  } ?>
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
                                url: 'manage_url.php',
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
