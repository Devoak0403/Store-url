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
<body class="hold-transition sidebar-fixed layout-navbar-fixed ">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

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
              <div class="card">
                <div class="card-body">
                    <table id="example1"class="table table-bordered table-striped" >
                    <?php 
                            if (isset($_GET['l_id'])) {
                                $id = $_GET['l_id'];
                                $stmt = $conn->query("SELECT * FROM link_db INNER JOIN users ON link_db.u_id = users.u_id WHERE l_id = '$id'");
                                $stmt->execute();
                                $row = $stmt->fetch();
                            }
                        ?>
                        
                        <tr>
                            <th width="15%"> # ID</th>
                            <td ><?= $row['l_id'];?></td>
                        </tr>

                        <tr>
                            <th width="15%"> ชื่อ title</th>
                            <td ><?= $row['l_title'];?></td>
                        </tr>

                        <tr>
                            <th width="15%"> ลิงค์</th>
                            <td ><?= $row['l_url'];?></td>
                        </tr>

                        <tr>
                            <th width="15%"> หมายเหตุ</th>
                            <td ><?= $row['l_description'];?></td>
                        </tr>

                        <tr>
                            <th width="15%"> วันที่บันทึก</th>
                            <td ><?= DBThaiShortDate($row['dateCreate']);?></td>
                        </tr>

                        <tr>
                            <th width="15%"> ผู้บันทึก</th>
                            <td ><?= $row['fullname'];?></td>
                        </tr>
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

</body>
</html>
